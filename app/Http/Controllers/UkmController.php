<?php

namespace App\Http\Controllers;

use App\Models\Ukm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UkmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ukms = Ukm::all();
        return view('ukm.index', compact('ukms'));
    }

    public function create()
    {
        return view('ukm.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_ukm' => 'required',
            'ketum' => 'required',
            'logo_ukm' => 'required|image|mimes:jpeg,webp,jpg',
            'deskripsi' => 'required',
            'thn_berdiri' => 'required'
        ]);

        if ($request->hasFile('logo_ukm')) {
            $logoPath = $request->file('logo_ukm')->store('logo_ukm', 'public');
            $validated['logo_ukm'] = $logoPath; // simpan path relatif ke database
        }

        Ukm::create([
            'nama_ukm' => $validated['nama_ukm'],
            'ketum' => $validated['ketum'],
            'logo_ukm' => $validated['logo_ukm'],
            'deskripsi' => $validated['deskripsi'],
            'thn_berdiri' => $validated['thn_berdiri']

        ]);

        return redirect()->route('ukm.index');
    }

    function edit(Ukm $ukm)
    {
        return view('ukm.edit', compact('ukm'));
    }

    function update(Request $request, Ukm $ukm)
    {
        $ukm->nama_ukm = $request->nama_ukm;
        $ukm->ketum = $request->ketum;
        $ukm->thn_berdiri = $request->thn_berdiri;
        $ukm->deskripsi = $request->deskripsi;

        if ($request->hasFile('logo_ukm')) {
            $logoPath = $request->file('logo_ukm')->store('logo_ukm', 'public');
            $ukm->logo_ukm = $logoPath;
        }

        $ukm->update();

        return redirect()->route('ukm.index');
    }

    function delete(Ukm $ukm)
    {
         if ($ukm->logo_ukm && Storage::disk('public')->exists($ukm->logo_ukm)) {
            Storage::disk('public')->delete($ukm->logo_ukm);
        }
        $ukm->delete();
        return redirect()->route('ukm.index')->with('success', 'Data Berhasi Dihapus');
    }
}
