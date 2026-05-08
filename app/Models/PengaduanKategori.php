<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PengaduanKategori extends Model
{
    protected $table = 'pengaduan_kategori';
    public $timestamps = false;
    protected $fillable = ['kategori'];

    /**
     * @return HasMany
     */
    public function pengaduanHeaders(): HasMany
    {
        return $this->hasMany(PengaduanHeader::class, 'pengaduan_kategori_id');
    }
}
