<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ulasan extends Model
{
    use HasFactory;

    protected $table = 'ulasans';
    protected $fillable = ['komentar', 'rating', 'tgl_ulasan', 'reservasi_id', 'user_id', 'id_tempat'];

    // Relasi ke model Reservasi
    public function reservasi()
    {
        return $this->belongsTo(Reservasi::class, 'reservasi_id', 'id');
    }

    public function kulinertempat()
    {
        return $this->belongsTo(Kuliner::class, 'id_tempat', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // public function kuliner()
    // {
    //     return $this->belongsTo(Kuliner::class, 'reservasi_id');
    // }
    // Relasi ke model Kuliner

    // public function kuliner()
    // {
    //     return $this->belongsTo(Kuliner::class, 'id_tempat');
    // }
}
