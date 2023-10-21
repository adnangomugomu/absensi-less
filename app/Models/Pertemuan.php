<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Pertemuan extends Model
{
    use SoftDeletes, HasUuids;
    protected $table = 'pertemuan';

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($pertemuan) {
            $pertemuan->absensi()->delete();
        });

        static::addGlobalScope('order', function (EloquentBuilder $builder) {
            $builder->orderBy('id', 'desc');
        });
    }

    public function absensi()
    {
        return $this->hasMany(Absensi::class, 'pertemuan_id', 'id');
    }
}
