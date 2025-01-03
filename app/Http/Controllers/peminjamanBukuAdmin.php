<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\buku;
use App\Models\User;
use App\Models\denda;
use App\Models\ulasan;
use App\Models\peminjaman;
use Illuminate\Http\Request;
use App\Models\pencatatanStok;
// use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Contracts\Activity;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Spatie\Activitylog\Models\Activity as ModelsActivity;

class peminjamanBukuAdmin extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //

        $galihPeminjaman = peminjaman::with(['user'])->orderByRaw("
        CASE
        WHEN status = 'booking' THEN 1
        WHEN status = 'dipinjam' THEN 2
        WHEN status = 'dikembalikan' THEN 3
        WHEN status = 'hilang/rusak' THEN 4
        ELSE 5

        END
        ");


        if ($request->has('kode')) {
            $galihPeminjaman->where('peminjamanId', 'like', '%' . $request->kode . '%');
        }


        if ($request->date1 and $request->date2) {
            $galihPeminjaman->whereBetween('tanggalPeminjaman', [$request->date1, $request->date2]);
        }

        $dataGalih['galihPeminjaman'] = $galihPeminjaman->paginate(10);



        $dataGalih['bukuGalih'] = buku::where('stok', '>', 0)
            ->get();
        $dataGalih['userGalih'] = User::with('peminjaman')->where('level', 'user')
            ->where('status', 'aktif')
            ->withCount(['peminjaman as totalCount' => fn($q) => $q
                ->whereIn('status', ['booking', 'dipinjam', 'proses'])])
            ->having('totalCount', '<', 3)

            ->get();





        return view('admin.peminjaman.peminjamanKonfirmasi', $dataGalih);
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
            'id_user' => 'required',
            'id_buku' => 'required',
        ]);

        $userGalih = User::where('id_user', $request->id_user)->with('peminjaman')->where('level', 'user')
            ->where('status', 'aktif')
            ->withCount(['peminjaman as totalCount' => fn($q) => $q
                ->whereIn('status', ['booking', 'dipinjam', 'proses'])])->first();

        $cek = count($request->id_buku) + $userGalih->totalCount;

        // dd($cek, $userGalih->totalCount);
        if ($cek > 3) {

            toast('Maaf total peminjaman dari pengguna ini sudah melebihi ketentuan', 'error');
        } else {



            $peminjamanCekBukuGalih = peminjaman::where('id_user', $request->id_user)
                ->whereIn('bukuId', $request->id_buku)
                ->whereIn('status', ['proses', 'dipinjam', 'booking'])->exists();


            if (!$peminjamanCekBukuGalih) {
                foreach ($request->id_buku as $key) {
                    # code...
                    $Galihpeminjaman = new peminjaman;
                    $Galihpeminjaman->id_user = $request->id_user;
                    $Galihpeminjaman->bukuId = $key;
                    $Galihpeminjaman->tanggalPeminjaman = Carbon::now()->format('Y-m-d');
                    $Galihpeminjaman->tanggalPengembalian = Carbon::now()->addDays(7)->format('Y-m-d');
                    $Galihpeminjaman->status = 'dipinjam';
                    $Galihpeminjaman->save();
                    $Galihpeminjaman->buku->stok -= 1;
                    $Galihpeminjaman->buku->save();

                    Activity()
                        ->performedOn($Galihpeminjaman)
                        ->causedBy(Auth::user()->id_user)
                        ->withProperties([
                            'new_data' => [
                                'model' => 'peminjaman',
                                'status' => $Galihpeminjaman->status,
                                'bukuId' => $key,
                                'id_peminjaman' => $Galihpeminjaman->peminjamanId,
                            ]
                        ])
                        ->log('membuat data peminjaman oleh ' . Auth::user()->level);
                }

                toast('data buku peminjaman berhasil di tambahkan', 'success');
            } else {
                toast('User ini telah meminjam buku ini', 'warning');
            }
        }
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

        $peminjamanGalih = peminjaman::find($id);

        $oldStatus =        $peminjamanGalih->status;

        if ($request->param === 'denda') {
            $request->validate([
                'keterangan' => 'required'
            ]);
            $GalihdendaBiasa = new denda;

            $GalihdendaBiasa->id_peminjaman = $id;
            $GalihdendaBiasa->denda =   $request->hargaDenda;

            $GalihdendaBiasa->keterangan = $request->keterangan;
            $GalihdendaBiasa->save();

            if ($request->statusBuku === 'hilang/rusak') {
                $peminjamanGalih->status = 'hilang/rusak';
                $pencatatnStokGalih = new pencatatanStok;
                $pencatatnStokGalih->bukuId = $peminjamanGalih->bukuId;
                $pencatatnStokGalih->jumlah = 1;
                $pencatatnStokGalih->status = 'pengurangan';
                $pencatatnStokGalih->keterangan = $request->keterangan;
                $pencatatnStokGalih->save();
            } else {
                $peminjamanGalih->status = 'dikembalikan';
            }
        } else {
            $peminjamanGalih->status = $request->param;
        }


        if ($request->galihdendaTelat) {
            $dendaGalihTelat = new denda;
            $dendaGalihTelat->id_peminjaman = $id;
            $dendaGalihTelat->denda = $request->galihdendaTelat * 20000;
            $dendaGalihTelat->keterangan = 'telat mengembalikan buku ' . $request->galihdendaTelat . ' Hari';
            $dendaGalihTelat->save();
        }


        $peminjamanGalih->save();

        // dd($peminjamanGalih->status);
        if ($peminjamanGalih->status === 'tolak' or $peminjamanGalih->status === 'dikembalikan') {

            $peminjamanGalih->buku->stok += 1;
            $peminjamanGalih->buku->save();
        }


        Activity()
            ->causedBy(Auth::user()->id_user)
            ->withProperties([
                'old_data' => [
                    'status' => $oldStatus
                ],
                'new_data' => [
                    'model' => 'peminjaman',
                    'status' => $peminjamanGalih->status,
                    'bukuId' => $peminjamanGalih->bukuId,
                    'id_peminjaman' => $peminjamanGalih->peminjamanId,
                ]
            ])
            ->log('Mengubah status ' . $oldStatus . ' peminjaman menjadi ' . $peminjamanGalih->status . ' oleh ' . Auth::user()->nama_lengkap);


        toast('status buku telah di ubah menjadi ' . $request->param . '', 'success');
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
