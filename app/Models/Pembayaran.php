<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayaran';

    protected $fillable = [
        'reservasi_id',
        'user_id',
        'nama_pengirim',
        'foto_bukti_pembayaran',
    ];

    public function reservasi()
    {
        return $this->belongsTo(Reservasi::class, 'reservasi_id', 'id');
    }
}
