<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Kategori;
use App\Models\Kuliner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function index()
    {
        return view('halaman-favorite');
    }
}
