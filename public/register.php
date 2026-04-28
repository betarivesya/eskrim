<?php
require_once '../config/Database.php';
require_once '../classes/Auth.php';

$db = new Database();
$auth = new Auth($db->connect());

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $result = $auth->register($_POST['name'], $_POST['email'], $_POST['password']);

    if ($result == "berhasil") {
        header("Location: login.php");
        exit;
    } elseif ($result == "email_sudah_ada") {
        $error = "Email sudah terdaftar!";
    } else {
        $error = "Register gagal!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Ice Cream Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #fff0f5 0%, #f3e8ff 50%, #fff7ed 100%);
            min-height: 100vh;
        }
        .card-register {
            border-radius: 1.5rem;
            overflow: hidden;
        }
        .card-header-gradient {
            background: linear-gradient(135deg, #ff6b9d, #c084fc);
        }
        .btn-gradient {
            background: linear-gradient(135deg, #ff6b9d, #c084fc);
            border: none;
            color: white;
            transition: all 0.3s ease;
        }
        .btn-gradient:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 107, 157, 0.4);
            color: white;
        }
        .input-group-text {
            background-color: #f8f9fa;
            border-right: 0;
        }
        .form-control {
            border-left: 0;
            background-color: #f8f9fa;
        }
        .form-control:focus, .form-control:valid {
            background-color: #fff;
            border-color: #ff6b9d;
        }
        .link-custom {
            color: #ff6b9d;
            text-decoration: none;
            font-weight: 600;
        }
        .link-custom:hover { color: #c084fc; }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center p-3">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5 col-xl-4">
            <div class="card card-register shadow-lg border-0">
                
                <!-- Header -->
                <div class="card-header card-header-gradient text-center py-4 border-0">
                    <div class="display-6 mb-2">🍦</div>
                    <h4 class="text-white fw-bold mb-1">Buat Akun Baru</h4>
                    <p class="text-white-50 mb-0 small">Daftar dan nikmati berbagai rasa es krim favoritmu</p>
                </div>

                <!-- Body -->
                <div class="card-body p-4">
                    
                    <?php if(isset($error)): ?>
                        <div class="alert alert-danger d-flex align-items-center" role="alert">
                            <i class="bi bi-exclamation-circle-fill me-2"></i>
                            <div><?= $error ?></div>
                            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <form method="POST">
                        <!-- Nama -->
                        <div class="mb-3">
                            <label class="form-label text-muted small fw-semibold">NAMA LENGKAP</label>
                            <div class="input-group">
                                <span class="input-group-text border-end-0"><i class="bi bi-person text-muted"></i></span>
                                <input type="text" name="name" class="form-control" placeholder="Masukkan nama lengkap" required>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label class="form-label text-muted small fw-semibold">ALAMAT EMAIL</label>
                            <div class="input-group">
                                <span class="input-group-text border-end-0"><i class="bi bi-envelope text-muted"></i></span>
                                <input type="email" name="email" class="form-control" placeholder="contoh@email.com" required>
                            </div>
                        </div>

                        <!-- Password -->
                        <div class="mb-4">
                            <label class="form-label text-muted small fw-semibold">PASSWORD</label>
                            <div class="input-group">
                                <span class="input-group-text border-end-0"><i class="bi bi-lock text-muted"></i></span>
                                <input type="password" name="password" class="form-control" placeholder="Buat password" required>
                            </div>
                        </div>

                        <!-- Submit -->
                        <button type="submit" class="btn btn-gradient w-100 py-3 rounded-pill fw-semibold mb-3">
                            <i class="bi bi-person-plus-fill me-2"></i>Register Sekarang
                        </button>
                    </form>

                    <hr class="my-4 text-muted opacity-25">

                    <p class="text-center mb-0 text-secondary">
                        Sudah punya akun? <a href="login.php" class="link-custom">Login di sini</a>
                    </p>
                </div>
            </div>

            <!-- Footer -->
            <p class="text-center text-muted small mt-3 opacity-75">&copy; 2026 Ice Cream Shop. Semua hak dilindungi.</p>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>