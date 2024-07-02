<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = User::orderBy('created_at')->get();
        return view('user.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("user.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "image" => "required|image|mimes:jpeg,png,jpg",
            "name" => "required|unique:users",
            "no_hp" => "required",
            "alamat" => "required",
            "jenis_kelamin" => "required",
            "email" => "required|email",
            "password" => "required",
            "hak_akses" => "required",
        ]);

        $input = $request->all();

        //upload gambar
        if ($image = $request->file('image')) {
            $destinationPath = 'images_profile/';
            $postImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $postImage);
            $input['image'] = "$postImage";
        }


        User::create($input);
        return redirect()->route("user.index")->with("success", "Data berhasil disimpan");
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view("user.edit", compact("user"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
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
            if ($user->image && file_exists($destinationPath . $user->image)) {
                unlink($destinationPath . $user->image);
            }

            // Upload dan simpan gambar baru
            $image = $request->file('image');
            $postImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $postImage);
            $input['image'] = $postImage;
        }

        $user->update($input);
        return to_route("user.index")->with("success", "Data berhasil diupdate");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return to_route("user.index")->with("success", "Data berhasil dihapus");
    }
}
