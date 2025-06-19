<?php

namespace App\Http\Controllers;

use App\Models\Capaian;
use Illuminate\Http\Request;

class CapaianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('capaian.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(Capaian $capaian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Capaian $capaian)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Capaian $capaian)
    {
        //
    }
}
