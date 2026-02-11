@extends('layouts.master')

@section('page_title', 'Status Seleksi')

@section('content')
<style>
    * {
        box-sizing: border-box;
    }

    .status-header {
        padding: 24px 0 32px 0;
        margin-bottom: 32px;
        text-align: center;
    }

    .status-title {
        font-size: clamp(28px, 5vw, 40px);
        font-weight: 700;
        background: linear-gradient(135deg, #14b8a6 0%, #0d9488 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin: 0 0 8px 0;
    }

    .status-subtitle {
        color: #6b7280;
        font-size: 15px;
        margin: 0;
    }

    .status-card {
        background: white;
        border-radius: 16px;
        padding: clamp(20px, 5vw, 40px);
        box-shadow: 0 4px 16px rgba(20, 184, 166, 0.08);
        border: 1px solid #e0f2f1;
        margin-bottom: 24px;
        animation: slideInUp 0.6s ease-out;
        transition: all 0.3s ease;
    }

    .status-card:hover {
        box-shadow: 0 8px 24px rgba(20, 184, 166, 0.12);
        transform: translateY(-2px);
    }

    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .status-main {
        text-align: center;
        padding: clamp(30px, 5vw, 50px) 20px;
    }

    .status-icon-large {
        width: clamp(70px, 15vw, 100px);
        height: clamp(70px, 15vw, 100px);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 24px;
        font-size: clamp(32px, 8vw, 50px);
        color: white;
        animation: pulse 2s ease-in-out infinite;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
    }

    .status-icon-large.success { 
        background: linear-gradient(135deg, #10b981 0%, #34d399 100%);
    }

    .status-icon-large.warning { 
        background: linear-gradient(135deg, #f59e0b 0%, #fbbf24 100%);
    }

    .status-icon-large.danger { 
        background: linear-gradient(135deg, #ef4444 0%, #f87171 100%);
    }

    .status-icon-large.info { 
        background: linear-gradient(135deg, #14b8a6 0%, #5eead4 100%);
    }

    @keyframes pulse {
        0%, 100% {
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
        }
        50% {
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.25);
        }
    }

    .status-label {
        font-size: 13px;
        color: #6b7280;
        margin-bottom: 8px;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-weight: 600;
    }

    .status-value {
        font-size: clamp(24px, 6vw, 36px);
        font-weight: 700;
        color: #1f2937;
    }

    .progress-timeline {
        margin: clamp(30px, 5vw, 50px) 0;
    }

    .timeline-step {
        display: flex;
        align-items: flex-start;
        margin-bottom: clamp(24px, 3vw, 40px);
        position: relative;
        animation: fadeInLeft 0.6s ease-out;
        animation-fill-mode: both;
    }

    .timeline-step:nth-child(1) { animation-delay: 0.1s; }
    .timeline-step:nth-child(2) { animation-delay: 0.2s; }
    .timeline-step:nth-child(3) { animation-delay: 0.3s; }
    .timeline-step:nth-child(4) { animation-delay: 0.4s; }

    @keyframes fadeInLeft {
        from {
            opacity: 0;
            transform: translateX(-20px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    .timeline-step:not(:last-child)::after {
        content: '';
        position: absolute;
        left: clamp(35px, 8vw, 45px);
        top: clamp(70px, 12vw, 90px);
        width: 2px;
        height: clamp(25px, 5vw, 40px);
        background: #e5e7eb;
        transition: background 0.3s ease;
    }

    .timeline-step.completed:not(:last-child)::after {
        background: linear-gradient(180deg, #10b981 0%, #10b981 100%);
    }

    .timeline-circle {
        width: clamp(70px, 12vw, 90px);
        height: clamp(70px, 12vw, 90px);
        border-radius: 50%;
        background: #f3f4f6;
        border: 3px solid #e5e7eb;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: clamp(28px, 6vw, 40px);
        flex-shrink: 0;
        position: relative;
        z-index: 1;
        transition: all 0.3s ease;
    }

    .timeline-step.completed .timeline-circle {
        background: linear-gradient(135deg, #10b981 0%, #34d399 100%);
        border-color: #10b981;
        color: white;
        transform: scale(1.05);
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
    }

    .timeline-step.active .timeline-circle {
        background: linear-gradient(135deg, #14b8a6 0%, #5eead4 100%);
        border-color: #14b8a6;
        color: white;
        box-shadow: 0 0 0 8px rgba(20, 184, 166, 0.15);
        animation: scaleIn 0.6s ease;
    }

    @keyframes scaleIn {
        0% {
            transform: scale(0.8);
        }
        100% {
            transform: scale(1);
        }
    }

    .timeline-step.pending .timeline-circle {
        background: #f3f4f6;
        border-color: #e5e7eb;
        color: #9ca3af;
    }

    .timeline-content {
        margin-left: clamp(20px, 4vw, 30px);
        flex: 1;
    }

    .timeline-title {
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 4px;
        font-size: clamp(14px, 2.5vw, 18px);
    }

    .timeline-description {
        color: #6b7280;
        font-size: clamp(13px, 2vw, 15px);
    }

    .timeline-step.completed .timeline-title {
        color: #10b981;
    }

    .timeline-step.active .timeline-title {
        color: #14b8a6;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(clamp(150px, 25vw, 220px), 1fr));
        gap: clamp(16px, 3vw, 24px);
        margin-top: clamp(24px, 5vw, 40px);
    }

    .info-box {
        background: linear-gradient(135deg, #f0fdfa 0%, #f9fafb 100%);
        padding: clamp(16px, 3vw, 24px);
        border-radius: 12px;
        border-left: 4px solid #14b8a6;
        transition: all 0.3s ease;
        animation: fadeIn 0.6s ease-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .info-box:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 16px rgba(20, 184, 166, 0.12);
        background: linear-gradient(135deg, #e0f7f4 0%, #f0f9f9 100%);
    }

    .info-label {
        font-size: 11px;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.7px;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .info-value {
        font-size: clamp(14px, 2.5vw, 18px);
        font-weight: 700;
        color: #1f2937;
    }

    .empty-state {
        text-align: center;
        padding: clamp(40px, 8vw, 80px) 20px;
    }

    .empty-icon {
        font-size: clamp(48px, 12vw, 80px);
        margin-bottom: 24px;
        display: inline-block;
        animation: bounce 2s ease-in-out infinite;
    }

    @keyframes bounce {
        0%, 100% {
            transform: translateY(0);
        }
        50% {
            transform: translateY(-12px);
        }
    }

    .empty-title {
        font-size: clamp(18px, 4vw, 28px);
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 12px;
    }

    .empty-description {
        color: #6b7280;
        margin-bottom: 32px;
        font-size: clamp(14px, 2vw, 16px);
        line-height: 1.6;
    }

    .btn {
        display: inline-block;
        padding: clamp(10px, 2vw, 14px) clamp(20px, 4vw, 28px);
        border-radius: 10px;
        font-weight: 700;
        text-decoration: none;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: clamp(13px, 2vw, 16px);
    }

    .btn-primary {
        background: linear-gradient(135deg, #14b8a6 0%, #0d9488 100%);
        color: white;
    }

    .btn-primary:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(20, 184, 166, 0.4);
    }

    .btn-primary:active {
        transform: translateY(-1px);
    }

    /* Next Steps Card */
    .status-card h3 {
        font-size: clamp(18px, 4vw, 24px);
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 16px;
    }

    .status-card p {
        font-size: clamp(14px, 2vw, 16px);
        line-height: 1.6;
    }

    .status-card ol {
        margin-left: clamp(20px, 4vw, 30px);
    }

    .status-card li {
        margin-bottom: 12px;
        font-size: clamp(14px, 2vw, 16px);
    }

    /* Status Card Variants */
    .status-card[style*="border-left: 4px solid #10b981"] {
        background: linear-gradient(135deg, #f0fdf4 0%, #f9fafb 100%);
        border: 1px solid #d1fae5;
        animation: slideInDown 0.6s ease-out;
    }

    .status-card[style*="border-left: 4px solid #ef4444"] {
        background: linear-gradient(135deg, #fef2f2 0%, #f9fafb 100%);
        border: 1px solid #fee2e2;
        animation: slideInDown 0.6s ease-out;
    }

    @keyframes slideInDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .status-header {
            padding: 16px 0 24px 0;
            margin-bottom: 24px;
        }

        .status-card {
            padding: 20px;
            margin-bottom: 16px;
        }

        .status-main {
            padding: 30px 15px;
        }

        .info-grid {
            grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
            gap: 12px;
        }

        .info-box {
            padding: 16px;
        }

        .timeline-content {
            margin-left: 16px;
        }

        .empty-state {
            padding: 40px 15px;
        }
    }

    @media (max-width: 480px) {
        .status-title {
            font-size: 24px;
        }

        .status-value {
            font-size: 28px;
        }

        .status-card {
            padding: 16px;
            border-radius: 12px;
        }

        .info-grid {
            grid-template-columns: 1fr;
        }

        .timeline-circle {
            width: 60px;
            height: 60px;
            font-size: 24px;
        }

        .timeline-content {
            margin-left: 12px;
        }

        .btn {
            display: block;
            width: 100%;
            text-align: center;
        }
    }
</style>

<div class="status-header">
    <h1 class="status-title">Status Seleksi</h1>
    <p class="status-subtitle">Pantau perkembangan proses pendaftaran Anda</p>
</div>

@if(Auth::user()->siswa)
    @php
        $siswa = Auth::user()->siswa;
        $pendaftaran = $siswa->pendaftaran()->first();
    @endphp

    @if($pendaftaran)
        <div class="status-card">
            <div class="status-main">
                @php
                    $status = $pendaftaran->statusPendaftaran;
                    $statusLabel = $status ? $status->label : 'Menunggu';
                    $statusClass = match($statusLabel) {
                        'Diterima' => 'success',
                        'Menunggu' => 'warning',
                        'Ditolak' => 'danger',
                        default => 'info'
                    };
                @endphp
                <div class="status-icon-large {{ $statusClass }}">
                    @if($statusClass === 'success')
                        ✓
                    @elseif($statusClass === 'warning')
                        ⏳
                    @elseif($statusClass === 'danger')
                        ✕
                    @else
                        ?
                    @endif
                </div>
                <div class="status-label">Status Saat Ini</div>
                <div class="status-value">{{ $statusLabel }}</div>
            </div>

            <!-- PROGRESS TIMELINE -->
            <div class="progress-timeline">
                @php
                    // Check if formulir is actually completed (not just exists)
                    $isFormulirComplete = $pendaftaran && 
                        !empty($pendaftaran->tahun_ajaran) && 
                        !empty($pendaftaran->jalur_pendaftaran) && 
                        !empty($pendaftaran->gelombang) && 
                        !empty($pendaftaran->jurusan_pilihan_1) && 
                        !empty($pendaftaran->rata_nilai);
                    
                    // Check if required documents are uploaded
                    $requiredDocs = \App\Models\JenisDokumen::where('wajib', true)->pluck('id')->toArray();
                    $uploadedDocIds = $siswa && $siswa->dokumen ? $siswa->dokumen()->pluck('jenis_dokumen_id')->toArray() : [];
                    $allRequiredDocsUploaded = count($requiredDocs) > 0 && 
                                              count($uploadedDocIds) > 0 && 
                                              count(array_intersect($requiredDocs, $uploadedDocIds)) == count($requiredDocs);
                    
                    $statusLabel = $status->label ?? 'Menunggu';
                    
                    $steps = [
                        ['title' => 'Pendaftaran', 'description' => 'Akun telah dibuat', 'status' => 'completed'],
                        ['title' => 'Isi Formulir', 'description' => 'Data diri lengkap', 'status' => $isFormulirComplete ? 'completed' : 'pending'],
                        ['title' => 'Upload Dokumen', 'description' => 'Dokumen diverifikasi', 'status' => $allRequiredDocsUploaded ? 'completed' : 'pending'],
                        ['title' => 'Hasil Seleksi', 'description' => 'Pengumuman hasil akhir', 'status' => ($statusLabel === 'Diterima' || $statusLabel === 'Ditolak') ? 'completed' : ($statusLabel === 'Menunggu' ? 'active' : 'pending')],
                    ];
                @endphp

                @foreach($steps as $step)
                    <div class="timeline-step {{ $step['status'] }}">
                        <div class="timeline-circle">
                            @if($step['status'] === 'completed')
                                ✓
                            @elseif($step['status'] === 'active')
                                →
                            @else
                                ●
                            @endif
                        </div>
                        <div class="timeline-content">
                            <div class="timeline-title">{{ $step['title'] }}</div>
                            <div class="timeline-description">{{ $step['description'] }}</div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- INFO BOXES -->
            <div class="info-grid">
                <div class="info-box">
                    <div class="info-label">Nomor Pendaftaran</div>
                    <div class="info-value">{{ $pendaftaran->nomor_pendaftaran ?? '-' }}</div>
                </div>
                <div class="info-box">
                    <div class="info-label">Tanggal Daftar</div>
                    <div class="info-value">{{ $pendaftaran->created_at->format('d M Y') }}</div>
                </div>
                <div class="info-box">
                    <div class="info-label">Jurusan Pilihan</div>
                    <div class="info-value">{{ $pendaftaran->jurusanPilihan1?->nama_jurusan ?? '-' }}</div>
                </div>
                <div class="info-box">
                    <div class="info-label">Dokumen Diunggah</div>
                    <div class="info-value">{{ $siswa->dokumen()->count() ?? 0 }} file</div>
                </div>
            </div>
        </div>
    @else
        <div class="status-card">
            <div class="empty-state">
                <div class="empty-icon">📋</div>
                <div class="empty-title">Belum Ada Data Pendaftaran</div>
                <p class="empty-description">Anda belum mengisi formulir pendaftaran. Silakan isi formulir terlebih dahulu untuk melanjutkan proses seleksi.</p>
                <a href="{{ route('formulir.index') }}" class="btn btn-primary">Isi Formulir Sekarang</a>
            </div>
        </div>
    @endif
@else
    <div class="status-card">
        <div class="empty-state">
            <div class="empty-icon">⚠️</div>
            <div class="empty-title">Data Tidak Ditemukan</div>
            <p class="empty-description">Sistem tidak dapat menemukan data siswa Anda. Silakan hubungi admin untuk bantuan.</p>
        </div>
    </div>
@endif
@endsection
