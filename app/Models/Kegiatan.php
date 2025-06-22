<?php

namespace App\Models;

use App\Http\Controllers\UkmController;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    protected $table = "rehan_kegiatans";
    protected $guarded = ['id'];

    public function ukm()
    {
        return $this->belongsTo(Ukm::class);
    }

    public function anggota()
    {
        return $this->belongsTo(Anggota::class);
    }


}
