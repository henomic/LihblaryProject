<?php

namespace App\Http\Controllers;

use App\Models\buku;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class LaporanStokBuku extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $urutan = 'desc';

        if ($request->urutan) {
            $urutan = $request->urutan;
        }
        if (!$request->urutan) {
            $urutan = 'desc';
        }

        $BukustokGalih = buku::orderBy('stok', $urutan);

        if ($request->has('print')) {

            $dataGalih['stokBukuGalih'] = $BukustokGalih->get();

            $pdf = Pdf::loadView('admin.Laporan.stokBuku.print', $dataGalih);
            return $pdf->download('Data stok buku.pdf');
        }

        $dataGalih['stokBukuGalih'] = $BukustokGalih->paginate(10);

        return view('admin.Laporan.stokBuku.stokBuku', $dataGalih);
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
