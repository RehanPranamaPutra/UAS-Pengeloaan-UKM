<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ukm extends Model
{
    protected $table = 'rehan_ukms';
    protected $fillable = ['nama_ukm','slug', 'ketum', 'logo_ukm', 'deskripsi','email','telepon','website', 'thn_berdiri'];

    public function anggota()
    {
        return $this->hasMany(Anggota::class);
    }

    public function kegiatan()
    {
        return $this->hasMany(Kegiatan::class);
    }

    public function capaian()
    {
        return $this->hasMany(Capaian::class);
    }
}
