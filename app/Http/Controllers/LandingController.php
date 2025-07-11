<?php

namespace App\Http\Controllers;

use App\Models\Ukm;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        $ukms = Ukm::latest()->get(); // ambil semua UKM
        return view('landing.index', compact('ukms'));
    }

    public function show($slug)
    {
        $ukm = Ukm::where('slug', $slug)->firstOrFail();

        // Ambil data relasi
        $anggota = $ukm->anggota()->get();     // relasi ke anggota
        $kegiatan = $ukm->kegiatan()->get();   // relasi ke kegiatan
        $capaian = $ukm->capaian()->get();     // relasi ke capaian

        return view('landing.ukm', compact('ukm', 'anggota', 'kegiatan', 'capaian'));
    }
}
