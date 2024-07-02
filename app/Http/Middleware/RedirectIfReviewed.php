<?php

namespace App\Http\Middleware;

use App\Models\Ulasan;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfReviewed
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $reservasi_id = $request->route('reservasi_id');

        // Periksa apakah pengguna telah memberikan ulasan untuk reservasi ini sebelumnya
        $user = auth()->user();
        $ulasanExists = Ulasan::where('reservasi_id', $reservasi_id)
            ->where('user_id', $user->id)
            ->exists();

        // Jika pengguna sudah memberikan ulasan, arahkan kembali atau lakukan tindakan lain
        if ($ulasanExists) {
            return redirect()->back()->with('warning', 'Anda sudah memberikan ulasan untuk reservasi ini.');
        }

        return $next($request);
    }
}
