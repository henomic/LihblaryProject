<?php

namespace App\Http\Controllers;

use App\Models\buku;
use App\Models\peminjaman;
use App\Models\ulasan;
use App\Models\User;
use Illuminate\Container\Attributes\DB;
// use Illuminate\Container\Attributes\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB as FacadesDB;

// use Illuminate\Support\Facades\DB as FacadesDB;

use function Laravel\Prompts\select;

class AdminDashboard extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $user = User::query();
        $buku = buku::query();
        $ulasan = ulasan::query();
        $peminjaman = peminjaman::query();
        $dataGalih['totalUserGalih'] = (clone $user)->count();
        $dataGalih['totalJudulGalih'] = (clone $buku)->count();
        $dataGalih['totalBukuGalih'] = 0;
        foreach (clone $buku->get() as $value) {
            $dataGalih['totalBukuGalih'] +=  $value->stok;
        }

        $dataGalih['bukuPinjamTerbanyakGalih'] = (clone $peminjaman)->select('bukuId', FacadesDB::raw('count(*) as total_peminjaman'))
            ->whereIn('status', ['booking', 'dipinjam', 'dikembalikan', 'proses'])
            ->groupBy('bukuId')
            ->orderBy('total_peminjaman', 'desc')
            ->limit(5)
            ->get();

        $dataGalih['RatingTertinggiGalih'] = (clone $ulasan)->select('bukuId', FacadesDB::raw('avg(rating) as ratings'))
            ->orderBy('ratings', 'desc')
            ->groupBy('bukuId')
            ->limit(5)
            ->get();

        $dataGalih['statusPeminjaman'] = (clone $peminjaman)
            ->orderByraw(
                "CASE 
                    WHEN status = 'booking' THEN 1
                    WHEN status = 'dipinjam' THEN 2                   
                    WHEN status = 'dikembalikan' THEN 3                   
                    ELSE  4
                    END                   
            "
            )->limit(5)->get();


        // dd($dataGalih['RatingTertinggiGalih']);
        return view('admin.dashboard.index', $dataGalih);
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
