<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Hash;

class peminjamBuku extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //

        $userGalih = User::where('level', 'user')
            ->orderByRaw("
        CASE
        WHEN status = 'pending' THEN 1
        WHEN status = 'aktif' THEN 2
        ELSE 3 
        END
        ");

        if ($request->nama) {
            $userGalih->where('nama_lengkap', 'like', '%' . $request->nama . '%');
        }
        if ($request->status) {
            $userGalih->where('status', $request->status);
        }

        $dataGalih['userGalih'] = $userGalih->paginate(10);
        return view('admin.peminjamBuku.UserPeminjamBuku', $dataGalih);
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

        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'username' => 'required|string|max:255|unique:users',
            'alamat' => 'required|string|max:255',
            'foto' => 'required|image',
        ]);

        $user = new User();

        $user->nama_lengkap = $request->nama;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->alamat = $request->alamat;
        $user->nik = $request->nik;
        $user->level = 'user';
        $user->status = 'aktif';


        $namaLengkap = strtolower(str_replace(' ', '', $request->nama));
        $user->password = Hash::make($namaLengkap . '#' . $request->nik);

        $foto = $request->foto;
        $path = $foto->storeAs('foto', $foto->hashName(), 'public');
        $user->foto = $path;
        $user->save();

        Activity()
            ->performedOn($user)
            ->causedBy(FacadesAuth::user()->id_user)
            ->withProperties([
                'new_data' => [
                    'model' => 'User',
                    'aksi' => 'nambah',
                ],

            ])
            ->event('Login')
            ->log('Menambahkan data user ');


        toast('Data berhasil di insert', 'success');
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
            'param' => 'required'
        ]);
        $user = User::find($id);
        if ($request->param === 'acc') {
            $user->status = 'aktif';
        }
        if ($request->param === 'ban') {
            $user->status = 'ban';
        }
        if ($request->param === 'aktif') {
            $user->status = 'aktif';
        }
        if ($request->param === 'tolak') {
            User::find($id)->delete();
        }
        Activity()
            ->performedOn($user)
            ->causedBy(FacadesAuth::user()->id_user)
            ->withProperties([
                'new_data' => [
                    'model' => 'User',
                    'aksi' => 'validasi',
                    'data' => $request->param,
                ],

            ])
            ->event('Memvalidasi status user')
            ->log('Mengecek user ');

        $user->save();
        toast('status user berhasil di update menjadi ' . $request->param, 'success');
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
