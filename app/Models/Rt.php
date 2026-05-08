<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Rt extends Model
{
    protected $table = 'rt';
    public $timestamps = false;
    protected $fillable = ['nama_rt'];

    /**
     * @return HasMany
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'rt_id');
    }
}
