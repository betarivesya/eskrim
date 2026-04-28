<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ice Cream Shop 🍦</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #fff7ed; }
        .gradient-text {
            background: linear-gradient(135deg, #ff6b9d, #c084fc, #fde68a);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .btn-gradient {
            background: linear-gradient(135deg, #ff6b9d, #c084fc);
            border: none; color: white; font-weight: 600;
        }
        .btn-gradient:hover { color: white; transform: translateY(-2px); box-shadow: 0 8px 25px rgba(255,107,157,0.4); }
        .btn-wa { background: #25d366; border: none; color: white; font-weight: 600; }
        .btn-wa:hover { color: white; transform: translateY(-2px); box-shadow: 0 8px 25px rgba(37,211,102,0.4); }
        .hero-img { animation: float 6s ease-in-out infinite; max-height: 420px; }
        @keyframes float { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-15px)} }
        .card-hover:hover { transform: translateY(-10px); box-shadow: 0 20px 50px rgba(255,107,157,0.15) !important; }
        .badge-float { animation: float 4s ease-in-out infinite; }
        .badge-float-delay { animation: float 4s ease-in-out 2s infinite; }
        .scroll-top { position:fixed;bottom:30px;right:30px;width:45px;height:45px;border-radius:50%;background:linear-gradient(135deg,#ff6b9d,#c084fc);color:white;border:none;display:none;align-items:center;justify-content:center;z-index:999;cursor:pointer;font-size:1.2rem; }
        .scroll-top.show { display: flex; }
        .nav-link-custom { font-weight: 600; color: #78350f !important; }
        .nav-link-custom:hover { color: #ff6b9d !important; }
        .modal-header-gradient { background: linear-gradient(135deg, #ff6b9d, #c084fc); color: white; }
        .modal-header-wa { background: linear-gradient(135deg, #25d366, #128c7e); color: white; }
        .section-reveal { opacity: 0; transform: translateY(30px); transition: all 0.7s ease; }
        .section-reveal.active { opacity: 1; transform: translateY(0); }
        .hero-section { padding-top: 100px; min-height: 100vh; display: flex; align-items: center; }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg fixed-top bg-white shadow-sm" id="mainNav">
    <div class="container">
        <a class="navbar-brand fw-bold fs-4 gradient-text" href="#"><i class="bi bi-ice-cream"></i> Ice Cream Shop</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav align-items-center gap-lg-3">
                <li class="nav-item"><a class="nav-link nav-link-custom" href="#menu">Menu</a></li>
                <li class="nav-item"><a class="nav-link nav-link-custom" href="#bestseller">Best Seller</a></li>
                <li class="nav-item"><a class="nav-link nav-link-custom" href="#tentang">Tentang</a></li>
                <li class="nav-item">
    <a href="login.php" class="btn btn-outline-danger rounded-pill px-4 fw-bold">Login</a>
</li>
<li class="nav-item">
    <a href="register.php" class="btn btn-gradient rounded-pill px-4">Register</a>
</li>
            </ul>
        </div>
    </div>
</nav>

<!-- Hero Section -->
<section class="hero-section" id="hero">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <h1 class="fw-bold display-4 lh-sm mb-3" style="color:#78350f;">
                    Selamat Datang di<br><span class="gradient-text">Ice Cream Shop</span> 🍦
                </h1>
                <p class="fs-5 text-secondary mb-4">Nikmati berbagai rasa es krim favoritmu yang dibuat dari bahan-bahan segar pilihan. Setiap gigitan penuh kebahagiaan! ✨</p>
                <div class="d-flex gap-3 flex-wrap">
                    <button class="btn btn-gradient btn-lg rounded-pill px-4" onclick="scrollToSection('menu')"><i class="bi bi-rocket-takeoff me-2"></i>Mulai Sekarang</button>
                    <a href="login.php" class="btn btn-outline-danger btn-lg rounded-pill px-4 fw-bold">
    <i class="bi bi-box-arrow-in-right me-2"></i>Login
</a>
                </div>
                <div class="d-flex align-items-center gap-3 mt-4">
                    <div class="d-flex">
                        <div class="rounded-circle bg-danger d-flex align-items-center justify-content-center text-white" style="width:40px;height:40px;border:3px solid white;margin-left:-10px;font-size:.8rem;">🍦</div>
                        <div class="rounded-circle bg-info d-flex align-items-center justify-content-center text-white" style="width:40px;height:40px;border:3px solid white;margin-left:-10px;font-size:.8rem;">🍫</div>
                        <div class="rounded-circle bg-warning d-flex align-items-center justify-content-center text-white" style="width:40px;height:40px;border:3px solid white;margin-left:-10px;font-size:.8rem;">🍓</div>
                        <div class="rounded-circle bg-success d-flex align-items-center justify-content-center text-white" style="width:40px;height:40px;border:3px solid white;margin-left:-10px;font-size:.8rem;">🍵</div>
                    </div>
                    <div>
                        <div class="fw-bold" style="color:#78350f;">10K+ Pelanggan</div>
                        <small class="text-secondary">Percaya pada kami</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 text-center">
                <div class="position-relative d-inline-block">
                    <img src="https://image.qwenlm.ai/public_source/e546538c-ece8-4a46-849b-b82e570b6fa5/136b50f5a-cd87-402e-a87e-21774e6a5fdc.png" alt="Ice Cream" class="hero-img img-fluid rounded-4 shadow">
                    <div class="badge bg-white text-dark p-2 rounded-pill shadow position-absolute top-100 translate-middle-x badge-float" style="left:60%;top:-10px;"><i class="bi bi-star-fill text-warning"></i> 4.9 Rating</div>
                    <div class="badge bg-white text-dark p-2 rounded-pill shadow badge-float-delay" style="bottom:30px;left:-20px;">🍫 #1 Terlaris</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="py-5 bg-white">
    <div class="container">
        <div class="row text-center g-4">
            <div class="col-6 col-md-3 section-reveal">
                <h2 class="fw-bold display-6 gradient-text mb-1" data-target="50">0</h2>
                <p class="text-secondary fw-semibold">+ Varian Rasa</p>
            </div>
            <div class="col-6 col-md-3 section-reveal">
                <h2 class="fw-bold display-6 gradient-text mb-1" data-target="10000">0</h2>
                <p class="text-secondary fw-semibold">+ Pelanggan</p>
            </div>
            <div class="col-6 col-md-3 section-reveal">
                <h2 class="fw-bold display-6 gradient-text mb-1" data-target="15">0</h2>
                <p class="text-secondary fw-semibold">Cabang</p>
            </div>
            <div class="col-6 col-md-3 section-reveal">
                <h2 class="fw-bold display-6 gradient-text mb-1" data-target="5">0</h2>
                <p class="text-secondary fw-semibold">Tahun Berdiri</p>
            </div>
        </div>
    </div>
</section>

<!-- Menu Section -->
<section class="py-5" id="menu">
    <div class="container">
        <h2 class="fw-bold text-center mb-1" style="color:#78350f;font-size:2.5rem;">🍦 Menu Kami</h2>
        <p class="text-center text-secondary mb-5">Pilih rasa es krim favoritmu dari koleksi terbaik kami</p>
        <div class="row g-4 justify-content-center">
            <div class="col-md-4 section-reveal">
                <div class="card border-0 shadow-sm card-hover h-100 overflow-hidden">
                    <div class="position-relative overflow-hidden" style="height:240px;">
                        <img src="https://image.qwenlm.ai/public_source/e546538c-ece8-4a46-849b-b82e570b6fa5/136b50f5a-cd87-402e-a87e-21774e6a5fdc.png" class="card-img-top h-100" style="object-fit:cover;" alt="Chocolate">
                        <span class="badge bg-white text-dark shadow-sm p-2 rounded-circle position-absolute" style="top:15px;right:15px;font-size:1.5rem;">🍫</span>
                    </div>
                    <div class="card-body text-center p-4">
                        <h5 class="card-title fw-bold" style="color:#78350f;">Chocolate</h5>
                        <p class="card-text text-secondary small">Es krim cokelat Belgium premium yang kaya dan creamy</p>
                        <h5 class="gradient-text fw-bold mb-3">Rp 25.000</h5>
                        <button class="btn btn-gradient rounded-pill px-4" onclick="pesanItem('Chocolate Ice Cream','Rp 25.000')"><i class="bi bi-cart-plus me-1"></i> Pesan Sekarang</button>
                    </div>
                </div>
            </div>
            <div class="col-md-4 section-reveal">
                <div class="card border-0 shadow-sm card-hover h-100 overflow-hidden">
                    <div class="position-relative overflow-hidden" style="height:240px;">
                        <img src="https://image.qwenlm.ai/public_source/e546538c-ece8-4a46-849b-b82e570b6fa5/1cc076f93-f040-41e5-a0ab-f4e1a5ca2ba6.png" class="card-img-top h-100" style="object-fit:cover;" alt="Vanilla">
                        <span class="badge bg-white text-dark shadow-sm p-2 rounded-circle position-absolute" style="top:15px;right:15px;font-size:1.5rem;">🍦</span>
                    </div>
                    <div class="card-body text-center p-4">
                        <h5 class="card-title fw-bold" style="color:#78350f;">Vanilla</h5>
                        <p class="card-text text-secondary small">Vanilla klasik dengan biji vanilla asli Madagascar</p>
                        <h5 class="gradient-text fw-bold mb-3">Rp 22.000</h5>
                        <button class="btn btn-gradient rounded-pill px-4" onclick="pesanItem('Vanilla Ice Cream','Rp 22.000')"><i class="bi bi-cart-plus me-1"></i> Pesan Sekarang</button>
                    </div>
                </div>
            </div>
            <div class="col-md-4 section-reveal">
                <div class="card border-0 shadow-sm card-hover h-100 overflow-hidden">
                    <div class="position-relative overflow-hidden" style="height:240px;">
                        <img src="https://image.qwenlm.ai/public_source/e546538c-ece8-4a46-849b-b82e570b6fa5/11f6f406c-c2ee-4ec4-8263-bfc3a0ad2b7d.png" class="card-img-top h-100" style="object-fit:cover;" alt="Strawberry">
                        <span class="badge bg-white text-dark shadow-sm p-2 rounded-circle position-absolute" style="top:15px;right:15px;font-size:1.5rem;">🍓</span>
                    </div>
                    <div class="card-body text-center p-4">
                        <h5 class="card-title fw-bold" style="color:#78350f;">Strawberry</h5>
                        <p class="card-text text-secondary small">Strawberry segar pilihan dengan sensasi manis alami</p>
                        <h5 class="gradient-text fw-bold mb-3">Rp 24.000</h5>
                        <button class="btn btn-gradient rounded-pill px-4" onclick="pesanItem('Strawberry Ice Cream','Rp 24.000')"><i class="bi bi-cart-plus me-1"></i> Pesan Sekarang</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Best Seller Section -->
<section class="py-5" style="background:linear-gradient(135deg,#fff0f5,#f3e8ff,#fefce8);" id="bestseller">
    <div class="container">
        <h2 class="fw-bold text-center mb-1" style="color:#78350f;font-size:2.5rem;">⭐ Best Seller</h2>
        <p class="text-center text-secondary mb-5">Paling banyak dipesan dan paling disukai pelanggan kami</p>
        <div class="row g-4 justify-content-center">
            <div class="col-md-4 section-reveal">
                <div class="card border-0 shadow-sm card-hover h-100 overflow-hidden">
                    <div class="position-relative overflow-hidden" style="height:240px;">
                        <img src="https://image.qwenlm.ai/public_source/e546538c-ece8-4a46-849b-b82e570b6fa5/136b50f5a-cd87-402e-a87e-21774e6a5fdc.png" class="card-img-top h-100" style="object-fit:cover;" alt="Chocolate">
                        <span class="badge text-white p-2 position-absolute" style="top:15px;left:15px;background:linear-gradient(135deg,#ff6b9d,#c084fc);border-radius:50px;font-size:.8rem;"> BEST SELLER</span>
                    </div>
                    <div class="card-body text-center p-4">
                        <h5 class="card-title fw-bold" style="color:#78350f;">Chocolate Dream 🍫</h5>
                        <p class="card-text text-secondary small">Cokelat Belgium dengan topping brownies dan saus cokelat</p>
                        <div class="text-warning mb-2"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i> <span class="text-dark fw-bold small">4.9</span></div>
                        <h5 class="gradient-text fw-bold">Rp 35.000</h5>
                        <button class="btn btn-gradient rounded-pill px-4 mt-2" onclick="pesanItem('Chocolate Dream','Rp 35.000')"><i class="bi bi-bag-heart me-2"></i>Beli Sekarang</button>
                    </div>
                </div>
            </div>
            <div class="col-md-4 section-reveal">
                <div class="card border-0 shadow-sm card-hover h-100 overflow-hidden">
                    <div class="position-relative overflow-hidden" style="height:240px;">
                        <img src="https://image.qwenlm.ai/public_source/e546538c-ece8-4a46-849b-b82e570b6fa5/11f6f406c-c2ee-4ec4-8263-bfc3a0ad2b7d.png" class="card-img-top h-100" style="object-fit:cover;" alt="Strawberry">
                        <span class="badge text-white p-2 position-absolute" style="top:15px;left:15px;background:linear-gradient(135deg,#ff6b9d,#c084fc);border-radius:50px;font-size:.8rem;">🔥 BEST SELLER</span>
                    </div>
                    <div class="card-body text-center p-4">
                        <h5 class="card-title fw-bold" style="color:#78350f;">Strawberry Bliss 🍓</h5>
                        <p class="card-text text-secondary small">Strawberry segar dengan whipped cream dan strawberry asli</p>
                        <div class="text-warning mb-2"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-half"></i> <span class="text-dark fw-bold small">4.7</span></div>
                        <h5 class="gradient-text fw-bold">Rp 32.000</h5>
                        <button class="btn btn-gradient rounded-pill px-4 mt-2" onclick="pesanItem('Strawberry Bliss','Rp 32.000')"><i class="bi bi-bag-heart me-2"></i>Beli Sekarang</button>
                    </div>
                </div>
            </div>
            <div class="col-md-4 section-reveal">
                <div class="card border-0 shadow-sm card-hover h-100 overflow-hidden">
                    <div class="position-relative overflow-hidden" style="height:240px;">
                        <img src="https://image.qwenlm.ai/public_source/e546538c-ece8-4a46-849b-b82e570b6fa5/1cc076f93-f040-41e5-a0ab-f4e1a5ca2ba6.png" class="card-img-top h-100" style="object-fit:cover;" alt="Vanilla">
                        <span class="badge text-white p-2 position-absolute" style="top:15px;left:15px;background:linear-gradient(135deg,#ff6b9d,#c084fc);border-radius:50px;font-size:.8rem;">🔥 BEST SELLER</span>
                    </div>
                    <div class="card-body text-center p-4">
                        <h5 class="card-title fw-bold" style="color:#78350f;">Vanilla Supreme 🍦</h5>
                        <p class="card-text text-secondary small">Vanilla Madagascar dengan karamel hangat dan almond</p>
                        <div class="text-warning mb-2"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i> <span class="text-dark fw-bold small">4.8</span></div>
                        <h5 class="gradient-text fw-bold">Rp 30.000</h5>
                        <button class="btn btn-gradient rounded-pill px-4 mt-2" onclick="pesanItem('Vanilla Supreme','Rp 30.000')"><i class="bi bi-bag-heart me-2"></i>Beli Sekarang</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-5" id="tentang">
    <div class="container">
        <div class="card border-0 text-white text-center section-reveal" style="border-radius:2rem;background:linear-gradient(135deg,#ff6b9d,#c084fc,#fde68a);">
            <div class="card-body py-5 px-4">
                <h2 class="fw-bold display-6 mb-3">Siap Merasakan Kelezatan? 🍦</h2>
                <p class="fs-5 mb-4 opacity-75">Daftar sekarang dan dapatkan diskon 20% untuk pembelian pertamamu!</p>
                <a href="register.php" class="btn btn-light btn-lg rounded-pill px-4 fw-bold text-danger">
    <i class="bi bi-gift me-2"></i>Daftar & Dapatkan Diskon
</a>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="py-5 text-white" style="background:#78350f;">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4">
                <h5 class="fw-bold"><i class="bi bi-ice-cream me-2"></i>Ice Cream Shop</h5>
                <p class="opacity-75">Menyajikan es krim terbaik dengan bahan-bahan premium pilihan. Setiap sendok penuh kebahagiaan.</p>
                <div class="d-flex gap-2">
                    <a href="#" class="btn btn-outline-light rounded-circle" style="width:40px;height:40px;"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="btn btn-outline-light rounded-circle" style="width:40px;height:40px;"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="btn btn-outline-light rounded-circle" style="width:40px;height:40px;"><i class="bi bi-twitter-x"></i></a>
                    <a href="#" class="btn btn-outline-light rounded-circle" style="width:40px;height:40px;"><i class="bi bi-tiktok"></i></a>
                </div>
            </div>
            <div class="col-6 col-md-2">
                <h6 class="fw-bold">Menu</h6>
                <ul class="list-unstyled small opacity-75">
                    <li><a href="#menu" class="text-white text-decoration-none">Chocolate</a></li>
                    <li><a href="#menu" class="text-white text-decoration-none">Vanilla</a></li>
                    <li><a href="#menu" class="text-white text-decoration-none">Strawberry</a></li>
                    <li><a href="#" class="text-white text-decoration-none">Matcha</a></li>
                </ul>
            </div>
            <div class="col-6 col-md-2">
                <h6 class="fw-bold">Info</h6>
                <ul class="list-unstyled small opacity-75">
                    <li><a href="#tentang" class="text-white text-decoration-none">Tentang</a></li>
                    <li><a href="#" class="text-white text-decoration-none">Promo</a></li>
                    <li><a href="#" class="text-white text-decoration-none">Karir</a></li>
                    <li><a href="#" class="text-white text-decoration-none">Kontak</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h6 class="fw-bold">Hubungi Kami</h6>
                <ul class="list-unstyled small opacity-75">
                    <li><i class="bi bi-geo-alt me-2"></i>Jl. Es Krim No. 123, Jakarta</li>
                    <li><i class="bi bi-telephone me-2"></i>(021) 1234-5678</li>
                    <li><i class="bi bi-envelope me-2"></i>hello@icecreamshop.id</li>
                    <li><i class="bi bi-clock me-2"></i>Buka: 10:00 - 22:00</li>
                </ul>
            </div>
        </div>
        <hr class="opacity-25 mt-4">
        <p class="text-center small opacity-50 mb-0">&copy; 2026 Ice Cream Shop. Dibuat dengan ❤️</p>
    </div>
</footer>

<!-- Scroll to Top -->
<button class="scroll-top shadow" id="scrollTopBtn" onclick="window.scrollTo({top:0,behavior:'smooth'})"><i class="bi bi-arrow-up"></i></button>

<!-- Login Modal -->
<div class="modal fade" id="loginModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header modal-header-gradient justify-content-center">
                <h5 class="modal-title mb-0"><i class="bi bi-ice-cream me-2"></i>Masuk ke Akun</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <form id="loginForm">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Email</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-envelope text-muted"></i></span>
                            <input type="email" class="form-control" placeholder="contoh@email.com" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-lock text-muted"></i></span>
                            <input type="password" class="form-control" placeholder="Masukkan password" required>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between mb-3 small">
                        <div class="form-check"><input class="form-check-input" type="checkbox" id="remember"><label class="form-check-label" for="remember">Ingat saya</label></div>
                        <a href="#" class="text-danger text-decoration-none">Lupa password?</a>
                    </div>
                    <button type="submit" class="btn btn-gradient rounded-pill w-100 py-2"><i class="bi bi-box-arrow-in-right me-2"></i>Login</button>
                    <p class="text-center mt-3 small text-secondary">Belum punya akun? <a href="#" class="text-danger text-decoration-none fw-bold" data-bs-toggle="modal" data-bs-target="#registerModal" data-bs-dismiss="modal">Daftar</a></p>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Register Modal -->
<div class="modal fade" id="registerModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header modal-header-gradient justify-content-center">
                <h5 class="modal-title mb-0"><i class="bi bi-ice-cream me-2"></i>Daftar Akun Baru</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <form id="registerForm">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Lengkap</label>
                        <div class="input-group"><span class="input-group-text"><i class="bi bi-person text-muted"></i></span><input type="text" class="form-control" placeholder="Nama lengkap" required></div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Email</label>
                        <div class="input-group"><span class="input-group-text"><i class="bi bi-envelope text-muted"></i></span><input type="email" class="form-control" placeholder="contoh@email.com" required></div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Password</label>
                        <div class="input-group"><span class="input-group-text"><i class="bi bi-lock text-muted"></i></span><input type="password" class="form-control" placeholder="Buat password" required></div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Konfirmasi Password</label>
                        <div class="input-group"><span class="input-group-text"><i class="bi bi-lock-fill text-muted"></i></span><input type="password" class="form-control" placeholder="Ulangi password" required></div>
                    </div>
                    <div class="form-check mb-3 small"><input class="form-check-input" type="checkbox" id="agree" required><label class="form-check-label" for="agree">Saya setuju dengan <a href="#" class="text-danger">syarat & ketentuan</a></label></div>
                    <button type="submit" class="btn btn-gradient rounded-pill w-100 py-2"><i class="bi bi-person-plus me-2"></i>Daftar Sekarang</button>
                    <p class="text-center mt-3 small text-secondary">Sudah punya akun? <a href="#" class="text-danger text-decoration-none fw-bold" data-bs-toggle="modal" data-bs-target="#loginModal" data-bs-dismiss="modal">Login</a></p>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- WhatsApp Order Modal -->
<div class="modal fade" id="waModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content border-0">
            <div class="modal-header modal-header-wa justify-content-center">
                <h5 class="modal-title mb-0">📱 Pesan via WhatsApp</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4 text-center">
                <div class="badge bg-light text-dark fw-bold py-2 px-3 rounded-pill mb-3">🍦 <span id="waItemName">-</span></div>
                <p class="mb-3 fw-semibold">Harga: <span id="waItemPrice" class="text-danger">-</span></p>
                <div class="p-3 rounded-3 mb-3" style="background:#f0fdf4;border:2px solid #bbf7d0;">
                    <p class="mb-1 fw-semibold text-success small">📞 Hubungi kami via WhatsApp</p>
                    <h4 class="fw-bold text-success mb-2">+62 812-3456-7890</h4>
                    <button class="btn btn-wa rounded-pill w-100 py-2" onclick="openWhatsApp()"><i class="bi bi-whatsapp me-2"></i>Chat Sekarang</button>
                </div>
                <div class="alert alert-warning small py-2 px-3 mb-0"><i class="bi bi-info-circle me-1"></i> Untuk pemesanan, hubungi nomor WA di atas. Admin kami akan merespons dengan cepat! ⚡</div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Navbar shadow on scroll
    window.addEventListener('scroll', () => {
        document.getElementById('mainNav').classList.toggle('shadow-sm', window.scrollY <= 10);
        document.getElementById('mainNav').classList.toggle('shadow', window.scrollY > 10);
        const btn = document.getElementById('scrollTopBtn');
        btn.classList.toggle('show', window.scrollY > 500);
    });

    // Smooth scroll
    function scrollToSection(id) {
        const el = document.getElementById(id);
        if (el) {
            const y = el.getBoundingClientRect().top + window.pageYOffset - 80;
            window.scrollTo({ top: y, behavior: 'smooth' });
        }
        const nav = bootstrap.Collapse.getInstance(document.getElementById('navbarNav'));
        if (nav) nav.hide();
    }

    document.querySelectorAll('a[href^="#"]').forEach(a => {
        a.addEventListener('click', e => {
            e.preventDefault();
            scrollToSection(a.getAttribute('href').slice(1));
        });
    });

    // Reveal on scroll
    const reveals = document.querySelectorAll('.section-reveal');
    const checkReveal = () => {
        reveals.forEach(el => {
            if (el.getBoundingClientRect().top < window.innerHeight - 80) el.classList.add('active');
        });
    };
    window.addEventListener('scroll', checkReveal);
    window.addEventListener('load', checkReveal);

    // Counter
    let counted = false;
    window.addEventListener('scroll', () => {
        if (counted) return;
        const stats = document.querySelector('[data-target]');
        if (stats && stats.getBoundingClientRect().top < window.innerHeight - 50) {
            counted = true;
            document.querySelectorAll('[data-target]').forEach(counter => {
                const target = +counter.dataset.target;
                let current = 0;
                const inc = target / 120;
                const step = () => {
                    current += inc;
                    if (current < target) { counter.textContent = Math.floor(current).toLocaleString('id-ID'); requestAnimationFrame(step); }
                    else { counter.textContent = target.toLocaleString('id-ID'); }
                };
                step();
            });
        }
    });

    // WhatsApp order
    let waName = '', waPrice = '';
    const waNum = '6281234567890';

    function pesanItem(name, price) {
        waName = name; waPrice = price;
        document.getElementById('waItemName').textContent = name;
        document.getElementById('waItemPrice').textContent = price;
        new bootstrap.Modal(document.getElementById('waModal')).show();
    }

    function openWhatsApp() {
        const msg = `Halo Ice Cream Shop! 🍦\n\nSaya ingin memesan:\n🍦 *${waName}*\n💰 Harga: ${waPrice}\n\nMohon info lebih lanjut ya. Terima kasih! 😊`;
        window.open(`https://wa.me/${waNum}?text=${encodeURIComponent(msg)}`, '_blank');
    }

    // Form submit
    document.getElementById('loginForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const btn = this.querySelector('button[type="submit"]');
        const orig = btn.innerHTML;
        btn.disabled = true;
        btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Loading...';
        setTimeout(() => {
            btn.innerHTML = '<i class="bi bi-check-circle me-2"></i>Berhasil!';
            btn.classList.remove('btn-gradient'); btn.style.background = '#10b981';
            setTimeout(() => {
                bootstrap.Modal.getInstance(document.getElementById('loginModal')).hide();
                btn.innerHTML = orig; btn.disabled = false; btn.style.background = ''; btn.classList.add('btn-gradient');
                this.reset();
            }, 1200);
        }, 1200);
    });

    document.getElementById('registerForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const btn = this.querySelector('button[type="submit"]');
        const orig = btn.innerHTML;
        btn.disabled = true;
        btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Loading...';
        setTimeout(() => {
            btn.innerHTML = '<i class="bi bi-check-circle me-2"></i>Berhasil!';
            btn.classList.remove('btn-gradient'); btn.style.background = '#10b981';
            setTimeout(() => {
                bootstrap.Modal.getInstance(document.getElementById('registerModal')).hide();
                btn.innerHTML = orig; btn.disabled = false; btn.style.background = ''; btn.classList.add('btn-gradient');
                this.reset();
            }, 1200);
        }, 1200);
    });
</script>
</body>
</html>

