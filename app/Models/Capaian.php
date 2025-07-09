<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Capaian extends Model
{
    protected $table = 'rehan_capaians';
    protected $guarded = ['id'];

    public function anggota()
    {
        return $this->belongsTo(Anggota::class);
    }

    public function ukm()
    {
        return $this->belongsTo(Ukm::class);
    }
}
