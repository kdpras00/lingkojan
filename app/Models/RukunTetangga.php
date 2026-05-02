<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RukunTetangga extends Model
{
    use HasFactory;

    protected $table = 'rukun_tetangga';

    protected $fillable = [
        'nomor',
        'nama_ketua',
    ];
}
