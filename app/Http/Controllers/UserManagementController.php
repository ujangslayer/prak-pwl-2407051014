<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\UserModel;
use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $kelas_id = $request->input('kelas_id');

        $query = UserModel::with('kelas');

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('npm', 'like', "%{$search}%");
            });
        }

        if ($kelas_id) {
            $query->where('kelas_id', $kelas_id);
        }

        $users = $query->latest()->paginate(5)->appends($request->all());
        
        $kelas = Kelas::all(); 

        return view('user-management', compact('users', 'kelas'));
    }

    public function create()
    {
        $kelas = Kelas::all();
        return view('create-user', compact('kelas'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'npm' => 'required|string|max:255',
            'kelas_id' => 'required|exists:kelas,id'
        ]);

        UserModel::create([
            'nama' => $request->input('nama'),
            'npm' => $request->input('npm'),
            'kelas_id' => $request->input('kelas_id')
        ]);

        return redirect()->route('user-management')->with('success', 'Data User berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'npm' => 'required|string|max:255',
            'kelas_id' => 'required|exists:kelas,id'
        ]);

        $user = UserModel::findOrFail($id);
        $user->update([
            'nama' => $request->input('nama'),
            'npm' => $request->input('npm'),
            'kelas_id' => $request->input('kelas_id')
        ]);
        return redirect()->route('user-management')->with('success', 'Data User berhasil diperbarui!');
    }
    
    public function destroy($id)
    {
        $user = UserModel::findOrFail($id);
        $user->delete();
        return redirect()->route('user-management')->with('success', 'Data User berhasil dihapus!');
    }
}