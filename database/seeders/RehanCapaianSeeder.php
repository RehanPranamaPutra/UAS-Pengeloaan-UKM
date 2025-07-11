<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RehanCapaianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $capaians = [
            [
                'ukm_id' => 1,
                'anggota_id' => 1, // Andini dari UKM 1
                'judul_prestasi' => 'Juara 1 Lomba Tari Tradisional',
                'deskripsi_prestasi' => 'Memenangkan kompetisi tingkat regional di Surabaya.',
                'tanggal' => '2024-11-12',
                'tingkat' => 'Regional',
                'dokumentasi_capaian' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/4/4f/Trophy_icon.svg/1024px-Trophy_icon.svg.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ukm_id' => 2,
                'anggota_id' => 3, // Fajar dari UKM 2
                'judul_prestasi' => 'Top Scorer Liga Mahasiswa',
                'deskripsi_prestasi' => 'Mencetak 12 gol dalam 6 pertandingan tingkat nasional.',
                'tanggal' => '2024-08-20',
                'tingkat' => 'Nasional',
                'dokumentasi_capaian' => 'https://cdn-icons-png.flaticon.com/512/164/164375.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ukm_id' => 3,
                'anggota_id' => 4, // Salsabila dari UKM 3
                'judul_prestasi' => 'Medali Perunggu Kontes Robotik Internasional',
                'deskripsi_prestasi' => 'Tim meraih juara 3 di ajang internasional di Korea.',
                'tanggal' => '2024-05-10',
                'tingkat' => 'Internasional',
                'dokumentasi_capaian' => 'https://cdn-icons-png.flaticon.com/512/3211/3211522.png',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        DB::table('rehan_capaians')->insert($capaians);
    }
}
