<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Makanan extends Model
{
    use HasFactory;

    protected $table = 'makanans';
    protected $fillable = [
        'image',
        'kuliner_id',
        'nama',
    ];

    public function kulinertempat()
    {
        return $this->belongsTo(Kuliner::class, 'kuliner_id', 'id');
    }

    public function kuliner()
    {
        return $this->belongsTo(Kuliner::class);
    }

    public function ratings(): HasMany
    {
        return $this->hasMany(Rating::class, 'makanan_id', 'id');
    }
}
