<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk - Ice Cream Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', sans-serif; }
        body { background: #f0f2f5; }
        .sidebar { width: 260px; min-height: 100vh; background: linear-gradient(180deg, #ff6b9d 0%, #c084fc 100%); position: fixed; top: 0; left: 0; z-index: 999; transition: all 0.3s ease; display: flex; flex-direction: column; }
        .sidebar.collapsed { width: 72px; }
        .sidebar.collapsed .nav-text, .sidebar.collapsed .brand-text, .sidebar.collapsed .sidebar-label, .sidebar.collapsed .badge, .sidebar.collapsed .landing-label { display: none; }
        .sidebar.collapsed .nav-link { justify-content: center; padding: 12px 0; }
        .sidebar.collapsed .nav-link i { margin: 0; }
        .sidebar-brand { padding: 24px 20px; text-align: center; border-bottom: 1px solid rgba(255,255,255,0.15); }
        .sidebar-brand h4 { color: #fff; font-weight: 800; margin: 0; }
        .sidebar-brand small { color: rgba(255,255,255,0.75); }
        .sidebar-label { color: rgba(255,255,255,0.45); font-size: 0.7rem; text-transform: uppercase; letter-spacing: 1.2px; padding: 18px 24px 6px; font-weight: 700; }
        .landing-label { color: rgba(255,255,255,0.35); font-size: 0.65rem; text-transform: uppercase; letter-spacing: 1.2px; padding: 10px 24px 4px; font-weight: 700; }
        .sidebar-nav { flex: 1; overflow-y: auto; padding: 0 10px; }
        .sidebar .nav-link { color: rgba(255,255,255,0.8); padding: 11px 16px; border-radius: 10px; margin: 2px 0; transition: all 0.25s ease; font-weight: 500; font-size: 0.9rem; gap: 10px; }
        .sidebar .nav-link:hover { background: rgba(255,255,255,0.15); color: #fff; }
        .sidebar .nav-link.active { background: rgba(255,255,255,0.25); color: #fff; font-weight: 600; }
        .sidebar .nav-link i { width: 22px; text-align: center; font-size: 1.1rem; }
        .sidebar .nav-link .badge { font-size: 0.7rem; padding: 4px 8px; }
        .sidebar-nav::-webkit-scrollbar { width: 4px; }
        .sidebar-nav::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.3); border-radius: 4px; }
        .landing-shortcut { background: rgba(255,255,255,0.15); backdrop-filter: blur(10px); border-radius: 12px; padding: 12px 16px; margin: 8px 10px; display: flex; align-items: center; gap: 10px; color: #fff; text-decoration: none; transition: all 0.25s ease; border: 1px solid rgba(255,255,255,0.2); }
        .landing-shortcut:hover { background: rgba(255,255,255,0.3); color: #fff; transform: translateY(-1px); box-shadow: 0 4px 12px rgba(0,0,0,0.15); }
        .landing-shortcut .icon-box { width: 36px; height: 36px; background: linear-gradient(135deg, #fff, rgba(255,255,255,0.7)); border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.1rem; color: #ff6b9d; flex-shrink: 0; }
        .landing-shortcut .sc-text { flex: 1; }
        .landing-shortcut .sc-title { font-size: 0.8rem; font-weight: 700; line-height: 1.2; }
        .landing-shortcut .sc-sub { font-size: 0.65rem; opacity: 0.7; }
        .main-content { margin-left: 260px; padding: 0 28px 28px; transition: all 0.3s ease; }
        .sidebar.collapsed ~ .main-content { margin-left: 72px; }
        .topbar { background: #fff; border-radius: 14px; padding: 14px 22px; margin: 20px 0 24px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 1px 4px rgba(0,0,0,0.04); gap: 16px; flex-wrap: wrap; }
        .topbar-left h5 { font-weight: 700; color: #1e293b; margin: 0; font-size: 1.15rem; }
        .topbar-left small { color: #94a3b8; }
        .user-avatar { width: 38px; height: 38px; border-radius: 50%; background: linear-gradient(135deg, #ff6b9d, #c084fc); display: flex; align-items: center; justify-content: center; color: #fff; font-weight: 700; font-size: 0.85rem; flex-shrink: 0; }
        .btn-notif { width: 38px; height: 38px; border-radius: 10px; background: #f8fafc; border: none; position: relative; cursor: pointer; color: #64748b; font-size: 1.15rem; transition: all 0.2s; }
        .btn-notif:hover { background: #f1f5f9; color: #ff6b9d; }
        .notif-dot { position: absolute; top: 8px; right: 8px; width: 7px; height: 7px; background: #ef4444; border-radius: 50%; border: 1.5px solid #fff; }
        .menu-toggle { display: none; background: #fff; border: none; border-radius: 10px; padding: 8px 12px; font-size: 1.2rem; cursor: pointer; box-shadow: 0 1px 3px rgba(0,0,0,0.08); color: #1e293b; }
        .sidebar-overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.4); z-index: 998; }
        .card-box { background: #fff; border-radius: 14px; box-shadow: 0 1px 4px rgba(0,0,0,0.04); border: none; overflow: hidden; }
        .card-box .card-header { background: #fff; border-bottom: 1px solid #f1f5f9; padding: 16px 20px; display: flex; justify-content: space-between; align-items: center; }
        .card-box .card-header h6 { font-weight: 700; color: #1e293b; margin: 0; font-size: 0.95rem; }
        .btn-gradient { background: linear-gradient(135deg, #ff6b9d, #c084fc); border: none; color: #fff; font-weight: 600; }
        .btn-gradient:hover { color: #fff; opacity: 0.9; transform: translateY(-1px); box-shadow: 0 4px 12px rgba(255,107,157,0.3); }
        .form-control:focus { border-color: #ff6b9d; box-shadow: 0 0 0 0.2rem rgba(255,107,157,0.15); }
        @media (max-width: 991px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.show { transform: translateX(0); }
            .sidebar-overlay.show { display: block; }
            .main-content { margin-left: 0 !important; padding: 0 16px 16px; }
            .menu-toggle { display: block; }
        }
    </style>
</head>
<body>

<div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

<nav class="sidebar" id="sidebar">
    <div class="sidebar-brand">
        <h4><i class="bi bi-ice-cream"></i> <span class="brand-text">Ice Cream</span></h4>
        <small class="brand-text">Dashboard Admin</small>
    </div>
    <div class="sidebar-nav">
        <div class="sidebar-label">Menu Utama</div>
        <a href="../dashboard.php" class="nav-link d-flex align-items-center"><i class="bi bi-grid-1x2-fill"></i><span class="nav-text">Dashboard</span></a>
        <a href="#" class="nav-link d-flex align-items-center"><i class="bi bi-bag-check-fill"></i><span class="nav-text">Pesanan</span><span class="badge bg-white text-danger nav-text ms-auto">12</span></a>
        <a href="#" class="nav-link d-flex align-items-center active"><i class="bi bi-cup-straw"></i><span class="nav-text">Menu Produk</span></a>
        <a href="#" class="nav-link d-flex align-items-center"><i class="bi bi-people-fill"></i><span class="nav-text">Pelanggan</span></a>
        <div class="sidebar-label">Lainnya</div>
        <a href="#" class="nav-link d-flex align-items-center"><i class="bi bi-graph-up-arrow"></i><span class="nav-text">Laporan</span></a>
        <a href="#" class="nav-link d-flex align-items-center"><i class="bi bi-megaphone-fill"></i><span class="nav-text">Promo</span></a>
        <a href="#" class="nav-link d-flex align-items-center"><i class="bi bi-gear-fill"></i><span class="nav-text">Pengaturan</span></a>
        <div class="landing-label">Shortcut</div>
        <a href="../../public/index.php" class="landing-shortcut" title="Buka Landing Page">
            <div class="icon-box"><i class="bi bi-globe2"></i></div>
            <div class="sc-text">
                <div class="sc-title">Landing Page</div>
                <div class="sc-sub">Buka halaman publik</div>
            </div>
            <i class="bi bi-box-arrow-up-right" style="font-size:0.85rem;opacity:0.6;"></i>
        </a>
        <div class="mt-2"></div>
        <a href="../../public/logout.php" class="nav-link d-flex align-items-center mt-1" style="color:rgba(255,255,255,0.6);">
            <i class="bi bi-box-arrow-left"></i><span class="nav-text">Logout</span>
        </a>
    </div>
</nav>

<div class="main-content">
    <div class="topbar">
        <div class="d-flex align-items-center gap-3">
            <button class="menu-toggle" onclick="toggleSidebar()"><i class="bi bi-list"></i></button>
            <div class="topbar-left">
                <h5>Tambah Produk Baru</h5>
                <small>Isi formulir di bawah untuk menambahkan produk es krim baru</small>
            </div>
        </div>
        <div class="d-flex align-items-center gap-3">
            <a href="index.php" class="btn btn-sm btn-outline-secondary rounded-pill px-3 d-flex align-items-center gap-2" style="font-size:0.85rem;">
                <i class="bi bi-arrow-left"></i><span class="d-none d-sm-inline">Kembali</span>
            </a>
            <button class="btn-notif"><i class="bi bi-bell"></i><span class="notif-dot"></span></button>
            <div class="d-flex align-items-center gap-2">
                <div class="user-avatar">A</div>
                <div class="d-none d-md-block">
                    <div class="fw-bold" style="font-size:0.85rem;color:#1e293b;">Admin</div>
                    <div class="text-muted" style="font-size:0.7rem;">admin@icecream.id</div>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card-box">
                <div class="card-header">
                    <h6><i class="bi bi-plus-circle me-2"></i>Formulir Produk</h6>
                </div>
                <div class="card-body p-4">
                    <form action="store.php" method="POST">
                        <div class="mb-4">
                            <label class="form-label fw-semibold text-muted small">NAMA PRODUK</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="bi bi-tag text-muted"></i></span>
                                <input type="text" name="nama" class="form-control border-start-0" placeholder="Contoh: Chocolate Dream" required>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-semibold text-muted small">HARGA (Rp)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="bi bi-cash-stack text-muted"></i></span>
                                <input type="number" name="harga" class="form-control border-start-0" placeholder="Contoh: 25000" required>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-semibold text-muted small">DESKRIPSI</label>
                            <textarea name="deskripsi" class="form-control" rows="4" placeholder="Jelaskan tentang produk ini..."></textarea>
                        </div>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="index.php" class="btn btn-light rounded-pill px-4">Batal</a>
                            <button type="submit" class="btn btn-gradient rounded-pill px-4">
                                <i class="bi bi-save me-2"></i>Simpan Produk
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function toggleSidebar() {
        var s = document.getElementById('sidebar');
        var o = document.getElementById('sidebarOverlay');
        if (window.innerWidth <= 991) { s.classList.toggle('show'); o.classList.toggle('show'); }
        else { s.classList.toggle('collapsed'); }
    }

    document.querySelectorAll('.sidebar .nav-link').forEach(function(link) {
        link.addEventListener('click', function(e) {
            var href = this.getAttribute('href');
            if (href.includes('public/') || href.includes('logout')) return;
            document.querySelectorAll('.sidebar .nav-link').forEach(function(x) { x.classList.remove('active'); });
            this.classList.add('active');
            if (window.innerWidth <= 991) toggleSidebar();
        });
    });
</script>
</body>
</html>

