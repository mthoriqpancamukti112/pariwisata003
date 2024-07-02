<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;


use App\Models\Galeri;
use App\Models\Kategori;
use App\Models\Kuliner;
use App\Models\Makanan;
use App\Models\Pengunjung;
use App\Models\Reservasi;
use App\Models\Slider;
use App\Models\Tour;
use App\Models\Ulasan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class BerandaController extends Controller
{
    // public function detailkulinerEncrypted($encryptedId)
    // {
    //     // Dekripsi ID yang diterima
    //     $id = Crypt::decrypt($encryptedId);

    //     // Ambil data detail kuliner berdasarkan ID yang telah didekripsi
    //     $detailkuliner = Kuliner::findOrFail($id);

    //     // Ambil data menu makanan terkait
    //     $menu_makanan = Makanan::where('kuliner_id', $id)->get();

    //     // Ambil galeri pada tablle kuliner
    //     $galerikuliner = Kuliner::where('id', $id)->get();

    //     // Ambil ulasan dari reservasi yang terkait dengan kuliner ini
    //     $ulasan = Ulasan::whereHas('reservasi', function ($query) use ($id) {
    //         $query->where('id_tempat', $id);
    //     })->orderBy('created_at', 'desc')->get();

    //     // Kemudian kirim data detailkuliner, menu_makanan, galerikuliner, dan ulasan ke view
    //     return view('detail_kuliner', compact('detailkuliner', 'menu_makanan', 'galerikuliner', 'ulasan'));
    // }

    public function index()
    {
        $slider = Slider::all(); // Mengambil semua data slider dari model Slider
        $data_kuliner = kuliner::orderBy('created_at', 'desc')->get();

        return view("beranda", compact('slider', 'data_kuliner'));
    }

    public function detail($id)
    {
        $detail = Tour::find($id);
        return view("detail_wisata", compact('detail'));
    }

    // mengambil semua data Kuliner dan implementasi ke hal. detail_kuliner.php
    public function detailkuliner($id)
    {
        // fungsi ini dieksekusi di halaman detail_kuliner
        // Ambil data kuliner berdasarkan $id
        $detailkuliner = kuliner::findOrFail($id);


        // Pastikan kuliner ditemukan
        if (!$detailkuliner) {
            return abort(404); // Atau tindakan lain yang sesuai jika kuliner tidak ditemukan
        }

        // Ambil galeri pada tabel kuliner berdasarkan $id
        $galeri = json_decode($detailkuliner->galeri);

        // Ambil hanya 6 gambar dari galeri
        $slicedGaleri = array_slice($galeri, 0, 6);

        // Ambil data makanan terkait dengan kuliner beserta rating
        $menu_makanan = Makanan::with('ratings')->where('kuliner_id', $id)->get();

        // Ambil ulasan dari reservasi yang terkait dengan kuliner ini
        $ulasan = Ulasan::whereHas('reservasi', function ($query) use ($id) {
            $query->where('id_tempat', $id);
        })->orderBy('created_at', 'desc')->get();

        // Menghitung total rating ulasan
        $totalRatingUlasan = $detailkuliner->ulasans->sum('rating');
        $jumlahUlasan = $detailkuliner->ulasans->count();
        $ratingUlasan = $jumlahUlasan > 0 ? $totalRatingUlasan / $jumlahUlasan : 0;

        // Menghitung total rating makanan
        $totalRatingMakanan = $detailkuliner->ratings->sum('rating');
        $jumlahRatingMakanan = $detailkuliner->ratings->count();
        $ratingMakanan = $jumlahRatingMakanan > 0 ? $totalRatingMakanan / $jumlahRatingMakanan : 0;

        // Menghitung rata-rata rating dari ulasan dan makanan
        $totalRating = ($totalRatingUlasan + $totalRatingMakanan);
        $jumlahRating = ($jumlahUlasan + $jumlahRatingMakanan);
        $rating = $jumlahRating > 0 ? $totalRating / $jumlahRating : 0;


        // Menampilkan total rating menggunakan var_dump()
        // var_dump($jumlahRating);

        $rating = round($rating, 1); // Memastikan hanya satu digit setelah koma
        $rating = number_format($rating, 1); // Memformat menjadi satu digit setelah koma

        // Menggabungkan rata-rata rating dari ulasan dan makanan ke dalam objek detailkuliner
        $detailkuliner->rating = $rating;


        return view("detail_kuliner", compact('detailkuliner', 'menu_makanan', 'ulasan', 'slicedGaleri', 'jumlahRating'));
    }

    public function detailreservasi($id_tempat)
    {
        $tempat_kuliner = Kuliner::find($id_tempat);
        return view('halaman_detailreservasi', compact('tempat_kuliner'));
    }

    public function wisata()
    {
        $data = Tour::all();
        return view('halaman_wisata', compact('data'));
    }
    public function kuliner()
    {
        $data = Kuliner::with('ulasans', 'ratings')->orderBy('created_at', 'desc')->get(); // Mengambil semua data kuliner beserta ulasannya dan data rating

        $data->each(function ($kuliner) {
            // Menghitung total rating ulasan
            $totalRatingUlasan = $kuliner->ulasans->sum('rating');
            $jumlahUlasan = $kuliner->ulasans->count();
            $ratingUlasan = $jumlahUlasan > 0 ? $totalRatingUlasan / $jumlahUlasan : 0;

            // Menghitung total rating makanan
            $totalRatingMakanan = $kuliner->ratings->sum('rating');
            $jumlahRatingMakanan = $kuliner->ratings->count();
            $ratingMakanan = $jumlahRatingMakanan > 0 ? $totalRatingMakanan / $jumlahRatingMakanan : 0;

            // Menghitung rata-rata rating dari ulasan dan makanan
            $totalRating = ($totalRatingUlasan + $totalRatingMakanan);
            $jumlahRating = ($jumlahUlasan + $jumlahRatingMakanan);
            $rating = $jumlahRating > 0 ? $totalRating / $jumlahRating : 0;

            // Menggabungkan rata-rata rating dari ulasan dan makanan
            $kuliner->rating = $rating;
        });

        $kategori = Kategori::all(); // Ambil semua data kategori

        return view('halaman_kuliner', compact('data', 'kategori'));
    }

    public function galeri()
    {
        $galeri = Galeri::all();
        return view('halaman_galeri', compact('galeri'));
    }

    public function reservasi()
    {
        $reservasi = Reservasi::all();
        return view('halaman_reservasi', compact('reservasi'));
    }

    public function allgaleri($id)
    {
        // Ambil data kuliner berdasarkan $id
        $kuliner = Kuliner::find($id);

        // Pastikan kuliner ditemukan
        if (!$kuliner) {
            return abort(404); // Atau tindakan lain yang sesuai jika kuliner tidak ditemukan
        }

        // Ambil galeri pada tabel kuliner berdasarkan $id
        $galeri = json_decode($kuliner->galeri);

        // Kirim data kuliner dan galeri ke tampilan
        return view('semua-galeri', compact('kuliner', 'galeri'));
    }
}
