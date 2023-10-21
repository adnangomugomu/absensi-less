<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Model;

class Kabupaten extends Model
{
    protected $table = 'ref_kabupaten';

    protected $orderBy = [
        'nama' => 'asc',
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('order', function (EloquentBuilder $builder) {
            $builder->orderBy('nama', 'asc');
        });
    }

    public function kecamatan()
    {
        return $this->hasMany(Kecamatan::class, 'kode_kab', 'kode_wilayah');
    }
}
