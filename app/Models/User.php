<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, HasUuids;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($user) {
            $user->absensi()->delete();
        });

        static::addGlobalScope('order', function (EloquentBuilder $builder) {
            $builder->orderBy('name', 'asc');
        });
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }

    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class, 'kode_prop', 'kode_wilayah');
    }

    public function kabupaten()
    {
        return $this->belongsTo(Kabupaten::class, 'kode_kab', 'kode_wilayah');
    }

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'kode_kec', 'kode_wilayah');
    }

    public function kelurahan()
    {
        return $this->belongsTo(Kelurahan::class, 'kode_kel', 'kode_wilayah');
    }

    public function absensi()
    {
        return $this->hasMany(Absensi::class, 'user_id', 'id');
    }    
}
