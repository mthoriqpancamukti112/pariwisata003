<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TwoFactorAuthentication
{
    public function handle($request, Closure $next)
    {
        // Memeriksa apakah pengguna sudah terautentikasi dan telah menyelesaikan setup 2FA
        if (Auth::check() && Auth::user()->google2fa_secret) {
            // Memeriksa apakah pengguna telah memverifikasi 2FA jika mencoba mengakses dashboard
            if ($request->route()->getName() === 'dashboard-index') {
                // Jika sesi OTP tidak diatur atau tidak valid, redirect ke halaman verifikasi 2FA
                if (!$request->session()->has('2fa_passed') || !$request->session()->get('2fa_passed')) {
                    return redirect()->route('2fa.show');
                }
            }

            return $next($request);
        }

        // Jika belum terautentikasi atau setup 2FA belum selesai, redirect ke halaman setup 2FA
        return redirect()->route('2fa.show');
    }
}