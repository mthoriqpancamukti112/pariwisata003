<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use Illuminate\Http\Request;

class TourController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->has('cari')) {
            $data = Tour::where('nama_wisata', 'like', '%' . $request->cari . '%')->get();
        } else {
            $data = Tour::orderBy('created_at')->get();
        }
        return view("tour.index", compact("data", "request"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("tour.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "image" => "required|image|mimes:jpeg,png,jpg",
            "nama_wisata" => "required|unique:tours",
            "kategori" => "required",
            "fasilitas" => "required",
            "lokasi" => "required",
            "latitude" => "required",
            "longitude" => "required",
            "jam_operasional" => "required",
            "deskripsi" => "required",
        ]);

        $input = $request->all();

        //upload gambar
        if ($image = $request->file('image')) {
            $destinationPath = 'images_wisata/';
            $postImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $postImage);
            $input['image'] = "$postImage";
        }

        Tour::create($input);
        return redirect()->route("tour.index")->with("success", "Data berhasil disimpan");
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        // if ($request->has('cari')) {
        //     $data = Tour::where('nama_wisata', 'like', '%' . $request->cari . '%')->get();
        // } else {
        //     $data = Tour::orderBy('nama_wisata', 'asc')->get();
        // }
        // return view("halamanWisata", compact("data", "request"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tour $tour)
    {
        return view("tour.edit", compact("tour"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tour $tour)
    {
        $request->validate([
            "nama_wisata" => "required",
            "kategori" => "required",
            "fasilitas" => "required",
            "lokasi" => "required",
            "latitude" => "required",
            "longitude" => "required",
            "jam_operasional" => "required",
            "deskripsi" => "required",
            "image" => "image|mimes:jpeg,png,jpg",
        ]);

        $input = $request->except('image');

        if ($request->hasFile('image')) {
            $destinationPath = 'images_wisata/';

            // Hapus gambar lama jika ada
            if ($tour->image && file_exists($destinationPath . $tour->image)) {
                unlink($destinationPath . $tour->image);
            }

            // Upload dan simpan gambar baru
            $image = $request->file('image');
            $postImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $postImage);
            $input['image'] = $postImage;
        }

        $tour->update($input);
        return redirect()->route("tour.index")->with("success", "Data berhasil diupdate");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tour $tour)
    {
        $tour->delete();
        return to_route("tour.index")->with("success", "Data berhasil dihapus");
    }
}
