<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Kuliner;
use App\Models\Makanan;
use App\Models\Pengunjung;
use App\Models\Rating;
use App\Models\Reservasi;
use App\Models\Ulasan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $jumlah_kuliner = Kuliner::count();
        $jumlah_makanan = Makanan::count();
        $jumlah_ulasan = Ulasan::count();
        $jumlah_reservasi = Reservasi::count();
        $jumlah_kategori = Kategori::count();
        $jumlah_rating = Rating::count();

        return view("dashboard.index", compact('jumlah_kuliner', 'jumlah_makanan', 'jumlah_ulasan', 'jumlah_reservasi', 'jumlah_kategori', 'jumlah_rating'));
    }
}
