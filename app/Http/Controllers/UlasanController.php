<?php

namespace App\Http\Controllers;

use App\Models\Kuliner;
use App\Models\Reservasi;
use App\Models\Ulasan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UlasanController extends Controller
{
    public function index()
    {
        $data = Ulasan::with('kulinertempat', 'reservasi')->orderBy('created_at', 'desc')->get();
        return view('ulasan.index', compact('data'));
    }

    public function create($reservasi_id)
    {
        // Dapatkan reservasi berdasarkan $reservasi_id
        $reservasi = Reservasi::findOrFail($reservasi_id);

        // Dapatkan id_tempat dari reservasi
        $id_tempat = $reservasi->id_tempat;

        // Dapatkan data tempat kuliner berdasarkan id_tempat
        $detailkuliner = Kuliner::findOrFail($id_tempat);

        // Kirimkan $detailkuliner dan $reservasi_id ke dalam view
        return view('ulasan.create', compact('detailkuliner', 'reservasi_id'));
    }

    public function store(Request $request)
    {
        // Validasi data yang dikirimkan oleh formulir
        $validatedData = $request->validate([
            'komentar' => 'required|string',
            'rating' => 'required|integer|min:1',
            'reservasi_id' => 'required|exists:reservasis,id',
        ]);

        // Ambil reservasi berdasarkan reservasi_id yang diberikan
        $reservasi = Reservasi::findOrFail($validatedData['reservasi_id']);

        // Dari reservasi, Anda dapat mengakses id_tempat
        $id_tempat = $reservasi->id_tempat;

        // Mendapatkan ID pengguna yang sedang masuk
        $user_id = Auth::id();

        // Periksa apakah user_id sudah memberikan ulasan pada reservasi_id yang sama sebelumnya
        $existingUlasanUser = Ulasan::where('reservasi_id', $request->reservasi_id)
            ->where('user_id', Auth::id())
            ->exists();

        // Jika user_id sudah memberikan ulasan pada reservasi_id yang sama sebelumnya, kembalikan dengan redirect back dan pesan kesalahan
        if ($existingUlasanUser) {
            return redirect()->route('halaman-reservasi')->withErrors(['error' => 'Anda sudah memberikan ulasan untuk reservasi ini.']);
        }


        // Simpan ulasan ke dalam database
        $ulasan = new Ulasan();
        $ulasan->komentar = $validatedData['komentar'];
        $ulasan->rating = $validatedData['rating'];
        $ulasan->tgl_ulasan = now(); // Tanggal ulasan bisa diatur sesuai kebutuhan
        $ulasan->reservasi_id = $validatedData['reservasi_id'];
        $ulasan->user_id = $user_id; // Menyimpan user_id
        $ulasan->id_tempat = $id_tempat; // Mengisi id_tempat dengan nilai yang didapatkan dari reservasi
        $ulasan->save();

        return redirect()->route('halaman-reservasi')->with('success', 'Ulasan berhasil dikirim');
    }


    public function hapus(Ulasan $ulasan)
    {
        $ulasan->delete();
        return to_route("ulasan.index");
    }
}
