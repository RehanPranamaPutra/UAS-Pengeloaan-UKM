<?php

namespace App\Http\Controllers;

use App\Models\Ukm;
use App\Models\Anggota;
use App\Models\Capaian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CapaianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Capaian::with(['ukm', 'anggota']);
        $ukm = null;

        // Filter berdasarkan ukm_id jika ada
        if ($request->filled('ukm_id')) {
            $query->where('ukm_id', $request->ukm_id);
            $ukm = Ukm::find($request->ukm_id);
        }

        $capaian = $query->orderBy('tanggal', 'desc')->paginate(10);
        $list_ukm = Ukm::all();
        $selected_ukm_id = $request->ukm_id; // Untuk keperluan tampilan select

        return view('capaian.index', compact('capaian', 'list_ukm', 'ukm', 'selected_ukm_id'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(request $request)
    {
        $ukms = Ukm::all();
        $ukm = null;
        $anggotas = collect();

        if ($request->has('ukm_id')) {
            $ukm = Ukm::find($request->ukm_id);
            if ($ukm) {
                $anggotas = $ukm->anggota;
            }
        }

        return view('capaian.create', compact('ukms', 'ukm', 'anggotas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'ukm_id' => 'required|exists:rehan_ukms,id',
            'anggota_id' => 'required|exists:rehan_anggotas,id',
            'judul_prestasi' => 'required',
            'deskripsi_prestasi' => 'nullable',
            'tanggal' => 'required|date',
            'tingkat' => 'required',
            'dokumentasi_capaian' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        $dokumentasi = null;
        if ($request->hasFile('dokumentasi_capaian')) {
            $dokumentasi = $request->file('dokumentasi_capaian')->store('dokumentasi_capaian', 'public');
        }

        $capaian = Capaian::create([
            'ukm_id' => $validated['ukm_id'],
            'anggota_id' => $validated['anggota_id'],
            'judul_prestasi' => $validated['judul_prestasi'],
            'deskripsi_prestasi' => $validated['deskripsi_prestasi'],
            'tanggal' => $validated['tanggal'],
            'tingkat' => $validated['tingkat'],
            'dokumentasi_capaian' => $dokumentasi,
        ]);

        return redirect()->route('capaian.index', ['ukm_id' => $capaian->ukm_id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Capaian $capaian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Capaian $capaian, Request $request)
    {
        $ukms = Ukm::all();
        $ukm = Ukm::find($capaian->ukm_id);
        $anggotas = $ukm ? $ukm->anggota : collect();

        return view('capaian.edit', compact('capaian', 'ukms', 'ukm', 'anggotas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Capaian $capaian)
    {
        $request->validate([
            'judul_prestasi' => 'required|string|max:255',
            'ukm_id' => 'required|exists:rehan_ukms,id',
            'anggota_id' => 'required|exists:rehan_anggotas,id',
            'tanggal' => 'required|date',
            'tingkat' => 'required|string',
            'deskripsi_prestasi' => 'nullable|string',
            'dokumentasi_capaian' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('dokumentasi_capaian')) {
            if ($capaian->dokumentasi_capaian && Storage::disk('public')->exists($capaian->dokumentasi_capaian)) {
                Storage::disk('public')->delete($capaian->dokumentasi_capaian);
            }
            $capaian->dokumentasi_capaian = $request->file('dokumentasi_capaian')->store('capaian', 'public');
        }

        $capaian->judul_prestasi = $request->judul_prestasi;
        $capaian->ukm_id = $request->ukm_id;
        $capaian->anggota_id = $request->anggota_id;
        $capaian->tanggal = $request->tanggal;
        $capaian->tingkat = $request->tingkat;
        $capaian->deskripsi_prestasi = $request->deskripsi_prestasi;
        $capaian->save();

        return redirect()->route('capaian.index', ['ukm_id' => $capaian->ukm_id])
            ->with('success', 'Data capaian berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Capaian $capaian)
    {
        //
    }
}
