<?php

namespace App\Http\Controllers;

use App\Models\buku;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;
use Illuminate\Http\Request;

class LaporanBukuFavorit extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $param = 'desc';

        if ($request->has('param')) {
            $param = $request->param;
        }

        if ($request->param === null) {
            $param = 'desc';
        }

        $buku = buku::withAvg('ulasan as avgrating', 'rating')
            ->withCount('ulasan as total')
            ->orderBy('avgrating', $param);

        if ($request->has('print')) {

            $dataGalih['bukuGalih'] = $buku->get();
            $pdf = Pdf::loadView('admin.Laporan.favoritBuku.print', $dataGalih);

            return $pdf->download('Laporan buku favorit.pdf');
        }

        $dataGalih['bukuGalih'] = $buku->paginate(10);
        return view('admin.Laporan.favoritBuku.favorit', $dataGalih);
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
