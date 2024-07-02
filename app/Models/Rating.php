<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $table = 'ratings';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id',
        'makanan_id',
        'kuliner_id',
        'rating',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function makanan()
    {
        return $this->belongsTo(Makanan::class, 'makanan_id', 'id');
    }
}
