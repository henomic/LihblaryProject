<?php

namespace App\Http\Controllers;

use App\Models\buku;
use App\Models\kategori;
use App\Models\peminjaman;
use App\Models\pencatatanStok;
use Illuminate\Http\Request;
use App\Models\relasiKategoriBuku;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Spatie\Activitylog\Contracts\Activity;

class bukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {


        $buku = buku::withCount('peminjaman as totalPeminjaman');

        if ($request->nama) {
            $buku->where('judul', 'LIKE', '%' . $request->nama . '%');
        }
        if ($request->kategori) {
            $buku->whereHas('kategori', fn($q) => $q->where('kategoriId', 'Like', '%' . $request->kategori . '%'));
        }

        $dataGalihGanteng['buku'] =        $buku->paginate(10);

        $dataGalihGanteng['kategori'] = kategori::get();



        if (!$request->param or $request->param === 'buku') {
            return view('admin.buku.adminBuku', $dataGalihGanteng);
        } else {
            return view('admin.buku.stokBuku', $dataGalihGanteng);
        }
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
        $request->validate([
            'judul' => 'required|unique:buku,judul',
            'kategori' => 'required',
            'sinopsis' => 'required',
            'penulis' => 'required',
            'penerbit' => 'required',
            'tahun_terbit' => 'required|integer',
            'foto' => 'required|image',
        ]);


        // dd($request->kategori);


        $bukuGalihGanteng = new buku;

        $bukuGalihGanteng->judul = $request->judul;
        $bukuGalihGanteng->penulis = $request->penulis;
        $bukuGalihGanteng->penerbit = $request->penerbit;
        $bukuGalihGanteng->tahun_terbit = $request->tahun_terbit;
        $bukuGalihGanteng->stok = 0;
        $bukuGalihGanteng->sinopsis = $request->sinopsis;

        $foto = $request->foto;

        $path = $foto->storeAs('buku', $foto->hashName(), 'public');

        $bukuGalihGanteng->foto = $path;



        $bukuGalihGanteng->save();


        foreach ($request->kategori as $key) {
            $galihrelasi = new relasiKategoriBuku;
            $galihrelasi->bukuId = $bukuGalihGanteng->bukuId;

            $galihrelasi->id_kategori = $key;
            $galihrelasi->save();
        }

        Activity()
            ->performedOn($bukuGalihGanteng)
            ->causedBy(Auth::user()->id)
            ->withProperties([
                'new_data' => [
                    'model' => 'buku',
                    'judul' => $bukuGalihGanteng->judul,
                    'bukuId' => $bukuGalihGanteng->bukuId,
                ]
            ])
            ->event('menambah')
            ->log('Menambah data buku ' . $bukuGalihGanteng->judul);


        toast('Berhasil menambahkan data buku ' . $request->judul . '', 'success');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {

        $urutanGalih = 'desc';

        if ($request->urutan_stok) {
            $urutanGalih = $request->urutan_stok;
        }

        if ($request->urutan_stok === null) {
            $urutanGalih = 'desc';
        }




        $dataStok['bukuGalih'] = buku::find($id);
        $dataStok['GalihTotalPeminjam'] = peminjaman::where('bukuId', $id)
            ->whereIn('status', ['dipinjam', 'booking', 'proses'])->count();


        $pencatatan = pencatatanStok::where('bukuId', $id)
            ->orderBy('jumlah', $urutanGalih)
            ->orderBy('created_at', 'desc');

        if ($request->periode) {
            $pencatatan->where('created_at', 'LIKE', '%' . $request->periode . '%');
        }
        if ($request->status) {
            $pencatatan->where('status',  $request->status);
        }

        if ($request->date1 and $request->date2) {
            $pencatatan->whereBetween('created_at',  [$request->date1, $request->date2]);
        }






        $dataStok['tanggal'] = pencatatanStok::where('bukuId', $id)
            ->get()
            ->unique(
                function ($d) {
                    return $d->created_at->format('Y-m-d');
                }
            );
        // dd($dataStok['tanggal']);

        if ($request->has('print')) {
            $dataStok['pencatatanGalih'] = $pencatatan->get();

            $pdf = Pdf::loadView('admin.buku.printDetail', $dataStok);
            // dd($pdf);
            return $pdf->download('admin detail stok.pdf');
        }
        $dataStok['pencatatanGalih'] = $pencatatan->paginate(10);

        return view('admin.buku.detailPencatatan', $dataStok);
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
            'judul' => 'required|unique:buku,judul,' . $id . ',bukuId',
            'kategori' => 'required',
            'sinopsis' => 'required',
            'penulis' => 'required',
            'penerbit' => 'required',
            'tahun_terbit' => 'required|integer',
            'foto' => 'nullable|image',
        ]);



        $bukuGalihGanteng =  buku::find($id);

        $bukuGalihGanteng->judul = $request->judul;
        $bukuGalihGanteng->penulis = $request->penulis;
        $bukuGalihGanteng->penerbit = $request->penerbit;
        $bukuGalihGanteng->tahun_terbit = $request->tahun_terbit;
        $bukuGalihGanteng->sinopsis = $request->sinopsis;

        if ($request->foto) {
            $foto = $request->foto;

            $path = $foto->storeAs('buku', $foto->hashName(), 'public');
            Storage::disk('public')->delete($bukuGalihGanteng->foto);
            $bukuGalihGanteng->foto = $path;
        }

        $bukuGalihGanteng->save();

        relasiKategoriBuku::where('bukuId', $bukuGalihGanteng->bukuId)->delete();


        foreach ($request->kategori as $key) {
            $galihrelasi = new relasiKategoriBuku;
            $galihrelasi->bukuId = $bukuGalihGanteng->bukuId;

            $galihrelasi->id_kategori = $key;
            $galihrelasi->save();
        }




        Activity()
            ->performedOn($bukuGalihGanteng)
            ->causedBy(Auth::user()->id)
            ->withProperties([
                'new_data' => [
                    'model' => 'buku',
                    'judul' => $bukuGalihGanteng->judul,
                    'bukuId' => $bukuGalihGanteng->bukuId,
                ]
            ])
            ->event('update')
            ->log('Mengupdate data buku ' . $bukuGalihGanteng->judul);



        toast('Berhasil mengedit data buku ' . $request->judul . '', 'success');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $bukuGalihGanteng =  buku::find($id);

        Activity()
            ->performedOn($bukuGalihGanteng)
            ->causedBy(Auth::user()->id)
            ->withProperties([
                'new_data' => [
                    'model' => 'buku',
                    'judul' => $bukuGalihGanteng->judul,
                    'bukuId' => $bukuGalihGanteng->bukuId,
                ]
            ])
            ->event('hapus')
            ->log('Menghapus data buku ' . $bukuGalihGanteng->judul);
        $bukuGalihGanteng->delete();
        toast('berhasil menghapus data buku', 'success');


        return redirect()->back();
    }
}
