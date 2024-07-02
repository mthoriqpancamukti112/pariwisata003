<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
// use PragmaRX\Google2FALaravel\Facades\Google2FA;
use PragmaRX\Google2FA\Google2FA;
use BaconQrCode\Encoder\QrCode;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Writer;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use App\Models\User;


class LoginController extends Controller
{
    function index()
    {
        return view('login');
    }

    public function authenticate(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Jika autentikasi berhasil
            if (Auth::user()->hak_akses == 'Admin' || Auth::user()->hak_akses == 'User') {
                // Cek apakah pengguna sudah mengaktifkan 2FA
                if (Auth::user()->google2fa_secret) {
                    // Jika sudah, arahkan ke halaman untuk memasukkan OTP
                    return redirect()->route('2fa.show');
                } else {
                    // Jika belum, arahkan langsung ke dashboard
                    return redirect('/dashboard');
                }
            } elseif (Auth::user()->hak_akses == 'Pengunjung') {
                return redirect('/');
            }
        }

        // Jika autentikasi gagal
        return back()->withErrors([
            'email' => 'Email dan password salah!',
        ])->onlyInput('email');
    }

    public function show2faForm(Request $request)
    {
        $google2fa = new Google2FA();
        $user = $request->user();  // Mendapatkan instance model User dari request

        // Generate secret key jika belum ada
        if (!$user->google2fa_secret) {
            $user->google2fa_secret = $google2fa->generateSecretKey();
            $user->save();
        }

        $email = $user->email;
        $appName = config('app.name');

        $renderer = new ImageRenderer(
            new RendererStyle(200),  // Ukuran QR Code
            new SvgImageBackEnd()
        );

        // Generate QR Code URL dengan secret key yang sudah ada
        $qrCodeUrl = $google2fa->getQRCodeUrl($appName, $email, $user->google2fa_secret);

        $writer = new Writer($renderer);
        $qrCodeSvg = $writer->writeString($qrCodeUrl);

        return view('2fa', [
            'google2faUrl' => $qrCodeSvg,  // Mengirimkan SVG langsung ke view
        ]);
    }


    public function authenticate2fa(Request $request)
    {
        $google2fa = new Google2FA();
        $valid = $google2fa->verifyKey(Auth::user()->google2fa_secret, $request->otp);

        if ($valid) {
            // Menyimpan sesi untuk menandakan keberhasilan verifikasi 2FA
            $request->session()->put('2fa_passed', true);

            return redirect('/dashboard');
        } else {
            return back()->withErrors([
                'otp' => 'Kode OTP tidak valid.',
            ]);
        }
    }


    public function logout(Request $request)
    {
        $request->session()->forget('2fa_passed'); // Hapus sesi 2fa_passed
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('login');
    }


    public function logoutgues(Request $request)
    {
        $request->session()->forget('2fa_passed'); // Hapus sesi 2fa_passed
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}