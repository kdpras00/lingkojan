<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nomor_pengaduan',
        'kategori',
        'subjek',
        'deskripsi',
        'alamat',
        'rt',
        'rw',
        'foto',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tindakLanjuts()
    {
        return $this->hasMany(TindakLanjut::class)->orderBy('created_at', 'desc');
    }
}
