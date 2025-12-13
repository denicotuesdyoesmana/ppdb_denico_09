<?php
/**
 * Contoh Implementasi Modern UI untuk Admin Dashboard
 * Copy dan paskan ke blade template Anda untuk menggunakan tema modern
 */
?>

<!-- EXAMPLE: Modern Admin Dashboard Layout -->

@extends('layouts.master')

@section('page_title', 'Dashboard Admin')

@section('content')
<div class="container-fluid">
    <!-- Page Header with Gradient -->
    <div class="page-header">
        <h1 class="page-title gradient-text">Dashboard</h1>
        <p class="page-subtitle">Selamat datang kembali, {{ Auth::user()->name }}!</p>
    </div>

    <!-- Stats Grid with Modern Cards -->
    <div class="row mb-4 stats-grid">
        <!-- Stat Card 1 -->
        <div class="col-md-6 col-lg-3">
            <div class="stat-card primary">
                <div>
                    <div class="stat-value">1,250</div>
                    <div class="stat-label">Total Pendaftar</div>
                </div>
                <div class="stat-icon primary">
                    <i class="fas fa-users"></i>
                </div>
            </div>
        </div>

        <!-- Stat Card 2 -->
        <div class="col-md-6 col-lg-3">
            <div class="stat-card success">
                <div>
                    <div class="stat-value">850</div>
                    <div class="stat-label">Terverifikasi</div>
                </div>
                <div class="stat-icon success">
                    <i class="fas fa-check-circle"></i>
                </div>
            </div>
        </div>

        <!-- Stat Card 3 -->
        <div class="col-md-6 col-lg-3">
            <div class="stat-card warning">
                <div>
                    <div class="stat-value">320</div>
                    <div class="stat-label">Menunggu</div>
                </div>
                <div class="stat-icon warning">
                    <i class="fas fa-hourglass-half"></i>
                </div>
            </div>
        </div>

        <!-- Stat Card 4 -->
        <div class="col-md-6 col-lg-3">
            <div class="stat-card danger">
                <div>
                    <div class="stat-value">80</div>
                    <div class="stat-label">Ditolak</div>
                </div>
                <div class="stat-icon danger">
                    <i class="fas fa-times-circle"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Modern Card Example -->
    <div class="row">
        <div class="col-lg-8">
            <div class="card-modern">
                <div class="card-header">
                    <h5>Pendaftar Terbaru</h5>
                </div>
                <div class="card-body">
                    <!-- Modern Table -->
                    <table class="table table-modern">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div>
                                        <strong>Ahmad Sutanto</strong>
                                        <div class="text-muted small">Jurusan: RPL</div>
                                    </div>
                                </td>
                                <td>ahmad@example.com</td>
                                <td>
                                    <span class="status-indicator status-success">
                                        <i class="fas fa-check"></i> Verified
                                    </span>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-modern-outline">Detail</button>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div>
                                        <strong>Siti Nurhaliza</strong>
                                        <div class="text-muted small">Jurusan: TKJ</div>
                                    </div>
                                </td>
                                <td>siti@example.com</td>
                                <td>
                                    <span class="status-indicator status-pending">
                                        <i class="fas fa-clock"></i> Pending
                                    </span>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-modern-outline">Detail</button>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div>
                                        <strong>Budi Santoso</strong>
                                        <div class="text-muted small">Jurusan: TI</div>
                                    </div>
                                </td>
                                <td>budi@example.com</td>
                                <td>
                                    <span class="status-indicator status-danger">
                                        <i class="fas fa-times"></i> Rejected
                                    </span>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-modern-outline">Detail</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Sidebar Card Example -->
        <div class="col-lg-4">
            <!-- Info Card Modern -->
            <div class="card-modern mb-4">
                <div class="card-body">
                    <h5 class="gradient-text-primary mb-3">
                        <i class="fas fa-info-circle"></i> Informasi
                    </h5>
                    <p class="text-muted mb-3">Gelombang Pendaftaran</p>
                    <div class="mb-3">
                        <div class="small text-muted mb-1">Gelombang 1</div>
                        <div class="text-dark fw-bold">01 Juli - 31 Agustus 2024</div>
                    </div>
                    <div class="mb-3">
                        <div class="small text-muted mb-1">Gelombang 2</div>
                        <div class="text-dark fw-bold">01 September - 30 September 2024</div>
                    </div>
                    <button class="btn btn-modern-primary w-100">
                        <i class="fas fa-edit"></i> Edit Gelombang
                    </button>
                </div>
            </div>

            <!-- Badge Example Card -->
            <div class="card-modern">
                <div class="card-body">
                    <h5 class="mb-3">Status Verifikasi</h5>
                    <div class="d-flex flex-wrap gap-2">
                        <span class="badge-modern badge-primary-modern">
                            <i class="fas fa-check"></i> Verified
                        </span>
                        <span class="badge-modern badge-accent-modern">
                            <i class="fas fa-clock"></i> Pending
                        </span>
                    </div>
                    <div class="divider-modern"></div>
                    <p class="text-muted small">
                        Total berkas yang perlu diverifikasi: <strong>45</strong>
                    </p>
                    <button class="btn btn-modern-accent w-100">
                        <i class="fas fa-check-circle"></i> Verifikasi Sekarang
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modern Alert Examples -->
    <div class="row mt-4">
        <div class="col-lg-8">
            <div class="alert-success-modern">
                <i class="fas fa-check-circle"></i>
                <div>
                    <strong>Verifikasi Berhasil!</strong>
                    <p class="mb-0 small">10 berkas telah berhasil diverifikasi hari ini.</p>
                </div>
            </div>

            <div class="alert-warning-modern">
                <i class="fas fa-exclamation-triangle"></i>
                <div>
                    <strong>Perhatian!</strong>
                    <p class="mb-0 small">Ada 15 berkas yang belum lengkap dan memerlukan revisi.</p>
                </div>
            </div>

            <div class="alert-info-modern">
                <i class="fas fa-info-circle"></i>
                <div>
                    <strong>Info Penting:</strong>
                    <p class="mb-0 small">Deadline pendaftaran gelombang 1 tinggal 5 hari lagi.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Form Group Modern Example -->
    <div class="row mt-5">
        <div class="col-lg-6">
            <div class="card-modern">
                <div class="card-header">
                    <h5>Form Pengumuman Baru</h5>
                </div>
                <div class="card-body">
                    <form>
                        <div class="form-group-modern">
                            <label>Judul Pengumuman</label>
                            <input type="text" class="form-control input-modern" placeholder="Masukkan judul pengumuman">
                        </div>

                        <div class="form-group-modern">
                            <label>Konten</label>
                            <textarea class="form-control input-modern" rows="5" placeholder="Masukkan konten pengumuman"></textarea>
                        </div>

                        <div class="form-group-modern">
                            <label>Kategori</label>
                            <select class="form-control input-modern">
                                <option value="">Pilih Kategori</option>
                                <option value="umum">Umum</option>
                                <option value="penting">Penting</option>
                                <option value="pengumuman">Pengumuman</option>
                            </select>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-modern-primary flex-grow-1">
                                <i class="fas fa-save"></i> Simpan
                            </button>
                            <button type="reset" class="btn btn-modern-outline">
                                <i class="fas fa-redo"></i> Reset
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('extra_js')
<script>
    // Initialize modern theme features
    document.addEventListener('DOMContentLoaded', function() {
        // Example: Show toast on page load
        // showModernToast('Selamat datang di Dashboard!', 'info', 2000);

        // Example: Add ripple effects
        addRippleEffect();

        // Example: Format currency
        // const amount = 1000000;
        // console.log('Formatted:', formatCurrency(amount));
    });
</script>
@endsection

<!-- 
    REFERENSI KELAS MODERN UI

    Stat Cards:
    - .stat-card dengan .primary, .success, .danger, .warning

    Cards:
    - .card-modern (Glassmorphism card)
    - .card-modern-gradient (Dengan gradient background)

    Buttons:
    - .btn-primary (Gradient primary)
    - .btn-modern-accent (Gradient accent)
    - .btn-modern-outline (Outline style)
    - .btn-modern-ghost (Ghost style)

    Badges:
    - .badge-primary-modern
    - .badge-accent-modern
    - .badge-success-modern
    - .badge-danger-modern
    - .badge-warning-modern

    Tables:
    - .table-modern (Modern table styling)
    - .status-indicator dengan status-success, status-pending, status-danger

    Forms:
    - .form-group-modern (Container)
    - .input-modern (Input element)

    Alerts:
    - .alert-success-modern
    - .alert-danger-modern
    - .alert-warning-modern
    - .alert-info-modern

    Utilities:
    - .gradient-text (Rainbow gradient)
    - .gradient-text-primary (Cyan gradient)
    - .gradient-text-accent (Pink gradient)
    - .divider-modern (Modern divider)
    - .shadow-cyan (Cyan shadow)
    - .shadow-pink (Pink shadow)
    - .hover-lift (Lift on hover)
    - .hover-glow-cyan (Cyan glow)
    - .hover-glow-pink (Pink glow)
-->
