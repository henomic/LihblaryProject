<?php

namespace App\Http\Middleware;

use App\Models\peminjaman;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class BannedCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $userCek = peminjaman::where('status', 'hilang/rusak')
            ->select('id_user', DB::raw('count(*) as param'))
            ->groupBy('id_user')
            ->get();
        foreach ($userCek as $key) {
            if ($key->param >= 5) {

                $key->user->status = 'banned';


                $key->user->save();
            }
        }
        if (Auth::check() and Auth::user()->status === 'banned') {


            Auth::logout();
            toast('Akun anda telah terbanned secara permanen karna telah melanggar ketentuan kami', 'error');

            return redirect()->route('landingPage.index');
        }
        if (Auth::check() and Auth::user()->status === 'ban') {


            Auth::logout();
            toast('Akun anda telah terbanned karna telah melanggar ketentuan kami', 'error');
            return redirect()->route('landingPage.index');
        }
        if (Auth::check() and Auth::user()->status === 'nonaktif') {


            Auth::logout();
            toast('Akun anda telah di nonaktifkan oleh admin', 'error');
            return redirect()->route('landingPage.index');
        }
        return $next($request);
    }
}
