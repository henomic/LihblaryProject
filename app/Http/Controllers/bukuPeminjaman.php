<?php

namespace App\Http\Controllers;

use App\Models\buku;
use App\Models\favorit;
use App\Models\peminjaman;
use App\Models\ulasan;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Spatie\Activitylog\Models\Activity;

class bukuPeminjaman extends Controller
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

        if (FacadesAuth::check()) {
            # code...



            $request->validate([
                'minjam' => 'required'
            ]);
            $buku = buku::find($request->id);

            if ($buku->stok === 0) {
                toast('maaf buku sudah habis', 'error');
                return redirect()->route('landingPage.index');
            } else {
                $request->minjam;
                $pengembalianGalih = Carbon::parse($request->minjam)->addDays(7)->format('Y-m-d');


                $peminjamanGalih = new peminjaman;
                $peminjamanGalih->id_user = FacadesAuth::user()->id_user;
                $peminjamanGalih->bukuId = $request->id;
                $peminjamanGalih->tanggalPeminjaman = $request->minjam;
                $peminjamanGalih->tanggalPengembalian = $pengembalianGalih;
                $peminjamanGalih->status = 'proses';
                $peminjamanGalih->save();

                toast('Buku berhasil di booking mohon untuk mengambil buku secepatnya ya!!', 'success');
                return redirect()->back();
            }
        } else {
            toast('Anda harus login terlebih dahulu!!', 'error');
            return redirect()->route('auth.index');
        }


        // $buku = buku::find($request->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {



        $dataBukuGalih['cekGalih'] = false;
        $ulasan = ulasan::where('bukuId', $id);
        $dataBukuGalih['ulasanBukuIniGalih'] = (clone $ulasan)->get();

        $dataBukuGalih['ratingGalih'] = (clone $ulasan)->avg('rating');

        if (FacadesAuth::check()) {

            $dataBukuGalih['ulasanGalih'] = (clone $ulasan)->where('id_user', FacadesAuth::user()->id_user)->first();


            $dataBukuGalih['GalihCekPembelian'] = peminjaman::where('id_user', FacadesAuth::user()->id_user)
                ->where('bukuId', $id)
                ->whereNotIn('status', ['kehabisan', 'dikembalikan', 'tolak', 'hilang/rusak'])
                ->count();


            $dataBukuGalih['GalihCekPeminjaman'] = peminjaman::where('id_user', FacadesAuth::user()->id_user)
                ->where('bukuId', $id)
                ->whereIn('status',  ['dikembalikan', 'hilang/rusak'])
                ->count();

            $dataBukuGalih['ulasanSaya'] = ulasan::where('bukuId', $id)
                ->where('id_user', FacadesAuth::user()->id_user)->first();



            $dataBukuGalih['cekJumlahPeminjamanBukuGalih'] = peminjaman::whereIn('status', ['booking', 'dipinjam', 'proses', 'hilang/rusak'])
                ->where('id_user', FacadesAuth::user()->id_user)->count();
            // @dd($dataBukuGalih['GalihCekPembelian']);

            $dataBukuGalih['cekGalih'] =  favorit::where('id_user', FacadesAuth::user()->id_user)
                ->where('bukuId', $id)->exists();
        }
        // dd($dataBukuGalih['GalihCekPembelian']);
        $dataBukuGalih['bukuGalih'] = buku::find($id);
        return view('buku.detailView', $dataBukuGalih);
    }
    public function favorit(Request $request)
    {
        $request->validate([
            'id_buku' => 'required'
        ]);

        if (FacadesAuth::check()) {

            echo $id_buku = $request->id_buku;

            $cekFav =  favorit::where('id_user', FacadesAuth::user()->id_user)
                ->where('bukuId', $id_buku);
            if (!$cekFav->exists()) {
                # code...
                $favorit = new favorit;
                $favorit->id_user = FacadesAuth::user()->id_user;
                $favorit->bukuId = $id_buku;
                toast('Berhasil menambahkan favorit', 'success');
                $favorit->save();
            } else {
                toast('Berhasil menghapus favorit', 'success');

                $cekFav->delete();
            }


            return redirect()->back();
        } else {
            toast('wajib login terlebih dahulu jika ingin menambahkan favorit', 'warning');
            return redirect()->route('auth.index');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function viewFavorit($GalihId)
    {

        // $dataGalih['galih_sekarang']=
        $dataGalih['Galihfavorit'] = favorit::where('id_user', FacadesAuth::user()->id_user)->get();

        return view('buku.viewFavoritBuku', $dataGalih);
        //
    }
    public function detailPeminjaman(Request $request, $GalihId)
    {

        // $dataGalih['galih_sekarang']=
        $dataGalih['DetailPeminjamanGalih'] = peminjaman::find($GalihId);
        if ($request->has('print')) {
            $pdf = Pdf::loadView('admin.peminjamBuku.print', $dataGalih);

            return $pdf->download('detailPeminjaman.pdf');
        }

        $dataGalih['activityLih'] = Activity::whereJsonContains('properties->new_data->id_peminjaman', (int)$GalihId)->first();

        // dd($activityLih, $GalihId);

        return view('admin.peminjamBuku.detailPeminjaman', $dataGalih);
        //
    }
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
