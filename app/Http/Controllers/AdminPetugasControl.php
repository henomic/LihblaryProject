<?php

namespace App\Http\Controllers;

use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash as FacadesHash;

class AdminPetugasControl extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $userGalih = User::whereIn('level', ['admin', 'petugas']);
        if ($request->nama) {
            $userGalih->where('nama_lengkap', 'like', '%' . $request->nama . '%');
        }
        if ($request->status) {
            $userGalih->where('status', $request->status);
        }

        $dataGalih['userGalih'] = $userGalih->paginate(10);
        return view('admin.petugas.petugas', $dataGalih);
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
            'nama' => 'required',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|unique:users,username',
            'alamat' => 'required',
            'nik' => 'required',
            'role' => 'required',
            'foto' => 'required|image',
        ]);

        $user = new User();

        $user->nama_lengkap = $request->nama;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->alamat = $request->alamat;
        $user->nik = $request->nik;
        $user->level = $request->role;
        $user->status = 'aktif';


        $namaLengkap = strtolower(str_replace(' ', '', $request->nama));
        $user->password = FacadesHash::make($namaLengkap . '#' . $request->nik);

        $foto = $request->foto;
        $path = $foto->storeAs('foto', $foto->hashName(), 'public');
        $user->foto = $path;
        $user->save();
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

        $user = User::find($id);
        $user->status = $request->status;
        $user->save();
        toast('status akun ' . $user->nama_lengkap . 'berhasil di ubah menjadi' . $request->status, 'success');
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
