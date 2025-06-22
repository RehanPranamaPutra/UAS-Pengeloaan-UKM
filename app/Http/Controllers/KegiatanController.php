<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Ukm;
use App\Models\Anggota;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Kegiatan::with(['ukm', 'anggota']);
        $kegiatan = $query->orderBy('tgl_kegiatan', 'desc')->paginate(10);

        // ✅ Tambahkan ini untuk dropdown filter UKM
        $list_ukm = Ukm::all();

        return view('kegiatan.index', compact('kegiatan', 'list_ukm'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $ukms = Ukm::all();
        return view('kegiatan.create', compact('ukms'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'ukm_id' => 'required|exists:rehan_ukms,id',
            'anggota_id' => 'required|exists:rehan_anggotas,id',
            'nama_kegiatan' => 'required',
            'tgl_kegiatan' => 'required|date',
            'dokumentasi' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'keterangan' => 'nullable'
        ]);

        // Hitung status otomatis dari tanggal
        $tanggal = Carbon::parse($validated['tgl_kegiatan']);
        $today = Carbon::today();

        if ($tanggal->isToday()) {
            $status = 'Sedang Berlangsung';
        } elseif ($tanggal->isFuture()) {
            $status = 'Akan Datang';
        } else {
            $status = 'Selesai';
        }

        $dokumentasi = null;
        if ($request->hasFile('dokumentasi')) {
            $dokumentasi = $request->file('dokumentasi')->store('dokumentasi', 'public');
            $validated['dokumentasi'] = $dokumentasi; // simpan path relatif ke database
        }

        Kegiatan::create([
            'ukm_id' => $validated['ukm_id'],
            'nama_kegiatan' => $validated['nama_kegiatan'],
            'tgl_kegiatan' => $validated['tgl_kegiatan'],
            'status' => $status,
            'dokumentasi' => $dokumentasi,
            'keterangan' => $validated['keterangan'],
            'anggota_id' => $validated['anggota_id'],
        ]);

        return redirect()->route('kegiatan.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kegiatan $kegiatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kegiatan $kegiatan)
    {
        $anggota = Anggota::all();
        $ukms = Ukm::all();
        return view('kegiatan.edit', compact('ukms', 'kegiatan', 'anggota'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, Kegiatan $kegiatan)
    {
        // Validasi input
        $validated = $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'ukm_id' => 'required|exists:rehan_ukms,id',
            'anggota_id' => 'required|exists:rehan_anggotas,id',
            'tgl_kegiatan' => 'required|date',
            'keterangan' => 'nullable|string',
            'dokumentasi' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Hitung status berdasarkan tanggal
        $tanggal = Carbon::parse($validated['tgl_kegiatan']);
        $today = Carbon::today();

        if ($tanggal->isToday()) {
            $status = 'Sedang Berlangsung';
        } elseif ($tanggal->isFuture()) {
            $status = 'Akan Datang';
        } else {
            $status = 'Selesai';
        }

        // Cek apakah ada file baru diunggah
        if ($request->hasFile('dokumentasi')) {
            // Hapus file lama jika ada
            if ($kegiatan->dokumentasi && Storage::disk('public')->exists($kegiatan->dokumentasi)) {
                Storage::disk('public')->delete($kegiatan->dokumentasi);
            }

            // Simpan file baru
            $dokumentasi = $request->file('dokumentasi')->store('dokumentasi', 'public');
            $kegiatan->dokumentasi = $dokumentasi;
        }

        // Update data lainnya
        $kegiatan->nama_kegiatan = $validated['nama_kegiatan'];
        $kegiatan->ukm_id = $validated['ukm_id'];
        $kegiatan->anggota_id = $validated['anggota_id'];
        $kegiatan->tgl_kegiatan = $validated['tgl_kegiatan'];
        $kegiatan->keterangan = $validated['keterangan'] ?? null;
        $kegiatan->status = $status;

        // Simpan perubahan
        $kegiatan->update();

        return redirect()->route('kegiatan.index')->with('success', 'Data kegiatan berhasil diperbarui.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function delete(Kegiatan $kegiatan)
    {
         if ($kegiatan->dokumentasi && Storage::disk('public')->exists($kegiatan->dokumentasi)) {
            Storage::disk('public')->delete($kegiatan->dokumentasi);
        }
        $kegiatan->delete();
        return redirect()->route('kegiatan.index')->with('success', 'Data Berhasi Dihapus');
    }
}
