<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth as AuthCheck;
// use Illuminate\Container\Attributes\Auth ;

class auth extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        return view('Auth.Login');
    }
    public function cekLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        $cek = AuthCheck::attempt(['email' => $request->email, 'password' => $request->password]);
        if ($cek) {

            $request->session()->regenerate();
            toast('Berhasil login', 'success');

            if (AuthCheck::user()->level === 'user') {
                # code...
                return redirect()->route('landingPage.index');
            }
            if (
                AuthCheck::user()->level === 'admin' or
                AuthCheck::user()->level === 'petugas'
            ) {
                $user = User::find(AuthCheck::User()->id_user);
                Activity()
                    ->performedOn($user)
                    ->causedBy(AuthCheck::user()->id_user)
                    ->withProperties([
                        'new_data' => [
                            'model' => 'User',
                        ],
                        'old_data' => [
                            'model' => 'User',
                        ]
                    ])
                    ->event('Login')
                    ->log('Login ke akun sebagai ' . AuthCheck::user()->level);
                return redirect()->route('AdminDashboard.index');
            }
        } else {

            toast('Password atau email salah', 'error');

            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

        return view('Auth.daftar');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'nama' => 'required',
            'nik' => 'required|unique:users,nik',
            'username' => 'required|unique:users,username',
            'email' => 'required|email',
            'foto' => 'required|image',
            'password' => 'required',
        ]);


        $foto = $request->foto;
        $path = $foto->storeAs('foto', $foto->hashName(), 'public');


        $user = new User;
        $user->nama_lengkap = $request->nama;
        $user->username = $request->username;
        $user->alamat = $request->alamat;
        $user->nik = $request->nik;
        $user->level = 'user';
        $user->email = $request->email;
        $user->foto = $path;
        $user->password = Hash::make($request->password);

        $user->save();

        toast('Berhasil membuat akun member', 'success');
        return redirect()->route('auth.index');
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
            'nama' => 'required',
            'username' => 'required|unique:users,username,' . $id .
                ',id_user',
            'email' => 'required|email|unique:users,email,' . $id .
                ',id_user',
            'alamat' => 'required',
            'foto' => 'nullable|image',
        ], [
            'nama.required' => 'Nama wajib diisi.',
            'username.required' => 'Username wajib diisi.',
            'username.unique' => 'Username sudah digunakan.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'alamat.required' => 'Alamat wajib diisi.',
            'foto.image' => 'Foto harus berupa gambar.',
        ]);





        $user =  User::find($id);

        if ($request->foto) {

            Storage::disk('public')->delete($user->foto);
            $foto = $request->foto;
            $path = $foto->storeAs('foto', $foto->hashName(), 'public');


            echo $user->foto;

            $user->foto = $path;
        }

        $user->nama_lengkap = $request->nama;
        $user->username = $request->username;
        $user->alamat = $request->alamat;
        $user->email = $request->email;

        $user->save();

        toast('Berhasil membuat akun member', 'success');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //




        AuthCheck::logout();
        // session_destroy();
        session_unset();
        toast('berhasil logout', 'success');
        return redirect()->route('landingPage.index');
    }
}
