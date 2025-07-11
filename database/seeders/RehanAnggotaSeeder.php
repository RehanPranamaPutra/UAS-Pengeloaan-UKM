<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RehanAnggotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $anggotas = [
            [
                'ukm_id' => 1,
                'nama' => 'Andini Rahmawati',
                'nim' => '210101001',
                'email' => 'andini@ukm.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ukm_id' => 1,
                'nama' => 'Rizky Maulana',
                'nim' => '210101002',
                'email' => 'rizky@ukm.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ukm_id' => 2,
                'nama' => 'Fajar Nugroho',
                'nim' => '210102001',
                'email' => 'fajar@ukm.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ukm_id' => 3,
                'nama' => 'Salsabila Putri',
                'nim' => '210103001',
                'email' => 'salsa@ukm.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('rehan_anggotas')->insert($anggotas);
    }
}
