<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    public function index()
    {
        $users = [
            ['nama' => 'Fauzan Ganteng ', 
            'npm' => '2407051014',
            'jurusan' => 'Ilmu Komputer',
            'prodi' => 'D3 Manajemen Informatika',
        ],
         ['nama' => ' Ragah Mujahidin', 
            'npm' => '2407051015',
            'jurusan' => 'Ilmu Komputer',
            'prodi' => 'D3 Manajemen Informatika',
        ],
         ['nama' => 'Syawal Abrar ', 
            'npm' => '2407051002',
            'jurusan' => 'Ilmu Komputer',
            'prodi' => 'D3 Manajemen Informatika',
        ],
               ['nama' => 'Ujang Slayer', 
            'npm' => '2407051009',
            'jurusan' => 'Ilmu Komputer',
            'prodi' => 'D3 Manajemen Informatika',
        ],       ['nama' => 'MOh farrel', 
            'npm' => '2407051016',
            'jurusan' => 'Ilmu Komputer',
            'prodi' => 'D3 Manajemen Informatika',
        ]
        ];
        return view('user-management', compact('users'));
    }
}
