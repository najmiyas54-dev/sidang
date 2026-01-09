<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $role = $request->input('role');
        
        // Debug: tampilkan data yang diterima
        \Log::info('Login attempt', $request->all());
        
        // Validasi berdasarkan role
        if ($role === 'mahasiswa') {
            $credentials = $request->validate([
                'nim' => 'required',
                'password' => 'required',
                'role' => 'required|in:mahasiswa,pembimbing,admin'
            ]);
            
            $loginData = [
                'nim' => $credentials['nim'],
                'password' => $credentials['password'],
                'role' => 'mahasiswa'
            ];
            
        } elseif ($role === 'pembimbing') {
            $credentials = $request->validate([
                'nip' => 'required',
                'password' => 'required',
                'role' => 'required|in:mahasiswa,pembimbing,admin'
            ]);
            
            $loginData = [
                'nip' => $credentials['nip'],
                'password' => $credentials['password'],
                'role' => 'pembimbing'
            ];
            
        } elseif ($role === 'admin') {
            $credentials = $request->validate([
                'nip' => 'required',
                'email' => 'required|email',
                'password' => 'required',
                'role' => 'required|in:mahasiswa,pembimbing,admin'
            ]);
            
            $loginData = [
                'nip' => $credentials['nip'],
                'email' => $credentials['email'],
                'password' => $credentials['password'],
                'role' => 'admin'
            ];
        } else {
            return back()->withErrors(['role' => 'Role tidak valid.']);
        }

        \Log::info('Login data', $loginData);
        
        // Cek user di database
        $user = User::where($loginData)->first();
        \Log::info('User found', ['user' => $user]);

        if (Auth::attempt($loginData)) {
            $request->session()->regenerate();
            
            switch ($role) {
                case 'mahasiswa':
                    return redirect()->route('mahasiswa.dashboard');
                case 'pembimbing':
                    return redirect()->route('dosen.dashboard');
                case 'admin':
                    return redirect()->route('admin.dashboard');
                default:
                    return redirect('/');
            }
        }

        return back()->withErrors([
            'login' => 'Login gagal. Periksa kredensial dan role Anda.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}