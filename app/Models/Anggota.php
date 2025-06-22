<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    protected $table = 'rehan_anggotas';
    protected $guarded = ['id'];

    public function ukm()
    {
        return $this->belongsTo(Ukm::class);
    }

    public function kegiatan()
    {
        return $this->hasMany(Kegiatan::class);
    }
}
