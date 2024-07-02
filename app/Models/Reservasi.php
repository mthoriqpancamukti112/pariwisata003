<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    use HasFactory;

    protected $table = 'reservasis';
    protected $fillable = [
        'id_tempat',
        'user_id',
        'id_meja',
        'id_metode_pembayaran',
        'nama_pengunjung',
        'no_hp',
        'email',
        'tgl_pesan',
        'jumlah_orang',
        'status',
    ];

    public function tempatKuliner()
    {
        return $this->belongsTo(Kuliner::class, 'id_tempat', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ulasan()
    {
        return $this->hasMany(Ulasan::class);
    }

    public function meja()
    {
        return $this->belongsTo(KapasitasMeja::class, 'id_meja', 'id');
    }

    public function metodepembayaran()
    {
        return $this->belongsTo(MetodePembayaran::class, 'id_metode_pembayaran', 'id');
    }

    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class, 'reservasi_id', 'id');
    }
}
