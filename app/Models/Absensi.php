<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Absensi extends Model
{
    use SoftDeletes;
    protected $table = 'absensi';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function pertemuan()
    {
        return $this->belongsTo(Pertemuan::class, 'pertemuan_id', 'id');
    }
}
