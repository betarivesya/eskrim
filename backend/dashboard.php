<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: ../login.php");
    exit;
}

$user = $_SESSION['user'];
$user_name = htmlspecialchars($user['name']);
$user_email = htmlspecialchars($user['email'] ?? '');
$user_initial = strtoupper(substr($user['name'], 0, 1));
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Ice Cream Shop</title>
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
        .stat-card { background: #fff; border-radius: 14px; padding: 20px; box-shadow: 0 1px 4px rgba(0,0,0,0.04); border-left: 4px solid transparent; transition: all 0.25s ease; }
        .stat-card:hover { transform: translateY(-3px); box-shadow: 0 8px 25px rgba(0,0,0,0.08); }
        .stat-card.c-pink { border-left-color: #ff6b9d; }
        .stat-card.c-purple { border-left-color: #c084fc; }
        .stat-card.c-green { border-left-color: #10b981; }
        .stat-card.c-orange { border-left-color: #f59e0b; }
        .stat-icon { width: 48px; height: 48px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.35rem; flex-shrink: 0; }
        .stat-icon.si-pink { background: #fff0f5; color: #ff6b9d; }
        .stat-icon.si-purple { background: #f5f0ff; color: #c084fc; }
        .stat-icon.si-green { background: #ecfdf5; color: #10b981; }
        .stat-icon.si-orange { background: #fffbeb; color: #f59e0b; }
        .card-box { background: #fff; border-radius: 14px; box-shadow: 0 1px 4px rgba(0,0,0,0.04); border: none; overflow: hidden; }
        .card-box .card-header { background: #fff; border-bottom: 1px solid #f1f5f9; padding: 16px 20px; display: flex; justify-content: space-between; align-items: center; }
        .card-box .card-header h6 { font-weight: 700; color: #1e293b; margin: 0; font-size: 0.95rem; }
        .select-clean { border: 1px solid #e2e8f0; border-radius: 8px; padding: 4px 12px; font-size: 0.8rem; color: #64748b; background: #f8fafc; }
        .btn-gradient { background: linear-gradient(135deg, #ff6b9d, #c084fc); border: none; color: #fff; font-weight: 600; }
        .btn-gradient:hover { color: #fff; opacity: 0.9; }
        .tbl-custom th { font-weight: 600; color: #94a3b8; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px; border-bottom: 2px solid #f1f5f9; padding: 12px 16px; white-space: nowrap; }
        .tbl-custom td { padding: 13px 16px; vertical-align: middle; color: #334155; border-bottom: 1px solid #f8fafc; }
        .tbl-custom tbody tr:hover { background: #fafbfd; }
        .status-badge { padding: 4px 12px; border-radius: 50px; font-size: 0.75rem; font-weight: 600; white-space: nowrap; }
        .st-selesai { background: #ecfdf5; color: #065f46; }
        .st-proses { background: #fffbeb; color: #92400e; }
        .st-baru { background: #eff6ff; color: #1e40af; }
        .st-batal { background: #fef2f2; color: #991b1b; }
        .avatar-sm { width: 32px; height: 32px; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #fff; font-weight: 700; font-size: 0.7rem; flex-shrink: 0; }
        .prod-item { display: flex; align-items: center; gap: 12px; padding: 10px 12px; border-radius: 10px; transition: background 0.2s; }
        .prod-item:hover { background: #f8fafc; }
        .prod-rank { width: 30px; height: 30px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 0.75rem; flex-shrink: 0; }
        .prod-img { width: 42px; height: 42px; border-radius: 10px; object-fit: cover; flex-shrink: 0; }
        .rank-1 { background: #fef3c7; color: #b45309; }
        .rank-2 { background: #f3f4f6; color: #6b7280; }
        .rank-3 { background: #fed7aa; color: #c2410c; }
        .rank-other { background: #f3f4f6; color: #9ca3af; }
        .act-item { display: flex; gap: 12px; padding: 8px 0; }
        .act-icon { width: 34px; height: 34px; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .prog-track { height: 8px; border-radius: 10px; background: #f1f5f9; overflow: hidden; }
        .prog-fill { height: 100%; border-radius: 10px; background: linear-gradient(135deg, #ff6b9d, #c084fc); }
        .rasa-legend-item { display: flex; align-items: center; justify-content: space-between; padding: 4px 0; }
        .rasa-dot { width: 10px; height: 10px; border-radius: 50%; display: inline-block; margin-right: 6px; }
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
        <a href="#" class="nav-link d-flex align-items-center active"><i class="bi bi-grid-1x2-fill"></i><span class="nav-text">Dashboard</span></a>
        <a href="#" class="nav-link d-flex align-items-center"><i class="bi bi-bag-check-fill"></i><span class="nav-text">Pesanan</span><span class="badge bg-white text-danger nav-text ms-auto">12</span></a>
        <a href="../public/produk/index.php" class="nav-link d-flex align-items-center"><i class="bi bi-cup-straw"></i><span class="nav-text">Kelola Produk</span></a>
        <a href="#" class="nav-link d-flex align-items-center"><i class="bi bi-people-fill"></i><span class="nav-text">Pelanggan</span></a>
        <div class="sidebar-label">Lainnya</div>
        <a href="#" class="nav-link d-flex align-items-center"><i class="bi bi-graph-up-arrow"></i><span class="nav-text">Laporan</span></a>
        <a href="#" class="nav-link d-flex align-items-center"><i class="bi bi-megaphone-fill"></i><span class="nav-text">Promo</span></a>
        <a href="#" class="nav-link d-flex align-items-center"><i class="bi bi-gear-fill"></i><span class="nav-text">Pengaturan</span></a>
        <div class="landing-label">Shortcut</div>
        <a href="../public/index.php" class="landing-shortcut" title="Buka Landing Page">
            <div class="icon-box"><i class="bi bi-globe2"></i></div>
            <div class="sc-text">
                <div class="sc-title">Landing Page</div>
                <div class="sc-sub">Buka halaman publik</div>
            </div>
            <i class="bi bi-box-arrow-up-right" style="font-size:0.85rem;opacity:0.6;"></i>
        </a>
        <div class="mt-2"></div>
        <a href="../public/logout.php" class="nav-link d-flex align-items-center mt-1" style="color:rgba(255,255,255,0.6);">
            <i class="bi bi-box-arrow-left"></i><span class="nav-text">Logout</span>
        </a>
        
    </div>
</nav>

<div class="main-content">
    <div class="topbar">
        <div class="d-flex align-items-center gap-3">
            <button class="menu-toggle" onclick="toggleSidebar()"><i class="bi bi-list"></i></button>
            <div class="topbar-left">
                <h5>Dashboard</h5>
                <small>Selamat datang kembali, <?= $user_name ?> 👋</small>
            </div>
        </div>
        <div class="d-flex align-items-center gap-3">
            <a href="../public/index.php" class="btn btn-sm btn-outline-danger rounded-pill px-3 d-flex align-items-center gap-2" title="Buka Landing Page" style="font-size:0.8rem;border-color:#ff6b9d;color:#ff6b9d;">
                <i class="bi bi-globe2"></i><span class="d-none d-sm-inline">Landing Page</span>
            </a>
            <button class="btn-notif"><i class="bi bi-bell"></i><span class="notif-dot"></span></button>
            <div class="d-flex align-items-center gap-2">
                <div class="user-avatar"><?= $user_initial ?></div>
                <div class="d-none d-md-block">
                    <div class="fw-bold" style="font-size:0.85rem;color:#1e293b;"><?= $user_name ?></div>
                    <div class="text-muted" style="font-size:0.7rem;"><?= $user_email ?></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-6 col-lg-3">
            <div class="stat-card c-pink">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="text-muted fw-semibold" style="font-size:0.75rem;">Total Penjualan</div>
                        <h5 class="fw-bold mt-1 mb-0" style="color:#1e293b;" id="stat1">Rp 24.5jt</h5>
                        <small class="text-success fw-semibold"><i class="bi bi-arrow-up"></i> +12.5%</small>
                    </div>
                    <div class="stat-icon si-pink"><i class="bi bi-cash-stack"></i></div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="stat-card c-purple">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="text-muted fw-semibold" style="font-size:0.75rem;">Total Pesanan</div>
                        <h5 class="fw-bold mt-1 mb-0" style="color:#1e293b;" id="stat2">1,248</h5>
                        <small class="text-success fw-semibold"><i class="bi bi-arrow-up"></i> +8.3%</small>
                    </div>
                    <div class="stat-icon si-purple"><i class="bi bi-bag-check"></i></div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="stat-card c-green">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="text-muted fw-semibold" style="font-size:0.75rem;">Pelanggan</div>
                        <h5 class="fw-bold mt-1 mb-0" style="color:#1e293b;" id="stat3">856</h5>
                        <small class="text-success fw-semibold"><i class="bi bi-arrow-up"></i> +15.2%</small>
                    </div>
                    <div class="stat-icon si-green"><i class="bi bi-people"></i></div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="stat-card c-orange">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="text-muted fw-semibold" style="font-size:0.75rem;">Produk Terjual</div>
                        <h5 class="fw-bold mt-1 mb-0" style="color:#1e293b;" id="stat4">3,421</h5>
                        <small class="text-danger fw-semibold"><i class="bi bi-arrow-down"></i> -2.1%</small>
                    </div>
                    <div class="stat-icon si-orange"><i class="bi bi-cup-straw"></i></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-lg-8">
            <div class="card-box">
                <div class="card-header">
                    <h6><i class="bi bi-graph-up me-2"></i>Grafik Penjualan Bulanan</h6>
                    <select class="select-clean"><option>2026</option><option>2025</option></select>
                </div>
                <div class="card-body p-3" style="height:400px;">
                    <canvas id="chartPenjualan"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card-box" style="height:100%;">
                <div class="card-header"><h6><i class="bi bi-pie-chart me-2"></i>Penjualan per Rasa</h6></div>
                <div class="card-body d-flex flex-column align-items-center justify-content-center">
                    <canvas id="chartRasa" style="max-width:220px;max-height:220px;"></canvas>
                    <div class="w-100 mt-3 px-2">
                        <div class="rasa-legend-item mb-2"><div class="small"><span class="rasa-dot" style="background:#ff6b9d;"></span>Chocolate</div><span class="fw-bold small">35%</span></div>
                        <div class="rasa-legend-item mb-2"><div class="small"><span class="rasa-dot" style="background:#c084fc;"></span>Vanilla</div><span class="fw-bold small">28%</span></div>
                        <div class="rasa-legend-item mb-2"><div class="small"><span class="rasa-dot" style="background:#f59e0b;"></span>Strawberry</div><span class="fw-bold small">22%</span></div>
                        <div class="rasa-legend-item"><div class="small"><span class="rasa-dot" style="background:#10b981;"></span>Lainnya</div><span class="fw-bold small">15%</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-lg-8">
            <div class="card-box">
                <div class="card-header">
                    <h6><i class="bi bi-receipt me-2"></i>Pesanan Terbaru</h6>
                    <a href="#" class="btn btn-sm btn-gradient rounded-pill px-3" style="font-size:0.78rem;">Lihat Semua</a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table tbl-custom mb-0">
                            <thead><tr><th>ID</th><th>Pelanggan</th><th>Produk</th><th>Total</th><th>Status</th><th>Tanggal</th></tr></thead>
                            <tbody>
                                <tr><td><span class="fw-bold text-primary small">#ORD001</span></td><td><div class="d-flex align-items-center gap-2"><div class="avatar-sm" style="background:linear-gradient(135deg,#ff6b9d,#c084fc);">B</div><span class="fw-semibold small">Budi Santoso</span></div></td><td class="small">Chocolate Dream x2</td><td class="fw-bold small">Rp 70.000</td><td><span class="status-badge st-selesai">Selesai</span></td><td class="small text-muted">20 Apr 2026</td></tr>
                                <tr><td><span class="fw-bold text-primary small">#ORD002</span></td><td><div class="d-flex align-items-center gap-2"><div class="avatar-sm" style="background:linear-gradient(135deg,#f59e0b,#ef4444);">S</div><span class="fw-semibold small">Siti Aminah</span></div></td><td class="small">Strawberry Bliss x3</td><td class="fw-bold small">Rp 96.000</td><td><span class="status-badge st-proses">Diproses</span></td><td class="small text-muted">20 Apr 2026</td></tr>
                                <tr><td><span class="fw-bold text-primary small">#ORD003</span></td><td><div class="d-flex align-items-center gap-2"><div class="avatar-sm" style="background:linear-gradient(135deg,#10b981,#3b82f6);">A</div><span class="fw-semibold small">Ahmad Rizki</span></div></td><td class="small">Vanilla Supreme x1</td><td class="fw-bold small">Rp 30.000</td><td><span class="status-badge st-baru">Baru</span></td><td class="small text-muted">19 Apr 2026</td></tr>
                                <tr><td><span class="fw-bold text-primary small">#ORD004</span></td><td><div class="d-flex align-items-center gap-2"><div class="avatar-sm" style="background:linear-gradient(135deg,#8b5cf6,#ec4899);">D</div><span class="fw-semibold small">Dewi Lestari</span></div></td><td class="small">Chocolate x5</td><td class="fw-bold small">Rp 125.000</td><td><span class="status-badge st-selesai">Selesai</span></td><td class="small text-muted">19 Apr 2026</td></tr>
                                <tr><td><span class="fw-bold text-primary small">#ORD005</span></td><td><div class="d-flex align-items-center gap-2"><div class="avatar-sm" style="background:linear-gradient(135deg,#f97316,#f59e0b);">R</div><span class="fw-semibold small">Rudi Hermawan</span></div></td><td class="small">Mix Platter x1</td><td class="fw-bold small">Rp 85.000</td><td><span class="status-badge st-batal">Dibatalkan</span></td><td class="small text-muted">18 Apr 2026</td></tr>
                                <tr><td><span class="fw-bold text-primary small">#ORD006</span></td><td><div class="d-flex align-items-center gap-2"><div class="avatar-sm" style="background:linear-gradient(135deg,#06b6d4,#8b5cf6);">M</div><span class="fw-semibold small">Maya Putri</span></div></td><td class="small">Vanilla x2, Strawberry x1</td><td class="fw-bold small">Rp 68.000</td><td><span class="status-badge st-selesai">Selesai</span></td><td class="small text-muted">18 Apr 2026</td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card-box">
                <div class="card-header"><h6><i class="bi bi-trophy me-2"></i>Produk Terlaris</h6></div>
                <div class="card-body p-2">
                    <div class="prod-item"><div class="prod-rank rank-1">1</div><img src="https://image.qwenlm.ai/public_source/e546538c-ece8-4a46-849b-b82e570b6fa5/136b50f5a-cd87-402e-a87e-21774e6a5fdc.png" class="prod-img" alt=""><div class="flex-grow-1"><div class="fw-bold small" style="color:#1e293b;">Chocolate Dream</div><div class="text-muted small">520 terjual</div></div><span class="fw-bold small text-success">Rp 35K</span></div>
                    <div class="prod-item"><div class="prod-rank rank-2">2</div><img src="https://image.qwenlm.ai/public_source/e546538c-ece8-4a46-849b-b82e570b6fa5/1cc076f93-f040-41e5-a0ab-f4e1a5ca2ba6.png" class="prod-img" alt=""><div class="flex-grow-1"><div class="fw-bold small" style="color:#1e293b;">Vanilla Supreme</div><div class="text-muted small">415 terjual</div></div><span class="fw-bold small text-success">Rp 30K</span></div>
                    <div class="prod-item"><div class="prod-rank rank-3">3</div><img src="https://image.qwenlm.ai/public_source/e546538c-ece8-4a46-849b-b82e570b6fa5/11f6f406c-c2ee-4ec4-8263-bfc3a0ad2b7d.png" class="prod-img" alt=""><div class="flex-grow-1"><div class="fw-bold small" style="color:#1e293b;">Strawberry Bliss</div><div class="text-muted small">380 terjual</div></div><span class="fw-bold small text-success">Rp 32K</span></div>
                    <div class="prod-item"><div class="prod-rank rank-other">4</div><img src="https://image.qwenlm.ai/public_source/e546538c-ece8-4a46-849b-b82e570b6fa5/136b50f5a-cd87-402e-a87e-21774e6a5fdc.png" class="prod-img" alt=""><div class="flex-grow-1"><div class="fw-bold small" style="color:#1e293b;">Chocolate Ice Cream</div><div class="text-muted small">290 terjual</div></div><span class="fw-bold small text-success">Rp 25K</span></div>
                    <div class="prod-item"><div class="prod-rank rank-other">5</div><div class="prod-img d-flex align-items-center justify-content-center" style="background:#dbeafe;">🍵</div><div class="flex-grow-1"><div class="fw-bold small" style="color:#1e293b;">Matcha Delight</div><div class="text-muted small">210 terjual</div></div><span class="fw-bold small text-success">Rp 28K</span></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-md-6 col-lg-4">
            <div class="card-box" style="height:100%;">
                <div class="card-header"><h6><i class="bi bi-bar-chart-line me-2"></i>Status Pesanan</h6></div>
                <div class="card-body px-4 py-4 d-flex flex-column justify-content-center">
                    <div class="mb-3"><div class="d-flex justify-content-between small mb-1"><span class="fw-semibold">Selesai</span><span class="text-success fw-bold">845 (67.7%)</span></div><div class="prog-track"><div class="prog-fill" style="width:67.7%;"></div></div></div>
                    <div class="mb-3"><div class="d-flex justify-content-between small mb-1"><span class="fw-semibold">Diproses</span><span class="text-warning fw-bold">230 (18.4%)</span></div><div class="prog-track"><div class="prog-fill" style="width:18.4%;background:#f59e0b;"></div></div></div>
                    <div class="mb-3"><div class="d-flex justify-content-between small mb-1"><span class="fw-semibold">Baru</span><span class="text-primary fw-bold">98 (7.8%)</span></div><div class="prog-track"><div class="prog-fill" style="width:7.8%;background:#3b82f6;"></div></div></div>
                    <div><div class="d-flex justify-content-between small mb-1"><span class="fw-semibold">Dibatalkan</span><span class="text-danger fw-bold">75 (6.0%)</span></div><div class="prog-track"><div class="prog-fill" style="width:6%;background:#ef4444;"></div></div></div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="card-box" style="height:100%;">
                <div class="card-header"><h6><i class="bi bi-cash-coin me-2"></i>Pendapatan Mingguan</h6></div>
                <div class="card-body p-3 d-flex flex-column justify-content-center"><canvas id="chartMingguan"></canvas></div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card-box" style="height:100%;">
                <div class="card-header"><h6><i class="bi bi-activity me-2"></i>Aktivitas Terbaru</h6></div>
                <div class="card-body p-3 d-flex flex-column justify-content-center">
                    <div class="act-item"><div class="act-icon" style="background:#ecfdf5;"><i class="bi bi-check text-success"></i></div><div><div class="fw-semibold small" style="color:#1e293b;">Pesanan #ORD001 selesai</div><small class="text-muted">2 menit lalu</small></div></div>
                    <div class="act-item"><div class="act-icon" style="background:#eff6ff;"><i class="bi bi-person-plus text-primary"></i></div><div><div class="fw-semibold small" style="color:#1e293b;">Pelanggan baru: Maya Putri</div><small class="text-muted">15 menit lalu</small></div></div>
                    <div class="act-item"><div class="act-icon" style="background:#fffbeb;"><i class="bi bi-cart text-warning"></i></div><div><div class="fw-semibold small" style="color:#1e293b;">Pesanan baru #ORD003</div><small class="text-muted">1 jam lalu</small></div></div>
                    <div class="act-item"><div class="act-icon" style="background:#fef2f2;"><i class="bi bi-x text-danger"></i></div><div><div class="fw-semibold small" style="color:#1e293b;">Pesanan #ORD005 dibatalkan</div><small class="text-muted">2 jam lalu</small></div></div>
                    <div class="act-item"><div class="act-icon" style="background:#f5f0ff;"><i class="bi bi-tag" style="color:#8b5cf6;"></i></div><div><div class="fw-semibold small" style="color:#1e293b;">Promo "Diskon 20%" aktif</div><small class="text-muted">5 jam lalu</small></div></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
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
            if (href === '../public/index.php' || href === '../public/logout.php') return;
            document.querySelectorAll('.sidebar .nav-link').forEach(function(x) { x.classList.remove('active'); });
            this.classList.add('active');
            if (window.innerWidth <= 991) toggleSidebar();
        });
    });

    var ctxPenjualan = document.getElementById('chartPenjualan').getContext('2d');
    new Chart(ctxPenjualan, {
        type: 'line',
        data: {
            labels: ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'],
            datasets: [{
                label: 'Penjualan (juta Rp)',
                data: [12,15,18,14,22,28,25,30,27,32,35,38],
                borderColor: '#ff6b9d',
                backgroundColor: 'rgba(255,107,157,0.08)',
                borderWidth: 3,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#ff6b9d',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointRadius: 4,
                pointHoverRadius: 6
            }, {
                label: 'Tahun Lalu',
                data: [8,10,12,11,15,18,16,20,19,22,25,28],
                borderColor: '#c084fc',
                backgroundColor: 'rgba(192,132,252,0.04)',
                borderWidth: 2,
                fill: true,
                tension: 0.4,
                pointRadius: 3,
                pointHoverRadius: 5,
                borderDash: [5,5]
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { position: 'top', labels: { usePointStyle: true, padding: 16, font: { size: 11 } } } },
            scales: {
                y: { beginAtZero: true, grid: { color: '#f1f5f9' }, ticks: { callback: function(v){return v+'jt';}, font: { size: 11 } } },
                x: { grid: { display: false }, ticks: { font: { size: 11 } } }
            }
        }
    });

    var ctxRasa = document.getElementById('chartRasa').getContext('2d');
    new Chart(ctxRasa, {
        type: 'doughnut',
        data: {
            labels: ['Chocolate','Vanilla','Strawberry','Lainnya'],
            datasets: [{
                data: [35,28,22,15],
                backgroundColor: ['#ff6b9d','#c084fc','#f59e0b','#10b981'],
                borderWidth: 0,
                hoverOffset: 8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '68%',
            plugins: { legend: { display: false } }
        }
    });

    var ctxMingguan = document.getElementById('chartMingguan').getContext('2d');
    new Chart(ctxMingguan, {
        type: 'bar',
        data: {
            labels: ['Sen','Sel','Rab','Kam','Jum','Sab','Min'],
            datasets: [{
                label: 'Pendapatan (rb Rp)',
                data: [850,1200,950,1400,1800,2500,2200],
                backgroundColor: ['#ff6b9d','#c084fc','#f59e0b','#10b981','#3b82f6','#ff6b9d','#c084fc'],
                borderRadius: 6,
                barThickness: 24
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, grid: { color: '#f1f5f9' }, ticks: { callback: function(v){return (v/1000)+'rb';}, font: { size: 11 } } },
                x: { grid: { display: false }, ticks: { font: { size: 11 } } }
            }
        }
    });

    window.addEventListener('load', function() {
        animateVal('stat1', 'Rp 24.5jt', 'Rp ', 'jt');
        animateVal('stat2', '1,248', '', '');
        animateVal('stat3', '856', '', '');
        animateVal('stat4', '3,421', '', '');
    });

    function animateVal(id, final, prefix, suffix) {
        var el = document.getElementById(id);
        var isDecimal = final.indexOf('.') !== -1;
        var target = parseFloat(final.replace(/[^0-9.]/g, ''));
        var current = 0;
        var inc = target / 50;
        function step() {
            current += inc;
            if (current < target) {
                var display = isDecimal ? current.toFixed(1) : Math.floor(current).toLocaleString('id-ID');
                el.textContent = prefix + display + suffix;
                requestAnimationFrame(step);
            } else {
                el.textContent = final;
            }
        }
        step();
    }
</script>
</body>
</html>