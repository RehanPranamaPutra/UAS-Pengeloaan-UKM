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

        $ukm = null;
        if ($request->filled('ukm_id')) {
            $query->where('ukm_id', $request->ukm_id);
            $ukm = Ukm::find($request->ukm_id);
        }

        $kegiatan = $query->orderBy('tgl_kegiatan', 'desc')->paginate(10);
        $list_ukm = Ukm::all();

        return view('kegiatan.index', compact('kegiatan', 'list_ukm', 'ukm'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $select_ukm_id = $request->ukm_id;
        $ukms = Ukm::all();
        $anggotas = collect();

        if ($select_ukm_id) {
            $ukm = Ukm::with('anggota')->find($select_ukm_id);
            if ($ukm) {
                $anggotas = $ukm->anggota;
            }
        }

        return view('kegiatan.create', compact('ukms', 'anggotas', 'select_ukm_id'));
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
        }

        $kegiatan = Kegiatan::create([
            'ukm_id' => $validated['ukm_id'],
            'nama_kegiatan' => $validated['nama_kegiatan'],
            'tgl_kegiatan' => $validated['tgl_kegiatan'],
            'status' => $status,
            'dokumentasi' => $dokumentasi,
            'keterangan' => $validated['keterangan'],
            'anggota_id' => $validated['anggota_id'],
        ]);

        return redirect()->route('kegiatan.index', ['ukm_id' => $kegiatan->ukm_id]);
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
    public function edit(Kegiatan $kegiatan, Request $request)
    {
        $ukms = Ukm::all(); // untuk dropdown (walaupun nanti di-disable)

        // Ambil UKM terpilih dari kegiatan atau dari query parameter
        $select_ukm_id = $request->ukm_id ?? $kegiatan->ukm_id;

        // Ambil anggota dari UKM terpilih
        $anggota = Anggota::where('ukm_id', $select_ukm_id)->get();

        return view('kegiatan.edit', compact('kegiatan', 'ukms', 'anggota', 'select_ukm_id'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, Kegiatan $kegiatan)
    {
        // Validasi tanpa ukm_id (karena hidden dan tidak diubah)
        $validated = $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'anggota_id' => 'required|exists:rehan_anggotas,id',
            'tgl_kegiatan' => 'required|date',
            'keterangan' => 'nullable|string',
            'dokumentasi' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Hitung status
        $tanggal = Carbon::parse($request->tgl_kegiatan);
        $status = $tanggal->isToday() ? 'Sedang Berlangsung' : ($tanggal->isFuture() ? 'Akan Datang' : 'Selesai');

        // Handle dokumentasi baru
        if ($request->hasFile('dokumentasi')) {
            if ($kegiatan->dokumentasi && Storage::disk('public')->exists($kegiatan->dokumentasi)) {
                Storage::disk('public')->delete($kegiatan->dokumentasi);
            }
            $kegiatan->dokumentasi = $request->file('dokumentasi')->store('dokumentasi', 'public');
        }

        // Update data
        $kegiatan->nama_kegiatan = $request->nama_kegiatan;
        $kegiatan->anggota_id = $request->anggota_id;
        $kegiatan->tgl_kegiatan = $request->tgl_kegiatan;
        $kegiatan->keterangan = $request->keterangan;
        $kegiatan->status = $status;

        // Tetap isi ukm_id dari hidden input
        $kegiatan->ukm_id = $request->ukm_id;

        $kegiatan->save();

        return redirect()->route('kegiatan.index', ['ukm_id' => $kegiatan->ukm_id])
            ->with('success', 'Data kegiatan berhasil diperbarui.');
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
