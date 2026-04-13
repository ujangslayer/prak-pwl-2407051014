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
           try {
            $request->validate([
                'nama' => 'required|string|max:255',
                'npm' => 'required|string|max:255',
                'kelas_id' => 'required|exists:kelas,id'
            ]);
            $this->userModel->create([
                'nama' => $request->input('nama'),
                'npm' => $request->input('npm'),
                'kelas_id' => $request->input('kelas_id')
            ]);
            Log::info('User created successfully');
            return redirect()->route('user-management.index')->with('success', 'User berhasil dibuat');
        } catch (Exception $e) {
            Log::error('User creation failed: ' . $e->getMessage());
            return redirect()->route('user-management.index')->with('error', 'User gagal dibuat');
        }
    }

    public function update(Request $request, $id)
    {
         try{
        $request->validate([
            'name' => 'required|string|max:255',
            'npm' => 'required|string|max:255',
            'kelas_id' => 'required|exists:kelas,id'
        ]);


        DB::transaction(function() use ($id, $request) {
            $user = UserModel::findOrFail($id);
            $user->update([
                'nama' => $request->input('nama'),
                'npm' => $request->input('npm'),
                'kelas_id' => $request->input('kelas_id')
            ]);
        });
        return redirect()->route('user-management.index')->with('success', 'User berhasil diupdate');
    }


        catch(Exception $e){
            Log::error('User update failed: ' . $e->getMessage());
            return redirect()->route('user-management.index')->with('error', 'User gagal diupdate');
        }

    }
    
    public function destroy($id)
    {
 $user = UserModel::findOrFail($id);
        $user->delete();
        return redirect()->route('user-management.index');
    
    }
}