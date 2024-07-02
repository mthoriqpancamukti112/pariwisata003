<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kuliner extends Model
{
    use HasFactory;

    protected $table = 'kuliners';
    protected $fillable = [
        'image',
        'tempat_kuliner',
        'id_kategori',
        'deskripsi',
        'lokasi',
        'jam_operasional',
        'fasilitas',
        'kontak',
        'galeri',
        'tgl_upload',
    ];

    public function kategor()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id');
    }

    public function ulasans()
    {
        return $this->hasMany(Ulasan::class, 'id_tempat', 'id');
    }

    public function makanans()
    {
        return $this->hasMany(Makanan::class);
    }

    public function ratings(): HasMany
    {
        return $this->hasMany(Rating::class, 'kuliner_id', 'id');
    }

    public function kapasitasMejas()
    {
        return $this->hasMany(KapasitasMeja::class);
    }
}
