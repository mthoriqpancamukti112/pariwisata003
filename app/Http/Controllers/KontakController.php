<?php

namespace App\Http\Controllers;

use App\Models\Kontak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class KontakController extends Controller
{
    public function index()
    {
        $data = Kontak::all();
        return view('kontak.index', compact('data'));
    }
    public function kontak()
    {
        return view('halaman_kontak');
    }

    public function tambah(Request $request)
    {
        // Validasi data yang dikirimkan oleh formulir dengan pesan kustom
        $validatedData = $request->validate([
            'nama' => 'required',
            'perihal' => 'required',
            'pesan' => 'required',
        ]);

        // Periksa apakah data sudah ada dalam database
        $existingData = Kontak::where('nama', $validatedData['nama'])
            ->where('perihal', $validatedData['perihal'])
            ->where('pesan', $validatedData['pesan'])
            ->exists();

        // Jika data sudah ada, kembalikan dengan pesan kesalahan
        if ($existingData) {
            return redirect()->back()->with('error', 'Data sudah tersimpan sebelumnya.');
        }

        // Simpan ke dalam database
        $kontak = new Kontak();
        $kontak->nama = $validatedData['nama'];
        $kontak->perihal = $validatedData['perihal'];
        $kontak->pesan = $validatedData['pesan'];
        $kontak->tgl = now(); // Tanggal bisa diatur sesuai kebutuhan
        $kontak->save();

        return redirect()->route('kontak.index')->with('success', 'Data berhasil disimpan.');
    }
}
