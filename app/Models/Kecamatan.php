<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    protected $table = 'ref_kecamatan';

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

    public function kelurahan()
    {
        return $this->hasMany(Kelurahan::class, 'kode_kec', 'kode_wilayah');
    }
}
