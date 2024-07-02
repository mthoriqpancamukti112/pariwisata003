<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CekLevel
{
    public function handle(Request $request, Closure $next, ...$levels): Response
    {
        // Simpan URL sebelumnya
        Session::put('previous_url', url()->previous());

        // Periksa apakah ada pengguna yang terautentikasi
        if (Auth::check()) {
            // Periksa apakah pengguna memiliki hak akses yang sesuai
            if (in_array(Auth::user()->hak_akses, $levels)) {
                return $next($request);
            }
            // Jika pengguna tidak memiliki hak akses yang sesuai, kembalikan tanggapan redirect
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk mengakses halaman ini.');
        }
        // Jika tidak ada pengguna yang terautentikasi, arahkan pengguna ke halaman login
        return redirect('/login');
    }
}
