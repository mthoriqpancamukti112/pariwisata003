<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Kuliner;
use Carbon\Carbon;
use Illuminate\Http\Request;

class KulinerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Kuliner::with('kategor')->orderBy('created_at', 'desc')->get();
        return view("kuliner.index", compact("data"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data_kategor = Kategori::all();
        return view("kuliner.create", compact('data_kategor'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $tgl_upload = $request->input('tgl_upload');
        $tgl_upload_formatted = Carbon::createFromFormat('d-m-Y', $tgl_upload)->format('Y-m-d');
        $request->merge(['tgl_upload' => $tgl_upload_formatted]);

        $request->validate([
            "image" => "required|image|mimes:jpeg,png,jpg",
            "galeri" => "required|array",
            "galeri.*" => "image|mimes:jpeg,png,jpg",
            "tempat_kuliner" => "required|unique:kuliners",
            "id_kategori" => "required",
            "deskripsi" => "required",
            "lokasi" => "required",
            "jam_operasional" => "required",
            "fasilitas" => "required",
            "kontak" => "required",
            "tgl_upload" => "required",

        ]);

        $input = $request->all();

        //upload gambar
        if ($image = $request->file('image')) {
            $destinationPath = 'images_kuliner/';
            $postImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $postImage);
            $input['image'] = "$postImage";
        }

        // Upload gambar untuk galeri
        if ($request->hasFile('galeri')) {
            $destinationPath = 'galeri_kuliner/';
            $galleryImages = [];
            foreach ($request->file('galeri') as $galleryImage) {
                $galleryImageName = date('YmdHis') . "_" . $galleryImage->getClientOriginalName();
                $galleryImage->move($destinationPath, $galleryImageName);
                $galleryImages[] = $galleryImageName;
            }
            $input['galeri'] = json_encode($galleryImages);
        }

        Kuliner::create($input);
        return redirect()->route("kuliner.index")->with("success", "Data berhasil disimpan");
    }

    /**
     * Display the specified resource.
     */
    public function show(Kuliner $kuliner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kuliner $kuliner)
    {
        $data_kategor = Kategori::all();
        return view("kuliner.edit", compact("kuliner", "data_kategor"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kuliner $kuliner)
    {
        $request->validate([
            "tempat_kuliner" => "required",
            "id_kategori" => "required",
            "deskripsi" => "required",
            "lokasi" => "required",
            "jam_operasional" => "required",
            "fasilitas" => "required",
            "kontak" => "required",
            "tgl_upload" => "required|date",
            "image" => "sometimes|image|mimes:jpeg,png,jpg",
            "galeri" => "sometimes|array",
            "galeri.*" => "image|mimes:jpeg,png,jpg",
        ]);

        // Ubah format tanggal dari datepicker ke format yang diharapkan oleh MySQL
        $tgl_upload = date('Y-m-d', strtotime($request->tgl_upload));

        $input = $request->except(['image', 'galeri']);

        // upload gambar utama
        if ($request->hasFile('image')) {
            $destinationPath = 'images_kuliner/';

            // Hapus gambar lama jika ada
            if ($kuliner->image && file_exists($destinationPath . $kuliner->image)) {
                unlink($destinationPath . $kuliner->image);
            }

            // Upload dan simpan gambar baru
            $image = $request->file('image');
            $postImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $postImage);
            $input['image'] = $postImage;
        }

        // Upload gambar galeri
        if ($request->hasFile('galeri')) {
            $destinationPath = 'galeri_kuliner/';
            $galleryImages = [];
            foreach ($request->file('galeri') as $galleryImage) {
                $galleryImageName = date('YmdHis') . "_" . $galleryImage->getClientOriginalName();
                $galleryImage->move($destinationPath, $galleryImageName);
                $galleryImages[] = $galleryImageName;
            }
            $input['galeri'] = json_encode($galleryImages);
        }

        // Perbarui data dengan format tanggal yang sudah diubah
        $input['tgl_upload'] = $tgl_upload;
        $kuliner->update($input);
        return redirect()->route("kuliner.index")->with("success", "Data berhasil diupdate");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kuliner $kuliner)
    {
        $kuliner->delete();
        return to_route("kuliner.index")->with("success", "Data berhasil dihapus");
    }
}
