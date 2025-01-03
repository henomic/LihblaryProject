<?php

namespace App\Http\Middleware;

use App\Models\peminjaman;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class checkTglPeminjaman
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $peminjamanGalih = peminjaman::where('tanggalPeminjaman', Carbon::now()->format('Y-m-d'))
            ->where('status', 'proses')
            ->get();
        // dd($peminjamanGalih);
        foreach ($peminjamanGalih as  $value) {
            if ($value->buku->stok === 0) {
                $value->status = 'kehabisan';
                $value->save();
            } else {
                $value->buku->stok -= 1;
                $value->buku->save();
                $value->status = 'booking';
                $value->save();
            }
        }

        return $next($request);
    }
}
