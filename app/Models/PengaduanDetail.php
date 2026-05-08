<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PengaduanDetail extends Model
{
    protected $table = 'pengaduan_detail';
    public $timestamps = false;
    protected $fillable = [
        'detail_pengaduan',
        'tgl',
        'pengaduan_header_id',
        'pengaduan_status_id',
        'users_id'
    ];

    /**
     * @return BelongsTo
     */
    public function header(): BelongsTo
    {
        return $this->belongsTo(PengaduanHeader::class, 'pengaduan_header_id');
    }

    /**
     * @return BelongsTo
     */
    public function status(): BelongsTo
    {
        return $this->belongsTo(PengaduanStatus::class, 'pengaduan_status_id');
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    /**
     * @return HasMany
     */
    public function fotos(): HasMany
    {
        return $this->hasMany(PengaduanFoto::class, 'pengaduan_detail_id');
    }

    /**
     * @return HasMany
     */
    public function komentar(): HasMany
    {
        return $this->hasMany(Komentar::class, 'pengaduan_detail_id');
    }
}
