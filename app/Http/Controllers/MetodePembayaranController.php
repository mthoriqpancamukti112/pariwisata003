<?php

namespace App\Http\Controllers;

use App\Models\Kuliner;
use App\Models\MetodePembayaran;
use Illuminate\Http\Request;

class MetodePembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = MetodePembayaran::orderBy('created_at', 'desc')->get();
        return view('metodepembayaran.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data_kuliner = Kuliner::all();
        return view('metodepembayaran.create', compact('data_kuliner'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "kuliner_id" => "required",
            "nama_metode" => "required",
            "nomor" => "required",
            "nama" => "required",
            "biaya" => "required",
        ]);

        MetodePembayaran::create($request->all());
        return redirect()->route("metodepembayaran.index")->with("success", "Data berhasil disimpan");
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
    public function edit(string $id)
    {
        return view('metodepembayaran.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function getMetodePembayaran($id)
    {
        // Ambil data metode pembayaran berdasarkan ID yang diberikan
        $metodePembayaran = MetodePembayaran::findOrFail($id);

        // Format biaya sesuai kebutuhan
        $biaya_formatted = number_format($metodePembayaran->biaya, 2, ',', '.');

        // Kembalikan data metode pembayaran dalam bentuk JSON
        return response()->json([
            'nomor' => $metodePembayaran->nomor,
            'nama' => $metodePembayaran->nama,
            'biaya' => $metodePembayaran->biaya,
            'biaya_formatted' => $biaya_formatted, // tambahkan format biaya yang sudah diformat
        ]);
    }
}
