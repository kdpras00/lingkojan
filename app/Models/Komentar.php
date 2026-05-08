<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Komentar extends Model
{
    protected $table = 'komentar';
    public $timestamps = false;
    protected $fillable = ['isi_komentar', 'users_id', 'pengaduan_detail_id'];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    /**
     * @return BelongsTo
     */
    public function detail(): BelongsTo
    {
        return $this->belongsTo(PengaduanDetail::class, 'pengaduan_detail_id');
    }
}
