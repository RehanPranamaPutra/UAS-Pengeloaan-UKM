<?php

namespace App\Http\Controllers;

use App\Models\Ukm;
use App\Models\Anggota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->filled('ukm_id')) {
            $ukm = Ukm::findOrFail($request->ukm_id);

            if (Gate::allows('crud', $ukm)) {

                $ukm = null;
                $anggotas = collect(); // kosongkan default

                if ($request->has('ukm_id')) {
                    $ukm = Ukm::find($request->ukm_id);
                    if ($ukm) {
                        $anggotas = $ukm->anggota; // hanya ambil anggota jika ada UKM
                    }
                }
                return view('anggota.index', compact('ukm', 'anggotas'));
            }
            abort(403);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if ($request->filled('ukm_id')) {
            $ukm = Ukm::findOrFail($request->ukm_id);

            if (Gate::allows('crud', $ukm)) {

                $ukms = Ukm::all();
                $select_ukm_id = $request->ukm_id;
                return view('anggota.create', compact('ukms', 'select_ukm_id'));
            }

            abort(403);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'ukm_id' => 'required',
            'nama' => 'required',
            'nim' => 'required',
            'email' => 'required|unique:rehan_anggotas'
        ]);

        $anggota = Anggota::create($validate);

        return redirect()->route('anggota.index', ['ukm_id' => $anggota->ukm_id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Anggota $anggota)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Anggota $anggota, Request $request)
    {
        // Ambil UKM yang dimiliki anggota
        $ukm = Ukm::findOrFail($anggota->ukm_id);

        // Cek akses berdasarkan policy atau gate
        if (!Gate::allows('crud', $ukm)) {
            abort(403, 'Anda tidak memiliki akses ke UKM ini');
        }

        $ukms = Ukm::all();
        $select_ukm_id = $request->ukm_id;
        return view('anggota.edit', compact('ukms', 'select_ukm_id', 'anggota'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Anggota $anggota)
    {
        $anggota->nama = $request->nama;
        $anggota->nim = $request->nim;
        $anggota->email = $request->email;
        $anggota->ukm_id = $request->ukm_id;
        $anggota->update();

        return redirect()->route('anggota.index', ['ukm_id' => $anggota->ukm_id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Anggota $anggota)
    {
        $anggota->delete();
        return redirect()->route('anggota.index', ['ukm_id' => $anggota->ukm_id]);
    }
}
