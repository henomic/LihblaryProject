<?php

namespace App\Http\Controllers;

use App\Models\ulasan as ModelsUlasan;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class ulasan extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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

        $request->validate([
            'komenGalih' => 'nullable',
            'starGalih' => 'required',
            'bukuId' => 'required',
        ]);

        $ulasan = new ModelsUlasan;

        $ulasan->ulasan = $request->komenGalih;
        $ulasan->rating = $request->starGalih;
        $ulasan->bukuId = $request->bukuId;
        $ulasan->id_user = FacadesAuth::user()->id_user;
        $ulasan->save();
        toast('Berhasil menambahkan komentar', 'success');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //


        $request->validate([
            'komenGalih' => 'nullable',
            'starGalih' => 'required',
            'bukuId' => 'required',
        ]);

        // dd($id);
        $ulasan =  ModelsUlasan::find($id);

        $ulasan->ulasan = $request->komenGalih;
        $ulasan->rating = $request->starGalih;
        $ulasan->bukuId = $request->bukuId;
        $ulasan->id_user = FacadesAuth::user()->id_user;
        $ulasan->save();
        toast('Berhasil menambahkan komentar', 'success');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
