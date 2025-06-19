<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ukm extends Model
{
    protected $fillable = ['nama_ukm', 'ketum', 'logo_ukm', 'deskripsi', 'thn_berdiri'];
}
