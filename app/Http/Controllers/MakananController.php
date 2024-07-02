<?php

namespace App\Http\Controllers;

use App\Models\Kuliner;
use App\Models\Makanan;
use Illuminate\Http\Request;

class MakananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil data makanan yang terkait dengan kuliner pertama
        $data = Makanan::orderBy('kuliner_id', 'desc')->get();

        return view('makanan.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data_kuliner = Kuliner::all();
        return view("makanan.create", compact('data_kuliner'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "image" => "required|image|mimes:jpeg,png,jpg",
            "kuliner_id" => "required",
            "nama" => "required",
        ]);

        $input = $request->all();

        //upload gambar
        if ($image = $request->file('image')) {
            $destinationPath = 'images_makanan/';
            $postImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $postImage);
            $input['image'] = "$postImage";
        }

        Makanan::create($input);
        return redirect()->route("makanans.index")->with("success", "Data berhasil disimpan");
    }

    /**
     * Display the specified resource.
     */
    public function show(Makanan $makanan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Makanan $makanan)
    {
        $data_kuliner = Kuliner::all();
        return view("makanan.edit", compact('data_kuliner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Makanan $makanan)
    {
        $request->validate([
            "kuliner_id" => "required",
            "nama" => "required",
            "image|mimes:jpeg,png,jpg",
        ]);

        $input = $request->except(['image']);

        // upload gambar utama
        if ($request->hasFile('image')) {
            $destinationPath = 'images_makanan/';

            // Hapus gambar lama jika ada
            if ($makanan->image && file_exists($destinationPath . $makanan->image)) {
                unlink($destinationPath . $makanan->image);
            }

            // Upload dan simpan gambar baru
            $image = $request->file('image');
            $postImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $postImage);
            $input['image'] = $postImage;
        }

        $makanan->update($input);
        return redirect()->route("makanans.index")->with("success", "Data berhasil diupdate");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Makanan $makanan)
    {
        $makanan->delete();
        return to_route("makanans.index")->with("success", "Data berhasil dihapus");
    }
}