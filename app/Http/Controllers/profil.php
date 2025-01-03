<?php

namespace App\Http\Controllers;

use App\Models\peminjaman;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class profil extends Controller
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
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id)
    {
        // echo 'woi';
        $data['galih_user'] = User::find($id);

        if (!$data['galih_user']->id_user === Auth::user()->id_user or Auth::user()->level === 'petugas' or Auth::user()->level === 'admin') {
            $data['param'] = 'riwayat';
        } else {
            $data['param'] = 'profil';
        }

        $data['peminjamGalih'] = peminjaman::where('id_user', $id)
            ->orderByRaw("
        CASE
        WHEN status = 'booking' THEN 1
        WHEN status = 'dipinjam' THEN 2
        WHEN status = 'dikembalikan' THEN 3
        ELSE 4  
        END
        ")
            ->get();

        if ($request->param !== null) {
            $data['param'] = $request->param;
            # code...
        }




        // $request->param;
        return view('profil.profil', $data);
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
    public function update(Request $request, string $id) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
