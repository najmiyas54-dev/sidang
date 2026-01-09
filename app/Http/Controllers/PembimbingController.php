<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SidangRegistration;
use App\Models\JadwalSidang;
use App\Models\Chat;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PembimbingController extends Controller
{
    public function dashboard()
    {
        $dosenName = Auth::user()->name;
        
        // Only show proposal and skripsi with menunggu status
        $mahasiswaBimbingan = SidangRegistration::with(['user', 'jadwal'])
            ->where(function($query) use ($dosenName) {
                $query->where('dosen_pembimbing', 'LIKE', '%' . $dosenName . '%')
                      ->orWhere('dosen_pembimbing_2', 'LIKE', '%' . $dosenName . '%');
            })
            ->whereIn('jenis_sidang', ['proposal', 'skripsi'])
            ->where('status', 'menunggu')
            ->orderBy('created_at', 'desc')
            ->get();
            
        $jadwalSidang = JadwalSidang::with(['sidangRegistration.user'])
            ->whereHas('sidangRegistration', function($query) use ($dosenName) {
                $query->where('dosen_pembimbing', 'LIKE', '%' . $dosenName . '%')
                      ->orWhere('dosen_pembimbing_2', 'LIKE', '%' . $dosenName . '%');
            })
            ->where('tanggal', '>=', now()->format('Y-m-d'))
            ->orderBy('tanggal')
            ->orderBy('jam')
            ->get();
            
        $admin = User::where('role', 'admin')->first();
        $chats = Chat::where(function($query) use ($admin) {
                $query->where('sender_id', Auth::id())->where('receiver_id', $admin->id)
                      ->orWhere('sender_id', $admin->id)->where('receiver_id', Auth::id());
            })
            ->orderBy('created_at', 'asc')
            ->get();
            
        return view('pembimbing.dashboard', compact('mahasiswaBimbingan', 'jadwalSidang', 'chats', 'admin'));
    }
    
    public function sendMessage(Request $request)
    {
        $admin = User::where('role', 'admin')->first();
        
        Chat::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $admin->id,
            'message' => $request->message
        ]);
        
        return response()->json(['success' => true]);
    }
}