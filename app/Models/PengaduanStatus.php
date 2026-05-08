<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PengaduanStatus extends Model
{
    protected $table = 'pengaduan_status';
    public $timestamps = false;
    protected $fillable = ['status'];

    /**
     * @return HasMany
     */
    public function pengaduanDetails(): HasMany
    {
        return $this->hasMany(PengaduanDetail::class, 'pengaduan_status_id');
    }
}
