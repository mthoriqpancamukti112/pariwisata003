<?php

namespace App\Http\Controllers;

use App\Models\KapasitasMeja;
use App\Models\Kuliner;
use App\Models\MetodePembayaran;
use App\Models\Pembayaran;
use App\Models\Reservasi;
use App\Models\Ulasan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class ReservasiController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Mendapatkan ID pengguna yang saat ini login
        $userId = Auth::id(); // Agar pengunjung hanya bisa akses data mereka pribadi

        // Mengambil data reservasi hanya untuk pengguna yang saat ini login
        $data = Reservasi::where('user_id', $userId)->with('tempatKuliner')->orderBy('created_at', 'desc')->get();
        return view('halaman-reservasi', compact('data'));
    }

    public function simpanReservasi(Request $request)
    {

        // dd($request->all());

        $request->validate([
            'id_tempat' => 'required|exists:kuliners,id',
            'id_meja' => 'required|exists:kapasitas_mejas,id',
            'id_metode_pembayaran' => 'required|exists:metode_pembayarans,id',
            'nama_pengunjung' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'tgl_pesan' => 'required|date',
            'jumlah_orang' => 'required|integer',
        ]);

        // Periksa apakah meja yang dipilih tersedia
        $idMeja = $request->id_meja;
        $tanggalWaktuDipilih = \Carbon\Carbon::createFromFormat('d-m-Y H:i', $request->tgl_pesan)->format('Y-m-d H:i:s');

        $reservasiTersebut = Reservasi::where('id_meja', $idMeja)
            ->where('tgl_pesan', '<', $tanggalWaktuDipilih)
            ->where('status', '!=', 'Dibatalkan')
            ->orderBy('tgl_pesan', 'desc')
            ->first();

        if ($reservasiTersebut) {
            return response()->json(['error' => 'Nomor meja sudah dipesan oleh customer lain, mohon menunggu dan memilih jenis meja yang lain.'], 422);
        }

        // Jika meja tersedia, lanjutkan menyimpan reservasi...
        $reservasi = new Reservasi();
        $reservasi->user_id = Auth::id();
        $reservasi->id_tempat = $request->id_tempat;
        $reservasi->id_meja = $request->id_meja;
        $reservasi->id_metode_pembayaran = $request->id_metode_pembayaran;
        $reservasi->nama_pengunjung = $request->nama_pengunjung;
        $reservasi->no_hp = $request->no_hp;
        $reservasi->email = $request->email;
        $tgl_pesan = \Carbon\Carbon::createFromFormat('d-m-Y H:i', $request->tgl_pesan)->format('Y-m-d H:i:s');
        $reservasi->tgl_pesan = $tgl_pesan;
        $reservasi->jumlah_orang = $request->jumlah_orang;
        $reservasi->status = 'Dipending';
        $reservasi->save();

        // Update status meja menjadi 'Full'
        $meja = KapasitasMeja::find($request->id_meja);
        $meja->status = 'Full';
        $meja->save();

        return redirect()->route('halaman-reservasi')->with('berhasil', 'Reservasi berhasil disimpan');
    }

    public function getAvailableTables($kuliner_id)
    {
        $meja = KapasitasMeja::where('kuliner_id', $kuliner_id)
            ->where('status', '!=', 'Full')
            ->get();
        return response()->json($meja);
    }



    public function show($id)
    {
        $user_id = Auth::id();
        $reservasi = Reservasi::findOrFail($id);
        $pembayaran = Pembayaran::where('reservasi_id', $id)->first();
        $reservasi = Reservasi::findOrFail($id);
        return view('show_bukti_pembayaran', compact('reservasi', 'pembayaran'));
    }

    public function showDetail($kuliner_id)
    {
        // Ambil data tempat kuliner berdasarkan ID
        $kuliner = Kuliner::findOrFail($kuliner_id);

        // Ambil metode pembayaran yang sesuai dengan kuliner_id
        $metodePembayaran = MetodePembayaran::where('kuliner_id', $kuliner_id)->get();

        // Ambil daftar meja yang tersedia berdasarkan ID tempat kuliner
        $meja = $kuliner->kapasitasMejas;

        // Dapatkan daftar id meja yang telah dipilih oleh pengguna lain
        $meja_dipilih_pengguna_lain = Reservasi::where('id_tempat', $kuliner_id)
            ->where('status', '!=', 'Dibatalkan')
            ->pluck('id_meja')
            ->toArray();

        return view('halaman_detailreservasi', compact('kuliner', 'metodePembayaran', 'meja', 'meja_dipilih_pengguna_lain'));
    }

    public function indexReservasi()
    {
        $reservasis = Reservasi::with(['tempatKuliner', 'meja', 'metodepembayaran', 'pembayaran'])->orderBy('created_at', 'desc')->get();
        // Kembalikan tampilan dengan data yang sesuai
        return view('indexreservasi', compact('reservasis'));
    }

    public function konfirmasiReservasi($id)
    {
        $reservasi = Reservasi::findOrFail($id);
        $reservasi->status = 'Belum Dibayar';
        $reservasi->save();

        // Redirect ke halaman yang sesuai
        return Redirect::back()->with('berhasil', 'Status reservasi berhasil diperbarui');
    }

    public function lunasReservasi($id)
    {
        $reservasi = Reservasi::findOrFail($id);
        $reservasi->status = 'Lunas';
        $reservasi->save();

        // Redirect ke halaman yang sesuai
        return redirect()->back()->with('berhasil', 'Status reservasi berhasil diperbarui menjadi Lunas');
    }

    // Fungsi untuk membatalkan reservasi
    public function cancelReservasi($id)
    {

        $reservasi = Reservasi::findOrFail($id);

        // Periksa apakah status reservasi tidak "Belum Dibayar"
        if ($reservasi->status !== 'Belum Dibayar') {
            // Hapus reservasi
            $reservasi->delete();

            return redirect()->back()->with('success', 'Reservasi berhasil dibatalkan');
        } else {
            return redirect()->back()->with('error', 'Reservasi tidak bisa dibatalkan karena sudah berhasil dikonfirmasi');
        }
    }

    public function hapusReservasi($id)
    {
        $reservasi = Reservasi::findOrFail($id);

        $reservasi->delete();
        return redirect()->back()->with('berhasil', 'Reservasi berhasil dihapus');
    }

    public function refresh()
    {
        $reservasis = Reservasi::all();

        return view('indexReservasi', compact('reservasis'));
    }
}
