<?php

namespace App\Http\Controllers;

use App\Models\Kuliner;
use App\Models\Makanan;
use App\Models\Rating;
use App\Models\User;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class RatingController extends Controller
{

    public function index()
    {
        return view('rating.index');
    }

    public function store(Request $request)
    {
        // Validasi data yang dikirimkan oleh formulir
        $validatedData = $request->validate([
            'rating' => 'required|integer|min:1',
            'makanan_id' => 'required|exists:makanans,id',
            // Sesuaikan validasi dengan kebutuhan Anda, misalnya untuk user_id jika Anda ingin menyimpan informasi pengguna yang memberikan rating
        ]);

        // Ambil makanan berdasarkan makanan_id yang diberikan
        $makanan = Makanan::findOrFail($validatedData['makanan_id']);

        // Mendapatkan id kuliner berdasarkan makanan_id
        $kulinerId = $makanan->kuliner_id;

        // Periksa apakah data reservasi sudah ada dalam database
        $existingRating = Rating::where('makanan_id', $request->makanan_id)
            ->where('rating', $request->rating)
            ->exists();
        // Jika data ulasan sudah ada, kembalikan dengan redirect back dan pesan kesalahan
        if ($existingRating) {
            return redirect()->route('detail_kuliner', ['id' => $kulinerId])->withErrors(['error' => 'Rating sudah ada.']);
        }

        // Simpan rating ke dalam database
        $rating = new Rating();
        $rating->rating = $validatedData['rating'];
        $rating->makanan_id = $validatedData['makanan_id'];
        $rating->kuliner_id = $makanan->kulinertempat->id;
        // Jika Anda memiliki kolom user_id, Anda bisa tambahkan informasi pengguna yang memberikan rating
        $rating->user_id = auth()->user()->id;
        $rating->save();

        // Arahkan ke halaman detail kuliner dengan mengirimkan id kuliner
        return Redirect::route('detail_kuliner', ['id' => $kulinerId])->with('success', 'Penilaian berhasil ditambahkan');
    }


    public function showRatingForm($id)
    {
        // Ambil data makanan berdasarkan $id
        $makanan = Makanan::findOrFail($id);

        // Periksa apakah pengguna telah memberikan rating untuk makanan ini
        $user = auth()->user();
        if ($user && $makanan->ratings()->where('user_id', $user->id)->exists()) {
            // Jika iya, lempar pengecualian HttpResponseException
            return redirect()->back()->with('error', 'Anda sudah memberikan rating untuk makanan ini.');
        }

        return view('form-rating', ['makanan_id' => $id, 'makanan' => $makanan]);
    }
}
