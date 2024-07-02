<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MetodePembayaran extends Model
{
    use HasFactory;

    protected $table = 'metode_pembayarans';
    protected $fillable = [
        'kuliner_id',
        'nama_metode',
        'nomor',
        'nama',
        'biaya',
    ];

    public function kuliner(): BelongsTo
    {
        return $this->belongsTo(Kuliner::class);
    }
}
