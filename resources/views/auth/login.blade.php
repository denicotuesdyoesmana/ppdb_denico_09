@extends('layouts.auth')

@section('title', 'Login - PPDB SMK Antartika 1 Sidoarjo')

@section('content')
<div class="card shadow-lg border-0" style="border-radius: 12px; overflow: hidden;">
    <!-- Card Header dengan warna dashboard -->
    <div class="gradient-bg text-center p-4">
        <h2 class="text-white mb-2 fw-bold">
            <i class="fas fa-sign-in-alt me-2"></i>Masuk
        </h2>
        <p class="text-white-50 mb-0">Portal Pendaftaran PPDB 2025/2026</p>
    </div>

    <!-- Card Body -->
    <div class="card-body p-4" style="background: white;">
        <!-- Alert Messages -->
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>
                <strong>Kesalahan Login:</strong>
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
                
                @if ($errors->has('verify_email'))
                    <div style="margin-top: 15px; padding-top: 15px; border-top: 1px solid rgba(0,0,0,0.1);">
                        <p class="mb-3"><strong>📧 Bagaimana cara verifikasi?</strong></p>
                        <ol style="font-size: 13px; margin-bottom: 15px; padding-left: 20px;">
                            <li>Buka email yang Anda terima dari sistem</li>
                            <li>Copy kode OTP (6 digit) dari email</li>
                            <li>Klik tombol di bawah untuk verifikasi</li>
                            <li>Masukkan kode OTP dan selesaikan verifikasi</li>
                        </ol>
                        <a href="/verify-email" class="btn btn-sm btn-light text-danger fw-bold w-100">
                            <i class="fas fa-envelope-open me-2"></i>Verifikasi Email Sekarang
                        </a>
                    </div>
                @endif
                
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Login Form -->
        <form method="POST" action="{{ route('login.post') }}">
            @csrf

            <!-- Email Field -->
            <div class="mb-3">
                <label for="email" class="form-label fw-600">
                    <i class="fas fa-envelope me-2 text-primary"></i>Email
                </label>
                <input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" 
                       id="email" name="email" placeholder="Masukkan email Anda" 
                       value="{{ session('registered_email') }}" autocomplete="email" required>
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- Password Field -->
            <div class="mb-3">
                <label for="password" class="form-label fw-600">
                    <i class="fas fa-lock me-2 text-primary"></i>Password
                </label>
                <input type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" 
                       id="password" name="password" placeholder="Masukkan password Anda" 
                       {{ session('registered_email') ? 'autofocus' : '' }} required>
                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- Remember Me & Forgot Password -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="remember" name="remember" value="1">
                    <label class="form-check-label text-muted" for="remember">
                        Ingat saya
                    </label>
                </div>
                <a href="{{ route('forgot_password.email_form') }}" class="text-decoration-none" style="font-size: 0.875rem;">
                    Lupa password?
                </a>
            </div>

            <!-- CAPTCHA Field -->
            <div class="mb-4">
                <label class="form-label fw-600">
                    <i class="fas fa-shield-alt me-2 text-primary"></i>Verifikasi Keamanan
                </label>
                <div class="captcha-container" style="display: flex; justify-content: center; padding: 15px; background: #f8f9fa; border-radius: 8px; border: 1px solid #e0e0e0;">
                    {!! NoCaptcha::renderJs() !!}
                    {!! NoCaptcha::display() !!}
                </div>
                @error('g-recaptcha-response')
                    <small class="text-danger">
                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                    </small>
                @enderror
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-modern btn-modern-primary btn-lg w-100 fw-600 mb-3">
                <i class="fas fa-arrow-right me-2"></i>Masuk
            </button>
        </form>

        <!-- Divider -->
        <div class="position-relative my-4">
            <hr>
            <span class="position-absolute top-50 start-50 translate-middle bg-white px-2 text-muted small">
                atau masuk dengan
            </span>
        </div>

        <!-- SSO Login -->
        @include('auth.sso')

        <!-- Register Link -->
        <div class="text-center pt-3 border-top">
            <p class="mb-0 text-muted">
                Belum punya akun?
                <a href="/register" class="text-decoration-none fw-600 text-primary">
                    Daftar Sekarang
                </a>
            </p>
        </div>
    </div>
</div>

<style>
    body {
        font-family: 'Public Sans', sans-serif;
    }
    
    .form-control:focus {
        border-color: #1890ff;
        box-shadow: 0 0 0 0.2rem rgba(24, 144, 255, 0.25);
    }
    
    .btn-primary:hover {
        background: linear-gradient(135deg, #0d66d0 0%, #0a4fa3 100%);
        border-color: transparent;
        transform: translateY(-2px);
        box-shadow: 0 8px 16px rgba(24, 144, 255, 0.4);
    }
    
    .text-white-50 {
        color: rgba(255, 255, 255, 0.7);
    }
</style>
@endsection
