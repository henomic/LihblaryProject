<?php

namespace App\Http\Controllers;

use App\Models\buku;
use Illuminate\Http\Request;
use App\Models\pencatatanStok;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Contracts\Activity;

class StokBukuControl extends Controller
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
        $request->validate([
            'keterangan' => 'required',
            'stok' => 'required|integer',
            'status' => 'required',
        ]);


        $bukuGalih = buku::find($id);
        $stokBukuGalih = new pencatatanStok;

        $stokBukuGalih->bukuId = $id;
        $stokBukuGalih->jumlah = $request->stok;
        $stokBukuGalih->status = $request->status;
        $stokBukuGalih->keterangan = $request->keterangan;
        $stokBukuGalih->save();
        $catatan = '';
        if ($request->status === 'pengurangan') {
            # code...
            $bukuGalih->stok -= $request->stok;
            $catatan = 'stok di kurangi';
        }
        if ($request->status === 'penambahan') {
            # code...
            $bukuGalih->stok += $request->stok;
            $catatan = 'stok di tambah';
        }
        $bukuGalih->save();


        Activity()
            ->performedOn($bukuGalih)
            ->causedBy(Auth::user()->id)
            ->withProperties([
                'new_data' => [
                    'bukuId' => $bukuGalih->bukuId,
                    'model' => 'pencatatan Stok',
                    'catatan' => $catatan,

                ]
            ])
            ->log('Pencatatan Stok');
        toast('berhasil menambahkan pencatatan stok buku', 'success');
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
