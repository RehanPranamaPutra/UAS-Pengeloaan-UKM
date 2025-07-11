<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RehanUkmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $ukms = [
            [
                'nama_ukm' => 'UKM Seni Tari',
                'slug' => Str::slug('UKM Seni Tari'),
                'ketum' => 'Dewi Lestari',
                'logo_ukm' => 'https://upload.wikimedia.org/wikipedia/commons/5/50/Dance_icon.png',
                'deskripsi' => 'UKM yang mewadahi minat dan bakat mahasiswa dalam seni tari tradisional dan modern.',
                'email' => 'seni@kampus.ac.id',
                'telepon' => '081234567890',
                'website' => 'https://ukm-senitari.kampus.ac.id',
                'thn_berdiri' => '2018-09-01',
            ],
            [
                'nama_ukm' => 'UKM Sepak Bola',
                'slug' => Str::slug('UKM Sepak Bola'),
                'ketum' => 'Budi Santoso',
                'logo_ukm' => 'https://cdn-icons-png.flaticon.com/512/236/236831.png',
                'deskripsi' => 'Tempat berkumpulnya mahasiswa dengan semangat olahraga dan prestasi di bidang sepak bola.',
                'email' => 'bola@kampus.ac.id',
                'telepon' => '082234567890',
                'website' => 'https://ukm-sepakbola.kampus.ac.id',
                'thn_berdiri' => '2017-07-15',
            ],
            [
                'nama_ukm' => 'UKM Robotik',
                'slug' => Str::slug('UKM Robotik'),
                'ketum' => 'Satria Pranata',
                'logo_ukm' => 'https://cdn-icons-png.flaticon.com/512/194/194938.png',
                'deskripsi' => 'UKM ini fokus pada pengembangan robot dan inovasi teknologi berbasis mikrokontroler.',
                'email' => 'robotik@kampus.ac.id',
                'telepon' => '083345678901',
                'website' => 'https://ukm-robotik.kampus.ac.id',
                'thn_berdiri' => '2019-01-10',
            ],
        ];

        DB::table('rehan_ukms')->insert($ukms);
    }
}
