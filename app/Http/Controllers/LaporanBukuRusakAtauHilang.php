<?php

namespace App\Http\Controllers;

use App\Models\peminjaman;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class LaporanBukuRusakAtauHilang extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {


        $peminjamanGalih = peminjaman::where('status', 'hilang/rusak');
        if ($request->has('print')) {

            $dataGalih['peminjamanGalih'] = $peminjamanGalih->get();
            $pdf = Pdf::loadView('admin.Laporan.bukuRusakAtauHilang.print', $dataGalih);
            return $pdf->download('Laporan_Buku_Rusak_Atau_Hilang.pdf');
        }
        if ($request->date1 and $request->date2) {
            $peminjamanGalih->whereBetween('created_at', [$request->date1, $request->date2]);
        }
        $dataGalih['peminjamanGalih'] = $peminjamanGalih->paginate(10);


        return view('admin.Laporan.bukuRusakAtauHilang.bukuRusakAtauHilang', $dataGalih);
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
