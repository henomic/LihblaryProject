<?php

namespace App\Http\Controllers;

use App\Models\buku;
use App\Models\kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class bukuFilter extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $bukuGalih = buku::withAvg('ulasan as ulasan', 'rating')
            ->where('stok', '>', 0);
        if ($request->has('kategori')) {
            $bukuGalih->wherehas('kategori', fn($q) => $q->where('kategoriId', 'like', '%' . $request->kategori . '%'));
        }
        if ($request->has('cari')) {
            $bukuGalih->where('judul', 'like', '%' . $request->cari . '%');
        }

        $dataGalih['bukuGalih'] = $bukuGalih->paginate(10);
        $dataGalih['kategoriGalih'] = kategori::get();
        return view('bukuSearch', $dataGalih);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
