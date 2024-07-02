<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    use HasFactory;

    protected $table = 'tours';
    protected $fillable = [
        'image',
        'nama_wisata',
        'kategori',
        'fasilitas',
        'lokasi',
        'latitude',
        'longitude',
        'jam_operasional',
        'deskripsi'
    ];
}
