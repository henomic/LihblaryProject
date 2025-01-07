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




        $Galih_kategori['data'] = kategori::withCount('relasiBuku as bukuCount')
            ->orderBy('bukuCount', 'asc')->get()
            ->map(function ($row) {
                $row->created_at = $row->created_at->format('d F Y');
                return $row;
            });


        // dd($Galih_kategori);

        if ($request->ajax()) {
            return datatables()->of($Galih_kategori['data'])
                ->addColumn('aksi', function ($row) {
                    $edit = '<a
                                class="edit-btn font-medium  text-blue-600 cursor-pointer :text-blue-500 hover:underline">Edit</a>';
                    $hapus = '';

                    if ($row->bukuCount  <= 0) {
                        $hapus = ' <a data-modal-target="hapus"
                                    data-modal-toggle="hapus"
                                    class="font-medium
                                    cursor-pointer text-red-600 :text-blue-500 hover:underline">Delete</a>';
                    }

                    return $edit . ' ' . $hapus;
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }



        return view('admin.kategori.AddKategori');
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
        return response()->json([
            'success' => true,
            
        ]);
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
