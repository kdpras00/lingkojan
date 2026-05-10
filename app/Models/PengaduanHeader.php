<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PengaduanHeader extends Model
{
    protected $table = 'pengaduan_header';
    public $timestamps = false;
    protected $fillable = ['subject', 'nomor_pengaduan', 'pengaduan_kategori_id'];

    /**
     * @return BelongsTo
     */
    public function kategori(): BelongsTo
    {
        return $this->belongsTo(PengaduanKategori::class, 'pengaduan_kategori_id');
    }

    /**
     * @return HasMany
     */
    public function details(): HasMany
    {
        return $this->hasMany(PengaduanDetail::class, 'pengaduan_header_id');
    }

    /**
     * Get the created_at attribute from the first detail.
     */
    public function getCreatedAtAttribute()
    {
        $firstDetail = $this->details->sortBy('id')->first();
        return $firstDetail ? \Carbon\Carbon::parse($firstDetail->tgl) : \Carbon\Carbon::now();
    }
}
