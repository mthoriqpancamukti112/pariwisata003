<?php

namespace App\Http\Controllers;

use App\Models\MetodePembayaran;
use App\Models\Pembayaran;
use App\Models\Reservasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PembayaranController extends Controller
{
    public function index()
    {
        // ambil data kuliner dengan syarat harus buat relasi pada model nya
        $data = Reservasi::with('tempatKuliner')->get();

        // Ambil ID pengguna yang sedang login
        $user_id = Auth::id();

        $biaya = MetodePembayaran::pluck('biaya', 'id');

        // // Ambil semua data metode pembayaran
        // $metodePembayaran = MetodePembayaran::all();

        // Ambil reservasi yang belum dibayar oleh pengguna yang sedang login
        $reservasiBelumBayar = Reservasi::where('user_id', $user_id)->where('status', 'Belum Dibayar')->get();

        // Jika pengguna tidak memiliki reservasi yang belum dibayar
        if ($reservasiBelumBayar->isEmpty()) {
            return redirect()->route('halaman-reservasi')->with('error', 'Anda tidak memiliki reservasi yang belum dibayar.');
        }

        // Tampilkan halaman pembayaran dengan reservasi yang belum dibayar
        return view('halaman-pembayaran', compact('reservasiBelumBayar', 'data', 'biaya'));
    }

    public function store(Request $request)
    {
        // Validasi pembayaran
        $request->validate([
            'reservasi_id' => 'required|exists:reservasis,id',
            'nama_pengirim' => 'required',
            'foto_bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Cek apakah reservasi dengan ID tersebut ada
        $reservasi = Reservasi::find($request->reservasi_id);
        if (!$reservasi) {
            return redirect()->back()->with('error', 'Reservasi tidak ditemukan.');
        }

        // // Periksa apakah data reservasi sudah ada dalam database
        // $existingPembayaran = Pembayaran::where('reservasi_id', $request->reservasi_id)
        //     ->where('nama_pengirim', $request->nama_pengirim)
        //     ->where('foto_bukti_pembayaran', $request->foto_bukti_pembayaran)
        //     ->exists();

        // // Jika data ulasan sudah ada, kembalikan dengan redirect back dan pesan kesalahan
        // if ($existingPembayaran) {
        //     return redirect()->route('pembayaran.berhasil')->withErrors(['error' => 'Pembayaran sudah ada.']);
        // }

        // Cek apakah reservasi sudah dibayar sebelumnya
        if ($reservasi->status != 'Sudah Dibayar') {
            // Upload gambar bukti pembayaran
            $fotoBuktiPembayaran = $request->file('foto_bukti_pembayaran');
            $namaFoto = time() . '.' . $fotoBuktiPembayaran->getClientOriginalExtension();
            $destinationPath = 'images_bukti_pembayaran/';
            $fotoBuktiPembayaran->move($destinationPath, $namaFoto);

            // Simpan pembayaran
            $pembayaran = Pembayaran::create([
                'reservasi_id' => $request->reservasi_id,
                'user_id' => auth()->id(),
                'nama_pengirim' => $request->nama_pengirim,
                'foto_bukti_pembayaran' => $namaFoto,
            ]);

            // Perbarui status reservasi menjadi "Sudah Dibayar"
            $reservasi->status = 'Sudah Dibayar';
            $reservasi->save();

            // Set session jika pembayaran berhasil
            $request->session()->put('payment_success', true);
        }

        return redirect()->route("pembayaran.berhasil")->with("success", "Pembayaran berhasil disimpan.");
    }
}
