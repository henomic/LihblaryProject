<?php

namespace App\Http\Controllers;

use App\Mail\MailForgotPassword;
use App\Mail\otpMail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth as AuthCheck;
use Illuminate\Support\Facades\Mail as FacadesMail;
use Mail;
use Str;


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


    public function forgotPasswordView(Request $request)
    {

        return view('Auth.forgotPassword.forgotSendEmail');
    }

    public function forgotPasswordCheck(Request $request)
    {
        $cek = User::where('email', $request->email);

        if ($cek->exists()) {

            $code = fake()->text(50);
            $cryp = encrypt($code);

            $mail = [
                'email' => $request->email,
                'time' => Carbon::now(),
                'link' => $request->root() . '/ResetPassword/' . $cryp
            ];


            session()->put('code', $code);
            session()->put('email', $request->email);
            FacadesMail::to($request->email)->send(new MailForgotPassword($mail));


            toast('Anda telah mengajukan penggantian password, check email anda sekarang juga', 'success');
            return redirect()->back();
        } else {
            toast('Akun email yang anda masukkan belum terdaftar', 'error');
            return redirect()->back()->with('error', 'Akun email tidak terverifikasi');
        }
    }




    public function ResetPassword(string $param)
    {
        try {
            if (session()->has('code') and session('code') === decrypt($param)) {
                return view('Auth.forgotPassword.createNewPassword');
            } else {
                abort(404);
            }
        } catch (\Throwable) {
            abort(404);
        }
    }



    public function CreatePassword(Request $request)
    {

        // dd(session('email'));
        $request->validate([
            'password' => 'required|confirmed',
        ], [
            'password.required' => 'Password harus diisi',
            'password.confirmed' => 'Password dan konfirmasi password harus sama',
        ]);

        $user = User::where('email', session('email'))->first();
        $user->password = Hash::make($request->password);
        $user->save();


        session()->forget('email');
        session()->forget('code');

        toast('Password berhasil diubah, silahkan login kembali', 'success');
        return redirect()->route('auth.index');
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
            'email' => 'required|email|unique:users,email',
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

        $otpRandom = mt_rand(100000, 999999);

        $sendOtp = [
            'email' => $request->email,
            'otp' => $otpRandom,
        ];

        FacadesMail::to($request->email)->send(new otpMail($sendOtp));


        session()->put('user', $user);
        session()->put('otp', $otpRandom);
        // dd(session('user'));

        // toast('Berhasil membuat akun member', 'success');
        return redirect()->route('ViewOtp');
    }


    public function ViewOtp()
    {
        return view('Auth.emailSender.otp.otp');
    }
    public function otpCheck(Request $request)
    {
        // dd($OTP = );

        $dataArray = $request->except('_token');


        $reqEmail = implode('', $dataArray);
        $otp = session('otp');
        if ((int) $otp === (int) $reqEmail) {
            toast('Berhasil login', 'success');
            $user = session('user');
            $user->save();
            session()->forget('user');
            session()->forget('otp');
            return redirect()->route('auth.index');
        } else {
            toast('Kode otp tidak valid', 'error');
            return redirect()->back();
        }


        // return view('');
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
