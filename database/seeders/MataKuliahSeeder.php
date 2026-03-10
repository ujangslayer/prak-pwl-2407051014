<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MataKuliahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data =[
            ['nama_mk' => 'Pemrograman Web Lanjut', 'sks' => 3],
            ['nama_mk' => 'Basis Data Lanjut', 'sks' => 3],
            ['nama_mk' => 'Jaringan Komputer', 'sks' => 3],
            ['nama_mk' => 'Sistem Operasi', 'sks' => 3],
        ];
        foreach($data as $mk){
            \App\Models\MataKuliahModel::create($mk);
        }
    }
}
