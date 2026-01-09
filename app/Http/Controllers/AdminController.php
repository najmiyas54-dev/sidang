<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SidangRegistration;
use App\Models\JadwalSidang;
use App\Models\Notification;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function mahasiswa()
    {
        return view('admin.mahasiswa');
    }

    public function verifikasi()
    {
        $registrations = SidangRegistration::with(['user', 'jadwal'])
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('admin.verifikasi', compact('registrations'));
    }

    public function verifikasiUpdate(Request $request, $id)
    {
        $registration = SidangRegistration::findOrFail($id);
        
        $registration->update([
            'admin_status' => $request->status,
            'admin_notes' => $request->keterangan,
            'admin_reviewed_at' => now()
        ]);
        
        // Update overall status based on workflow
        if ($request->status == 'approved') {
            $registration->update(['status' => 'menunggu_pembimbing']);
        } else {
            $registration->update(['status' => 'ditolak']);
        }

        // Create notification for student
        $title = $request->status == 'approved' ? 'Verifikasi Admin Diterima' : 'Verifikasi Admin Ditolak';
        $message = $request->status == 'approved' 
            ? 'Pendaftaran Anda telah diverifikasi admin. Menunggu persetujuan pembimbing.' 
            : 'Pendaftaran Anda ditolak oleh admin. ' . ($request->keterangan ?? '');
        $type = $request->status == 'approved' ? 'success' : 'danger';
        
        Notification::create([
            'user_id' => $registration->user_id,
            'title' => $title,
            'message' => $message,
            'type' => $type
        ]);

        return response()->json(['success' => true]);
    }

    public function jadwal()
    {
        return view('admin.jadwal');
    }

    public function jadwalCreate($id)
    {
        $registration = SidangRegistration::with('user')->findOrFail($id);
        return view('admin.jadwal-create', compact('registration'));
    }

    public function jadwalStore(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'jam' => 'required',
            'ruang' => 'required|string|max:255'
        ]);

        JadwalSidang::create([
            'sidang_registration_id' => $id,
            'tanggal' => $request->tanggal,
            'jam' => $request->jam,
            'ruang' => $request->ruang
        ]);

        return redirect()->route('admin.verifikasi')->with('success', 'Jadwal berhasil dibuat!');
    }

    public function laporan()
    {
        return view('admin.laporan');
    }
}