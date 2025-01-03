<?php

namespace App\Http\Controllers;

use App\Models\buku;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class LaporanPeminjamanBuku extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $urutan = 'desc';
        if ($request->has('urutan')) {
            $urutan = $request->urutan;
        }
        if ($request->urutan === null) {
            $urutan = 'desc';
        }
        $buku = buku::withCount(['peminjaman as peminjamanBuku' => fn($q) => $q->whereIn('status', ['booking', 'dikembalikan', 'dipinjam', 'proses'])])
            ->orderBy('peminjamanBuku', $urutan);

        if ($request->has('print')) {
            $dataGalih['bukuGalih'] = $buku->get();

            $pdf = Pdf::loadView('admin.Laporan.peminjamanBuku.print', $dataGalih);
            return $pdf->download('Laporan buku peminjaman terbanyak.pdf');
        }
        $dataGalih['bukuGalih'] = $buku->paginate(10);

        return view('admin.Laporan.peminjamanBuku.Peminjaman', $dataGalih);
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
