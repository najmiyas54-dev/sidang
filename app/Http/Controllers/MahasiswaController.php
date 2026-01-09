<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SidangRegistration;
use App\Models\Announcement;
use App\Models\Notification;
use App\Models\RequirementFile;
use App\Models\DocumentVerification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use PDF;

class MahasiswaController extends Controller
{
    public function dashboard()
    {
        $registrations = SidangRegistration::with('jadwal')
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();
            
        $announcements = Announcement::where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();
            
        $notifications = Notification::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
            
        $kpRegistration = $registrations->where('jenis_sidang', 'kerja_praktik')->first();
        $proposalRegistration = $registrations->where('jenis_sidang', 'proposal')->first();
        $skripsiRegistration = $registrations->where('jenis_sidang', 'skripsi')->first();
        
        // Get document verifications for registrations if exists
        $kpDocuments = $kpRegistration ? DocumentVerification::where('sidang_registration_id', $kpRegistration->id)->get() : collect();
        $proposalDocuments = $proposalRegistration ? DocumentVerification::where('sidang_registration_id', $proposalRegistration->id)->get() : collect();
        $skripsiDocuments = $skripsiRegistration ? DocumentVerification::where('sidang_registration_id', $skripsiRegistration->id)->get() : collect();
        
        $kpStatus = $kpRegistration ? $this->getWorkflowStatus($kpRegistration) : 'Belum Daftar';
        $proposalStatus = $proposalRegistration ? $this->getWorkflowStatus($proposalRegistration) : 'Belum Daftar';
        $skripsiStatus = $skripsiRegistration ? $this->getWorkflowStatus($skripsiRegistration) : 'Belum Daftar';
        
        $latestRegistration = $registrations->first();
        $canRegister = !$latestRegistration || $latestRegistration->status != 'menunggu';
        $jadwalSidang = $latestRegistration && $latestRegistration->status == 'diterima' ? $latestRegistration->jadwal : null;
        
        return view('mahasiswa.dashboard', compact(
            'registrations', 'announcements', 'notifications', 'latestRegistration', 'canRegister', 'jadwalSidang',
            'kpRegistration', 'proposalRegistration', 'skripsiRegistration', 'kpDocuments', 'proposalDocuments', 'skripsiDocuments',
            'kpStatus', 'proposalStatus', 'skripsiStatus'
        ));
    }

    public function profileEdit()
    {
        return view('mahasiswa.profile-edit');
    }

    public function profileUpdate(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'no_hp' => 'nullable|string|max:15',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'current_password' => 'nullable|string',
            'new_password' => 'nullable|string|min:8|confirmed',
        ]);

        $user = Auth::user();
        
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'no_hp' => $request->no_hp
        ];
        
        // Handle photo upload
        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($user->photo && Storage::disk('public')->exists($user->photo)) {
                Storage::disk('public')->delete($user->photo);
            }
            
            $photoPath = $request->file('photo')->store('photos', 'public');
            $data['photo'] = $photoPath;
        }
        
        // Handle password change
        if ($request->filled('current_password') && $request->filled('new_password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return redirect()->back()->withErrors(['current_password' => 'Password lama tidak sesuai']);
            }
            
            $data['password'] = Hash::make($request->new_password);
        }

        $user->update($data);

        return redirect()->route('mahasiswa.profile.edit')->with('success', 'Profil berhasil diupdate!');
    }

    public function register()
    {
        return view('mahasiswa.register');
    }

    public function registerStore(Request $request)
    {
        $request->validate([
            'jenis_sidang' => 'required|in:kerja_praktik,proposal,skripsi',
            'judul' => 'required|string|max:255',
            'dosen_pembimbing' => 'required|string|max:255'
        ]);

        // Cek apakah mahasiswa sudah pernah daftar untuk jenis sidang ini
        $existingRegistration = SidangRegistration::where('user_id', Auth::id())
            ->where('jenis_sidang', $request->jenis_sidang)
            ->first();

        if ($existingRegistration) {
            return redirect()->back()->withErrors([
                'jenis_sidang' => 'Anda sudah pernah mendaftar untuk ' . ucwords(str_replace('_', ' ', $request->jenis_sidang)) . '. Tidak dapat mendaftar ulang.'
            ]);
        }

        $data = [
            'user_id' => Auth::id(),
            'jenis_sidang' => $request->jenis_sidang,
            'judul' => $request->judul,
            'dosen_pembimbing' => $request->dosen_pembimbing,
            'status' => 'menunggu'
        ];

        // Add specific fields based on jenis_sidang
        if ($request->jenis_sidang == 'kerja_praktik') {
            $data['tempat_kp'] = $request->tempat_kp;
            $data['durasi'] = $request->durasi;
            
            // Handle multiple file uploads for KP
            $files = [
                'surat_permohonan' => 'Surat Permohonan Seminar KP',
                'surat_bimbingan' => 'Surat Selesai Bimbingan',
                'penilaian_perusahaan' => 'Penilaian Perusahaan',
                'draft_laporan' => 'Draft Laporan KP',
                'kartu_bimbingan' => 'Kartu Bimbingan KP',
                'bebas_keuangan' => 'Surat Bebas Keuangan'
            ];
            
            $uploadedFiles = [];
            
            foreach ($files as $fileField => $fileName) {
                if ($request->hasFile($fileField)) {
                    $filePath = $request->file($fileField)->store('persyaratan/kp', 'public');
                    $uploadedFiles[$fileField] = $filePath;
                }
            }
            
            $data['file_persyaratan'] = json_encode($uploadedFiles);
            
            // Create registration first
            $registration = SidangRegistration::create($data);
            
            // Create document verification records
            foreach ($files as $fileField => $fileName) {
                if (isset($uploadedFiles[$fileField])) {
                    DocumentVerification::create([
                        'sidang_registration_id' => $registration->id,
                        'document_type' => $fileField,
                        'document_name' => $fileName,
                        'file_path' => $uploadedFiles[$fileField],
                        'status' => 'pending'
                    ]);
                }
            }
            
            return redirect()->route('mahasiswa.dashboard')->with('success', 'Pendaftaran berhasil dikirim!');
            
                        } elseif ($request->jenis_sidang == 'proposal') {
            $data['bidang_penelitian'] = $request->bidang_penelitian;
            
            // Handle multiple file uploads for Proposal
            $files = [
                'surat_permohonan_proposal' => 'Surat Permohonan Seminar Proposal Skripsi',
                'surat_bimbingan_proposal' => 'Surat Keterangan Selesai Bimbingan',
                'draft_laporan_proposal' => 'Draft Laporan Proposal',
                'bebas_keuangan_proposal' => 'Surat Bebas Kewajiban Keuangan'
            ];
            
            $uploadedFiles = [];
            
            foreach ($files as $fileField => $fileName) {
                if ($request->hasFile($fileField)) {
                    $filePath = $request->file($fileField)->store('persyaratan/proposal', 'public');
                    $uploadedFiles[$fileField] = $filePath;
                }
            }
            
            $data['file_persyaratan'] = json_encode($uploadedFiles);
            
            // Create registration first
            $registration = SidangRegistration::create($data);
            
            // Create document verification records
            foreach ($files as $fileField => $fileName) {
                if (isset($uploadedFiles[$fileField])) {
                    DocumentVerification::create([
                        'sidang_registration_id' => $registration->id,
                        'document_type' => $fileField,
                        'document_name' => $fileName,
                        'file_path' => $uploadedFiles[$fileField],
                        'status' => 'pending'
                    ]);
                }
            }
            
            return redirect()->route('mahasiswa.dashboard')->with('success', 'Pendaftaran berhasil dikirim!');
            
        } elseif ($request->jenis_sidang == 'skripsi') {
            $data['dosen_pembimbing_2'] = $request->dosen_pembimbing_2;
            $data['progress'] = $request->progress;
            
            // Handle multiple file uploads for Skripsi
            $files = [
                'transkrip_nilai' => 'Transkrip Nilai',
                'sertifikat_kp' => 'Sertifikat KP',
                'surat_permohonan_skripsi' => 'Surat Permohonan Sidang Skripsi',
                'surat_bimbingan_skripsi' => 'Surat Selesai Bimbingan',
                'draft_skripsi' => 'Draft Skripsi Lengkap',
                'bebas_keuangan_skripsi' => 'Surat Bebas Keuangan'
            ];
            
            $uploadedFiles = [];
            
            foreach ($files as $fileField => $fileName) {
                if ($request->hasFile($fileField)) {
                    $filePath = $request->file($fileField)->store('persyaratan/skripsi', 'public');
                    $uploadedFiles[$fileField] = $filePath;
                }
            }
            
            $data['file_persyaratan'] = json_encode($uploadedFiles);
            
            // Create registration first
            $registration = SidangRegistration::create($data);
            
            // Create document verification records
            foreach ($files as $fileField => $fileName) {
                if (isset($uploadedFiles[$fileField])) {
                    DocumentVerification::create([
                        'sidang_registration_id' => $registration->id,
                        'document_type' => $fileField,
                        'document_name' => $fileName,
                        'file_path' => $uploadedFiles[$fileField],
                        'status' => 'pending'
                    ]);
                }
            }
            
            return redirect()->route('mahasiswa.dashboard')->with('success', 'Pendaftaran berhasil dikirim!');
        }

        SidangRegistration::create($data);

        return redirect()->route('mahasiswa.dashboard')->with('success', 'Pendaftaran berhasil dikirim!');
    }
    
    private function getWorkflowStatus($registration)
    {
        if ($registration->admin_status == 'pending') {
            return 'Review Admin';
        } elseif ($registration->admin_status == 'rejected') {
            return 'Ditolak Admin';
        } elseif ($registration->pembimbing_status == 'pending') {
            return 'Review Pembimbing';
        } elseif ($registration->pembimbing_status == 'rejected') {
            return 'Ditolak Pembimbing';
        } elseif ($registration->status == 'diterima') {
            return 'Disetujui';
        }
        return ucfirst($registration->status);
    }

    public function bukti($id)
    {
        $registration = SidangRegistration::where('user_id', Auth::id())->findOrFail($id);
        
        $data = [
            'registration' => $registration,
            'user' => Auth::user()
        ];
        
        return view('mahasiswa.bukti', $data);
    }

    public function upload(Request $request)
    {
        $jenis_sidang = $request->get('jenis', 'kerja_praktik');
        return view('mahasiswa.upload-requirements', compact('jenis_sidang'));
    }
    
    public function uploadStore(Request $request)
    {
        $jenis_sidang = $request->jenis_sidang;
        
        // Validasi berdasarkan jenis sidang
        if ($jenis_sidang == 'kerja_praktik') {
            $request->validate([
                'laporan_kp' => 'required|file|mimes:pdf|max:10240',
                'surat_selesai_kp' => 'required|file|mimes:pdf|max:5120',
                'logbook_kp' => 'required|file|mimes:pdf|max:5120',
                'penilaian_pembimbing' => 'required|file|mimes:pdf|max:5120',
                'surat_keaslian' => 'required|file|mimes:pdf|max:5120',
                'sertifikat_kp' => 'nullable|file|mimes:pdf|max:5120',
            ]);
        } else {
            $request->validate([
                'draft_proposal' => 'required|file|mimes:pdf|max:15360',
                'persetujuan_pembimbing' => 'required|file|mimes:pdf|max:5120',
                'transkrip_nilai' => 'required|file|mimes:pdf|max:5120',
                'krs_semester' => 'required|file|mimes:pdf|max:5120',
                'surat_keaslian' => 'required|file|mimes:pdf|max:5120',
                'form_judul' => 'required|file|mimes:pdf|max:5120',
                'bukti_konsultasi' => 'nullable|file|mimes:pdf|max:5120',
            ]);
        }

        $registration = SidangRegistration::where('user_id', auth()->id())
            ->where('jenis_sidang', $jenis_sidang)
            ->where('status', 'diterima')
            ->first();

        if (!$registration) {
            return redirect()->back()->with('error', 'Registrasi tidak ditemukan atau belum disetujui.');
        }

        // Upload files
        if ($jenis_sidang == 'kerja_praktik') {
            $files = ['laporan_kp', 'surat_selesai_kp', 'logbook_kp', 'penilaian_pembimbing', 'surat_keaslian', 'sertifikat_kp'];
        } else {
            $files = ['draft_proposal', 'persetujuan_pembimbing', 'transkrip_nilai', 'krs_semester', 'surat_keaslian', 'form_judul', 'bukti_konsultasi'];
        }

        foreach ($files as $fileField) {
            if ($request->hasFile($fileField)) {
                $file = $request->file($fileField);
                $fileName = time() . '_' . $fileField . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('requirements', $fileName, 'public');
                
                RequirementFile::create([
                    'sidang_registration_id' => $registration->id,
                    'file_type' => $fileField,
                    'file_name' => $fileName,
                    'file_path' => $filePath,
                    'status' => 'pending'
                ]);
            }
        }

        return redirect()->route('mahasiswa.dashboard')
            ->with('success', 'Persyaratan berhasil diupload. Menunggu verifikasi admin.');
    }

    public function status()
    {
        $registrations = SidangRegistration::with('jadwal')
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('mahasiswa.status', compact('registrations'));
    }
    
    public function checkNotifications()
    {
        $lastCheck = session('last_notification_check', now()->subMinutes(1));
        
        $hasNew = Notification::where('user_id', Auth::id())
            ->where('created_at', '>', $lastCheck)
            ->exists();
            
        session(['last_notification_check' => now()]);
        
        return response()->json(['hasNew' => $hasNew]);
    }
}