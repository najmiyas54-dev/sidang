<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SidangRegistration;
use App\Models\DocumentVerification;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class DosenController extends Controller
{
    public function dashboard()
    {
        $dosenName = Auth::user()->name;
        
        $bimbinganList = SidangRegistration::where('dosen_pembimbing', 'LIKE', "%{$dosenName}%")
            ->orWhere('dosen_pembimbing_2', 'LIKE', "%{$dosenName}%")
            ->where('admin_status', 'approved')
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->get();
            
        $totalBimbingan = $bimbinganList->count();
        $menungguReview = $bimbinganList->where('pembimbing_status', 'pending')->count();
        $sudahDisetujui = $bimbinganList->where('pembimbing_status', 'approved')->count();
        
        return view('dosen.dashboard', compact('bimbinganList', 'totalBimbingan', 'menungguReview', 'sudahDisetujui'));
    }
    
    public function detailMahasiswa($id)
    {
        $registration = SidangRegistration::with('user')->findOrFail($id);
        $documents = DocumentVerification::where('sidang_registration_id', $id)->get();
        
        return view('dosen.detail-mahasiswa', compact('registration', 'documents'));
    }
    
    public function updateDocumentStatus(Request $request, $id)
    {
        $document = DocumentVerification::findOrFail($id);
        
        $document->update([
            'status' => $request->status,
            'admin_notes' => $request->notes
        ]);
        
        // Create notification for student
        Notification::create([
            'user_id' => $document->sidangRegistration->user_id,
            'title' => 'Update Dokumen',
            'message' => "Dokumen {$document->document_name} telah {$request->status}",
            'type' => $request->status == 'approved' ? 'success' : 'error'
        ]);
        
        return redirect()->back()->with('success', 'Status dokumen berhasil diupdate');
    }
    
    public function approveRegistration(Request $request, $id)
    {
        $registration = SidangRegistration::findOrFail($id);
        
        $registration->update([
            'pembimbing_status' => $request->status,
            'pembimbing_notes' => $request->notes,
            'pembimbing_reviewed_at' => now()
        ]);
        
        // Update overall status
        if ($request->status == 'approved') {
            $registration->update(['status' => 'diterima']);
        } else {
            $registration->update(['status' => 'ditolak']);
        }
        
        // Create notification for student
        $title = $request->status == 'approved' ? 'Pendaftaran Disetujui Pembimbing' : 'Pendaftaran Ditolak Pembimbing';
        $message = $request->status == 'approved' 
            ? 'Pendaftaran Anda telah disetujui pembimbing. Silakan tunggu jadwal sidang.' 
            : 'Pendaftaran Anda ditolak oleh pembimbing. ' . ($request->notes ?? '');
        $type = $request->status == 'approved' ? 'success' : 'danger';
        
        Notification::create([
            'user_id' => $registration->user_id,
            'title' => $title,
            'message' => $message,
            'type' => $type
        ]);
        
        return redirect()->back()->with('success', 'Status pendaftaran berhasil diupdate');
    }
}