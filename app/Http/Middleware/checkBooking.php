<?php

namespace App\Http\Middleware;

use App\Models\peminjaman;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class checkBooking
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $galihpeminjam = peminjaman::where('status', 'booking')->get();
        foreach ($galihpeminjam as $key) {
            $TanggaPeminjamlGalih = Carbon::parse($key->tanggalPeminjaman)->addDays(3);
            $cekPeminjam = Carbon::now()->diffInDays($TanggaPeminjamlGalih);
            // dd($cekPeminjam);
            if ($cekPeminjam <= 0) {
                $key->buku->stok += 1;
                $key->buku->save();
                $key->status = 'tolak';
                $key->save();
            }
        }

        return $next($request);
    }
}
