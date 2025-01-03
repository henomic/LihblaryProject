<?php

namespace App\Http\Controllers;

use App\Models\buku;
use App\Models\kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Contracts\Activity;

class AdminAddKategori extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //

        $Galih_kategori = kategori::withCount('relasiBuku as bukuCount')
            ->orderBy('bukuCount', 'asc');

        if ($request->nama) {
            $Galih_kategori->where('nama_kategori', 'LIKE', '%' . $request->nama . '%');
        }


        $dataGalih['Galih_kategori'] = $Galih_kategori->get();
        return view('admin.kategori.AddKategori', $dataGalih);
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
            'kategori' => 'required|unique:kategori,nama_kategori'
        ]);

        $kategori = new kategori;
        $kategori->nama_kategori = $request->kategori;
        $kategori->save();

        Activity()
            ->performedOn($kategori)
            ->causedBy(Auth::user()->id)
            ->withProperties([
                'new_data' => [
                    'model' => 'kategori',
                    'nama_kategori' => $kategori->nama_kategori
                ]
            ])
            ->event('menambah')
            ->log('membuat kategori baru');

        toast('kategori ' . $request->kategori . '  berhasil di tambahkan', 'success');
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

        $request->validate([
            'kategori' => 'required|unique:kategori,nama_kategori,' . $id . ',kategoriId'
        ]);




        $kategori = kategori::find($id);
        $oldKategori = $kategori->nama_kategori;
        $kategori->nama_kategori = $request->kategori;
        $kategori->save();


        Activity()
            ->performedOn($kategori)
            ->causedBy(Auth::user()->id_user)
            ->withProperties([
                'new_data' => [
                    'model' => 'kategori',
                    'nama_kategori' => $oldKategori,
                ],
                'old_data' => [
                    'model' => 'kategori',
                    'nama_kategori' => $kategori->nama_kategori,
                ]
            ])
            ->event('edit')
            ->log('membuat data kategori oleh ' . Auth::user()->level);
        toast('kategori ' . $request->kategori . '  berhasil di Update', 'success');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kategoriGalih = kategori::find($id);
        Activity()
            ->performedOn($kategoriGalih)
            ->causedBy(Auth::user()->id_user)
            ->withProperties([
                'new_data' => [
                    'model' => 'kategori',
                ]
            ])
            ->event('delete')
            ->log('mendelete data kategori oleh ' . Auth::user()->level);

        $kategoriGalih->delete();


        toast('Data berhaisil di hapus', 'success');
        return redirect()->back();
    }
}
