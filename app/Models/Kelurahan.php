<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Model;

class Kelurahan extends Model
{
    protected $table = 'ref_kelurahan';

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('order', function (EloquentBuilder $builder) {
            $builder->orderBy('nama', 'asc');
        });
    }
}
