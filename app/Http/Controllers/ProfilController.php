<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\Reservasi;
use App\Models\Ulasan;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mendapatkan data pengguna yang sedang login
        $user = Auth::user();

        $jumlah_ulasan = Ulasan::where('user_id', $user->id)->count();
        $jumlah_reservasi = Reservasi::where('user_id', $user->id)->count();
        $jumlah_rating = Rating::where('user_id', $user->id)->count();

        return view('halaman-profil', compact('user', 'jumlah_rating', 'jumlah_reservasi', 'jumlah_ulasan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(User $user)
    {
        $user = Auth::user();
        return view("profil.edit", compact("user"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $profil)
    {
        // dd($request->all());
        $request->validate([
            "name" => "required",
            "no_hp" => "required",
            "alamat" => "required",
            "jenis_kelamin" => "required",
            "email" => "required",
            "password" => "required",
            "hak_akses" => "required",
            "image" => "sometimes|image|mimes:jpeg,png,jpg",
        ]);

        $input = $request->except(['image']);

        // upload gambar utama
        if ($request->hasFile('image')) {
            $destinationPath = 'images_profile/';

            // Hapus gambar lama jika ada
            if ($profil->image && file_exists($destinationPath . $profil->image)) {
                unlink($destinationPath . $profil->image);
            }

            // Upload dan simpan gambar baru
            $image = $request->file('image');
            $postImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $postImage);
            $input['image'] = $postImage;
        }

        $profil->update($input);
        return redirect()->route("halaman-profil")->with("success", "Data berhasil diupdate");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
