<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    protected $table = 'ref_provinsi';

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('order', function (EloquentBuilder $builder) {
            $builder->orderBy('nama', 'asc');
        });
    }

    public function kabupaten()
    {
        return $this->hasMany(Kabupaten::class, 'kode_prop', 'kode_wilayah');
    }
}
