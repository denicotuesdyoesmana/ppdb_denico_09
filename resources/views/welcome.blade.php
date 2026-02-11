
@extends('layouts.landing')

@section('content')
    <style>
        .hero-modern {
            padding: 100px 0;
            color: #fff;
            background: linear-gradient(0deg, rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url('{{ asset("assets/images/my/sekolah_depan.jpg") }}') !important;
            background-attachment: fixed;
            background-size: cover;
            background-position: center right;
            position: relative;
            overflow: hidden;
        }

        /* Pastikan tidak ada overlay dari pseudo-element */
        .hero-modern::before,
        .hero-modern::after {
            display: none !important;
            content: none !important;
        }

        .hero-modern .container {
            position: relative;
            z-index: 1;
        }
        .hero-modern h1 { 
            font-size: clamp(2rem, 4.5vw, 3.5rem); 
            font-weight: 800;
            line-height: 1.2;
            color: #ffffff;
            text-shadow: 2px 2px 8px rgba(255, 255, 255, 0.3), 0 0 20px rgba(255, 255, 255, 0.2);
        }
        .hero-modern .lead { 
            opacity: .98; 
            font-size: 1.1rem;
            font-weight: 500;
            color: #ffffff;
            text-shadow: 1px 1px 6px rgba(255, 255, 255, 0.3), 0 0 15px rgba(255, 255, 255, 0.15);
        }
        .card-modern { 
            border-radius: 16px; 
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.1);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border: none;
            background: #ffffff;
        }
        .card-modern:hover { 
            transform: translateY(-8px); 
            box-shadow: 0 20px 40px rgba(16, 185, 129, 0.2);
        }
        .feature-icon { 
            width: 68px; 
            height: 68px; 
            display: inline-flex; 
            align-items: center; 
            justify-content: center; 
            border-radius: 16px; 
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.15) 0%, rgba(5, 150, 105, 0.15) 100%);
            color: #059669;
            font-size: 30px;
            transition: all 0.3s ease;
        }
        .card-modern:hover .feature-icon {
            transform: scale(1.1);
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.25) 0%, rgba(5, 150, 105, 0.25) 100%);
        }
        .stat-number { 
            font-size: 2.2rem; 
            color: #059669;
            font-weight: 900;
        }
        .muted { color: #6b7280; }
        .section-accent {
            background: linear-gradient(135deg, rgba(209, 250, 229, 0.5) 0%, rgba(167, 243, 208, 0.3) 100%);
        }
        .accent-primary { color: #059669; }
        .accent-success { color: #059669; }
        .accent-cyan { color: #059669; }
    </style>

    <header class="hero-modern">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-7 mx-auto text-center">
                    <h1 class="mb-4" style="font-size: clamp(2.5rem, 5vw, 4rem); letter-spacing: -1px; animation: slideDown 0.8s ease-out; font-weight: 900; line-height: 1.1; color: #ffffff;">
                        Mulai Perjalananmu<br>
                        Bersama Kami
                    </h1>
                    <p class="lead mb-5" style="font-size: clamp(1rem, 2vw, 1.15rem); line-height: 1.8; max-width: 600px; margin-left: auto; margin-right: auto; animation: slideUp 0.8s ease-out 0.2s both; font-weight: 500; letter-spacing: 0.3px; color: #ffffff;">
                        Platform PPDB digital terpercaya yang menyederhanakan proses 
                        <span style="color: #ffffff; font-weight: 700;">pendaftaran</span>, 
                        <span style="color: #ffffff; font-weight: 700;">verifikasi dokumen</span>, 
                        hingga 
                        <span style="color: #ffffff; font-weight: 700;">hasil seleksi</span> 
                        dalam satu tempat.
                    </p>
                    <div style="animation: fadeIn 0.8s ease-out 0.4s both; margin-top: 3rem;">
                        <p style="font-size: 0.95rem; color: rgba(255,255,255,0.95); text-transform: uppercase; letter-spacing: 2px; font-weight: 600; margin-bottom: 1rem; text-shadow: 0 1px 2px rgba(0,0,0,0.1);">Dipercaya oleh 2000+ Alumni</p>
                        <div style="display: flex; justify-content: center; gap: 1rem; flex-wrap: wrap;">
                            <div style="background: rgba(255,255,255,0.15); backdrop-filter: blur(10px); border: 1px solid rgba(16, 185, 129, 0.5); padding: 1rem 2rem; border-radius: 16px; animation: slideUp 0.8s ease-out 0.6s both;">
                                <div style="font-size: 1.8rem; font-weight: 900; background: linear-gradient(135deg, #6ee7b7 0%, #10b981 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">2000+</div>
                                <div style="font-size: 0.85rem; color: rgba(255,255,255,0.9); margin-top: 0.5rem;">Alumni Sukses</div>
                            </div>
                            <div style="background: rgba(255,255,255,0.15); backdrop-filter: blur(10px); border: 1px solid rgba(16, 185, 129, 0.5); padding: 1rem 2rem; border-radius: 16px; animation: slideUp 0.8s ease-out 0.8s both;">
                                <div style="font-size: 1.8rem; font-weight: 900; background: linear-gradient(135deg, #6ee7b7 0%, #10b981 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">10+</div>
                                <div style="font-size: 0.85rem; color: rgba(255,255,255,0.9); margin-top: 0.5rem;">Program Jurusan</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 d-none">
                    <img src="{{ asset('assets/images/my/sekolah_depan.jpg') }}" alt="Hero" class="img-fluid" style="max-width:420px; filter:drop-shadow(0 20px 40px rgba(0,0,0,0.15)); animation: float 3s ease-in-out infinite;">
                </div>
            </div>
        </div>
    </header>
    
    <style>
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
    </style>


    <section class="py-5 bg-white">
        <div class="container">
            <div class="text-center mb-5">
                <h6 class="text-uppercase fw-semibold accent-primary mb-2">
                    <i class="fas fa-sparkles me-2"></i>Kenapa Memilih Kami?
                </h6>
                <h2 class="fw-bold mb-3">Pengalaman Pendaftaran yang Lebih Mudah & Terpercaya</h2>
                <p class="mx-auto muted" style="max-width:720px;">Kami menghadirkan solusi PPDB terdepan dengan teknologi enkripsi, dukungan pelanggan 24/7, dan transparansi penuh untuk setiap tahap proses Anda.</p>
            </div>

            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="card card-modern h-100 border-0 p-4 text-center">
                        <div class="mb-3 feature-icon mx-auto">
                            <i class="fas fa-laptop"></i>
                        </div>
                        <h5 class="fw-bold mb-2">Pendaftaran Mudah</h5>
                        <p class="muted mb-0">Daftar kapan saja tanpa antre. Formulir yang jelas, intuitif, dan cepat diisi dari perangkat apa pun.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card card-modern h-100 border-0 p-4 text-center">
                        <div class="mb-3 feature-icon mx-auto">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h5 class="fw-bold mb-2">Aman & Terenkripsi</h5>
                        <p class="muted mb-0">Data Anda dilindungi dengan enkripsi tingkat enterprise. Privasi dan keamanan adalah prioritas utama kami.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card card-modern h-100 border-0 p-4 text-center">
                        <div class="mb-3 feature-icon mx-auto">
                            <i class="fas fa-file-upload"></i>
                        </div>
                        <h5 class="fw-bold mb-2">Upload Dokumen</h5>
                        <p class="muted mb-0">Unggah semua berkas yang diperlukan dengan mudah. Sistem verifikasi kami bekerja dengan cepat dan akurat.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card card-modern h-100 border-0 p-4 text-center">
                        <div class="mb-3 feature-icon mx-auto">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h5 class="fw-bold mb-2">Transparansi Real-Time</h5>
                        <p class="muted mb-0">Pantau status pendaftaran Anda setiap saat. Tidak ada biaya tersembunyi atau kejutan yang tidak menyenangkan.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 section-accent">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card border-0 card-modern p-4" style="border-left: 4px solid #059669;">
                        <div class="d-flex align-items-center justify-content-center mb-3">
                            <div class="me-3">
                                <h2 class="stat-number mb-0">2.000+</h2>
                            </div>
                            <div class="text-start">
                                <h5 class="mb-1 fw-bold">Alumni Sukses</h5>
                                <p class="mb-0 muted">Bekerja di perusahaan nasional dan internasional</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 card-modern p-4" style="border-left: 4px solid #10b981;">
                        <div class="d-flex align-items-center justify-content-center mb-3">
                            <div class="me-3">
                                <h2 class="stat-number accent-success mb-0">10+</h2>
                            </div>
                            <div class="text-start">
                                <h5 class="mb-1 fw-bold">Jurusan Unggulan</h5>
                                <p class="mb-0 muted">RPL, TKJ, TBSM, AKL & lainnya</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 card-modern p-4" style="border-left: 4px solid #10b981;">
                        <div class="d-flex align-items-center justify-content-center mb-3">
                            <div class="me-3">
                                <h2 class="stat-number accent-cyan mb-0">100%</h2>
                            </div>
                            <div class="text-start">
                                <h5 class="mb-1 fw-bold">Sertifikasi Kompetensi</h5>
                                <p class="mb-0 muted">Setiap siswa mendapat sertifikat industri</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5" style="background: linear-gradient(135deg, #059669 0%, #10b981 100%);">
        <div class="container text-center text-white">
            <h3 class="fw-bold mb-3 fs-2">Siap Memulai Perjalananmu?</h3>
            <p class="mb-4" style="font-size: 1.1rem; opacity: 0.95;">Bergabunglah dengan ribuan siswa dan mulai langkah pertamamu menuju masa depan yang cerah dan profesional.</p>
        </div>
    </section>

    <section class="py-5 bg-white">
        <div class="container">
            <div class="text-center mb-5">
                <h6 class="text-uppercase fw-semibold accent-primary mb-2">
                    <i class="fas fa-testimonial me-2"></i>Cerita Mereka
                </h6>
                <h2 class="fw-bold mb-3">Dengarkan Suara Siswa & Alumni Kami</h2>
            </div>
            <div class="row g-4 justify-content-center">
                <div class="col-md-6 col-lg-4">
                    <div class="card card-modern p-4" style="border-left: 4px solid #10b981;">
                        <div class="d-flex mb-3">
                            <img src="{{ asset('assets/images/user/avatar-1.jpg') }}" alt="Rizky" class="rounded-circle me-3" style="width:56px; height:56px; object-fit:cover;">
                            <div>
                                <h6 class="mb-0 fw-bold">Rizky A.</h6>
                                <small class="text-muted">Alumni Jurusan RPL</small>
                            </div>
                        </div>
                        <p class="mb-0 muted">"Pengajar yang ramah dan banyak praktik langsung yang membuat saya siap masuk industri. Sekarang bekerja sebagai developer di startup lokal!"</p>
                        <div style="color: #ffc107; margin-top: 12px;">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card card-modern p-4" style="border-left: 4px solid #10b981;">
                        <div class="d-flex mb-3">
                            <img src="{{ asset('assets/images/user/avatar-2.jpg') }}" alt="Anisa" class="rounded-circle me-3" style="width:56px; height:56px; object-fit:cover;">
                            <div>
                                <h6 class="mb-0 fw-bold">Anisa P.</h6>
                                <small class="text-muted">Alumni Jurusan TKJ</small>
                            </div>
                        </div>
                        <p class="mb-0 muted">"Magang di perusahaan IT bonafide dan langsung dapat penawaran pekerjaan setelah lulus. Platform PPDB-nya mudah digunakan!"</p>
                        <div style="color: #ffc107; margin-top: 12px;">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card card-modern p-4" style="border-left: 4px solid #10b981;">
                        <div class="d-flex mb-3">
                            <img src="{{ asset('assets/images/user/avatar-1.jpg') }}" alt="Budi" class="rounded-circle me-3" style="width:56px; height:56px; object-fit:cover;">
                            <div>
                                <h6 class="mb-0 fw-bold">Budi S.</h6>
                                <small class="text-muted">Siswa Aktif Tahun ke-3</small>
                            </div>
                        </div>
                        <p class="mb-0 muted">"Proses pendaftaran sangat transparan dan mudah dipahami. Staff-nya responsif dan membantu ketika ada pertanyaan!"</p>
                        <div style="color: #ffc107; margin-top: 12px;">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

