<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KapasitasMeja extends Model
{
    use HasFactory;
    protected $fillable = [
        'kuliner_id',
        'nama_meja',
        'jumlah',
        'user_id',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kuliner()
    {
        return $this->belongsTo(Kuliner::class, 'kuliner_id', 'id');
    }
}
