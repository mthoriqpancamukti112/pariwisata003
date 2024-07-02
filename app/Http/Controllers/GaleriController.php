<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use App\Models\Kategori;
use Illuminate\Http\Request;

class GaleriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->has('cari')) {
            $data = Galeri::where('judul', 'like', '%' . $request->cari . '%')->get();
        } else {
            $data = Galeri::with('kategor')->orderBy('judul', 'asc')->get();
        }
        return view("galeri.index", compact("data", "request"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data_kategor = Kategori::all();
        return view("galeri.create", compact('data_kategor'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "image" => "required|image|mimes:jpeg,png,jpg",
            "judul" => "required|unique:galeris",
            "kategori" => "required",
        ]);

        $input = $request->all();

        //upload gambar
        if ($image = $request->file('image')) {
            $destinationPath = 'images_galeri/';
            $postImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $postImage);
            $input['image'] = "$postImage";
        }

        Galeri::create($input);
        return redirect()->route("galeri.index")->with("success", "Data berhasil disimpan");
    }

    /**
     * Display the specified resource.
     */
    public function show(Galeri $galeri)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Galeri $galeri)
    {
        $data_kategor = Kategori::all();
        return view("galeri.edit", compact("galeri", "data_kategor"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Galeri $galeri)
    {
        $request->validate([
            "judul" => "required",
            "kategori" => "required",
            "image" => "image|mimes:jpeg,png,jpg",
        ]);

        $input = $request->except('image');

        if ($request->hasFile('image')) {
            $destinationPath = 'images_galeri/';

            // Hapus gambar lama jika ada
            if ($galeri->image && file_exists($destinationPath . $galeri->image)) {
                unlink($destinationPath . $galeri->image);
            }

            // Upload dan simpan gambar baru
            $image = $request->file('image');
            $postImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $postImage);
            $input['image'] = $postImage;
        }

        $galeri->update($input);
        return redirect()->route("galeri.index")->with("success", "Data berhasil diupdate");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Galeri $galeri)
    {
        $galeri->delete();
        return to_route("galeri.index")->with("success", "Data berhasil dihapus");
    }
}
