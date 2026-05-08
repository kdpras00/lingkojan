<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_warga',
        'username',
        'password',
        'role_id',
        'no_tlp',
        'email',
        'alamat',
        'rt_id',
        'nik',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * @return BelongsTo
     */
    public function role_ref(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    /**
     * Check if user has a specific role.
     *
     * @param string $role
     * @return bool
     */
    public function hasRole($role): bool
    {
        $roleMapping = [
            'admin' => 'Admin',
            'warga' => 'Warga',
            'rt' => 'Ketua RT',
            'rw' => 'Ketua RW',
            'petugas' => 'Petugas',
        ];

        $targetRoleName = $roleMapping[strtolower($role)] ?? $role;
        
        return $this->role_ref && $this->role_ref->name_role === $targetRoleName;
    }

    /**
     * Assign a role to the user.
     * 
     * @param string $roleName
     * @return void
     */
    public function assignRole($roleName): void
    {
        $roleMapping = [
            'admin' => 'Admin',
            'warga' => 'Warga',
            'rt' => 'Ketua RT',
            'rw' => 'Ketua RW',
            'petugas' => 'Petugas',
        ];

        $targetRoleName = $roleMapping[strtolower($roleName)] ?? $roleName;
        $role = Role::where('name_role', $targetRoleName)->first();
        
        if ($role) {
            $this->update(['role_id' => $role->id]);
        }
    }

    /**
     * @return BelongsTo
     */
    public function rt(): BelongsTo
    {
        return $this->belongsTo(Rt::class, 'rt_id');
    }

    /**
     * @return HasMany
     */
    public function pengaduanDetails(): HasMany
    {
        return $this->hasMany(PengaduanDetail::class, 'users_id');
    }

    /**
     * @return HasMany
     */
    public function komentar(): HasMany
    {
        return $this->hasMany(Komentar::class, 'users_id');
    }
}
