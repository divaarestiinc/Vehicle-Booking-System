<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Menampilkan daftar semua user untuk dikelola Admin.
     */
    public function index()
    {
        // Mengambil semua user kecuali Admin yang sedang login agar tidak menonaktifkan diri sendiri
        $users = User::where('id', '!=', Auth::id())->get(); 
        return view('users.index', compact('users'));
    }

    /**
     * Memperbarui Role user (Admin atau Approver).
     */
    public function updateRole(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        // Validasi agar role yang dimasukkan sesuai dengan enum yang ada
        $request->validate([
            'role' => 'required|in:admin,approver'
        ]);

        $user->update(['role' => $request->role]);

        // Mencatat perubahan ke Activity Log agar muncul di Dashboard
        ActivityLog::create([
            'user_id' => Auth::id(),
            'user_name' => Auth::user()->name,
            'description' => "Update role {$user->name} menjadi " . strtoupper($request->role)
        ]);

        return back()->with('success', 'Role berhasil diperbarui.');
    }

    /**
     * Mengaktifkan atau Menonaktifkan akses login user.
     */
    public function toggleStatus($id)
    {
        $user = User::findOrFail($id);
        
        // Membalikkan status: jika true menjadi false, jika false menjadi true
        $user->is_active = !$user->is_active; 
        $user->save();

        $statusLabel = $user->is_active ? 'Mengaktifkan' : 'Menonaktifkan';
        
        // Log aktivitas pemutusan/pemberian akses
        ActivityLog::create([
            'user_id' => Auth::id(),
            'user_name' => Auth::user()->name,
            'description' => "{$statusLabel} akun: {$user->name}"
        ]);

        return back()->with('success', 'Status akun berhasil diubah.');
    }
}