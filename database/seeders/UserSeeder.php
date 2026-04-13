<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kelas;
use App\Models\UserModel;
use Illuminate\Support\Facades\Hash; 

class UserSeeder extends Seeder
{
     public function run(): void
    {
        // 1. Buat Akun Dosen
        $dosen = UserModel::create([
            'nama' => 'DosenIlkomp',
            'npm' => '1234567890',
            'email' => 'dosen@test.com',              
            'password' => Hash::make('password123'),  
            'role' => 'dosen',                        
            'kelas_id' => Kelas::where('nama_kelas', 'B')->first()->id ?? 1
        ]);

        $dosen->assignRole('dosen');

       
        $mahasiswa = UserModel::create([
            'nama' => 'MahasiswaIlkomp',
            'npm' => '1234567891',
            'email' => 'mahasiswa@test.com',          
            'password' => Hash::make('password123'),  
            'role' => 'mahasiswa',                    
            'kelas_id' => Kelas::where('nama_kelas', 'A')->first()->id ?? 1
        ]);

        UserModel::create([
            'nama' => 'Fauzan',
            'npm' => '2407051014',
            'email' => 'fauzan@test.com',             
            'password' => Hash::make('password123'),  
            'role' => 'mahasiswa',                    
            'kelas_id' => Kelas::where('nama_kelas', 'A')->first()->id ?? 1
        ]);
    }
}