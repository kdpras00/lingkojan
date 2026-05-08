<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PengaduanFoto extends Model
{
    protected $table = 'pengaduan_foto';
    public $timestamps = false;
    protected $fillable = ['nama_file', 'pengaduan_detail_id'];

    /**
     * @return BelongsTo
     */
    public function detail(): BelongsTo
    {
        return $this->belongsTo(PengaduanDetail::class, 'pengaduan_detail_id');
    }
}
