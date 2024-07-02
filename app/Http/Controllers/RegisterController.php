<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    function index()
    {
        return view('register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'no_hp' => 'required|string|max:13|min:12|regex:/^[0-9]+$/',
            'alamat' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',
        ], [
            'name.required' => 'Nama harus diisi.',
            'no_hp.required' => 'Nomor HP harus diisi.',
            'no_hp.max' => 'Nomor HP maksimal 13 karakter.',
            'no_hp.min' => 'Nomor HP minimal 12 karakter.',
            'no_hp.regex' => 'Nomor HP harus berisi angka.',
            'alamat.required' => 'Alamat harus diisi.',
            'jenis_kelamin.required' => 'Jenis kelamin harus dipilih.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',
            'password.required' => 'Password harus diisi.',
            'password.min' => 'Password minimal 8 karakter.',
        ]);

        // Jika validasi berhasil, data disimpan ke dalam basis data
        $user = User::create([
            'name'            => $request->input('name'),
            'no_hp'           => $request->input('no_hp'),
            'alamat'          => $request->input('alamat'),
            'jenis_kelamin'   => $request->input('jenis_kelamin'),
            'email'           => $request->input('email'),
            'password'        => Hash::make($request->input('password')),
            'hak_akses'       => 'Pengunjung',
        ]);
        if ($user) {
            return response()->json([
                'success' => true,
                'message' => 'Data berhasil disimpan, silahkan login!'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan data!'
            ], 500);
        }
    }
}
