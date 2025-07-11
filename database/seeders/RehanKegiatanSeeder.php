<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RehanKegiatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kegiatans = [
            [
                'ukm_id' => 1,
                'anggota_id' => 1,
                'nama_kegiatan' => 'Pelatihan Tari Tradisional',
                'tgl_kegiatan' => '2025-08-10',
                'status' => 'Akan Datang',
                'dokumentasi' => 'https://upload.wikimedia.org/wikipedia/commons/5/50/Dance_icon.png',
                'keterangan' => 'Pelatihan tari rutin untuk anggota baru UKM Seni Tari.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ukm_id' => 2,
                'anggota_id' => 3,
                'nama_kegiatan' => 'Turnamen Sepak Bola Antar Fakultas',
                'tgl_kegiatan' => '2025-07-01',
                'status' => 'Selesai',
                'dokumentasi' => 'https://cdn-icons-png.flaticon.com/512/236/236831.png',
                'keterangan' => 'Turnamen tahunan antar fakultas untuk mempererat persaudaraan.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ukm_id' => 3,
                'anggota_id' => 4,
                'nama_kegiatan' => 'Workshop Robot Line Follower',
                'tgl_kegiatan' => '2025-07-15',
                'status' => 'Sedang Berlangsung',
                'dokumentasi' => 'https://cdn-icons-png.flaticon.com/512/194/194938.png',
                'keterangan' => 'Pelatihan dasar robotik menggunakan sensor IR dan Arduino.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('rehan_kegiatans')->insert($kegiatans);
    }
}
