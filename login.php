<?php
session_start();
// Aktifkan error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    if (!$stmt) {
        die("Query error: " . $conn->error);
    }

    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['flash_success'] = "Selamat datang, {$user['username']}!";

            switch ($user['role']) {
                case 'ketua':
                    $_SESSION['redirect_to'] = 'ketua/dashboard.php';
                    break;
                case 'sekretaris':
                    $_SESSION['redirect_to'] = 'sekretaris/dashboard.php';
                    break;
                case 'bendahara':
                    $_SESSION['redirect_to'] = 'bendahara/dashboard.php';
                    break;
                case 'anggota':
                    $_SESSION['id_anggota'] = $user['id'];
                    $_SESSION['redirect_to'] = 'anggota/dashboard.php';
                    break;
                default:
                    $_SESSION['flash_error'] = "Role tidak dikenali!";
                    header("Location: login.php");
                    exit;
            }

            header("Location: login.php");
            exit;
        } else {
            $_SESSION['flash_error'] = "Password salah!";
            header("Location: login.php");
            exit;
        }
    } else {
        $_SESSION['flash_error'] = "Username tidak ditemukan!";
        header("Location: login.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - COM SMAKDA</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap & SweetAlert2 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <style>
        body {
            background: url(img/hero-smk2.jpg) no-repeat center center fixed;
            background-size: cover;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Poppins', sans-serif;
            margin: 0;
        }

        .login-container {
            background: rgba(0, 0, 0, 0.65);
            backdrop-filter: blur(12px);
            border-radius: 16px;
            padding: 40px 30px;
            max-width: 400px;
            width: 90%;
            color: white;
            box-shadow: 0 0 30px rgba(0,0,0,0.3);
        }

        .form-control {
            background-color: rgba(255, 255, 255, 0.15);
            color: white;
            border: 1px solid rgba(255,255,255,0.3);
        }

        .form-control::placeholder {
            color: #ccc;
        }

        .form-control:focus {
            background-color: rgba(255, 255, 255, 0.2);
            box-shadow: none;
            border-color: #0d6efd;
        }

        .btn-primary {
            background-color: #0d6efd;
            border: none;
            font-weight: 600;
        }

        .btn-light {
            font-size: 14px;
        }

        @media (max-width: 576px) {
            .login-container {
                padding: 30px 20px;
            }

            h4 {
                font-size: 1.25rem;
            }
        }
    </style>
</head>
<body>

<div class="login-container">
    <div class="text-center mb-4">
        <img src="img/logo-com.png" alt="Logo COM" width="80" height="80" class="mb-2">
        <h4 class="fw-bold text-white">Community Programmer</h4>
    </div>

    <form method="POST" action="login.php">
        <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" name="username" class="form-control" required placeholder="Masukkan username">
        </div>
        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required placeholder="Masukkan password">
        </div>
        <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>

    <div class="text-center">
        <a href="index.php" class="btn btn-light btn-sm mt-3">← Kembali ke Beranda</a>
    </div>
</div>

<!-- SweetAlert: Login Gagal -->
<?php if (isset($_SESSION['flash_error'])): ?>
<script>
Swal.fire({
    icon: 'error',
    title: 'Login Gagal!',
    text: <?= json_encode($_SESSION['flash_error']) ?>,
    confirmButtonText: 'Coba Lagi'
});
</script>
<?php unset($_SESSION['flash_error']); endif; ?>

<!-- SweetAlert: Login Berhasil -->
<?php if (isset($_SESSION['flash_success']) && isset($_SESSION['redirect_to'])): ?>
<script>
Swal.fire({
    icon: 'success',
    title: 'Login Berhasil!',
    text: <?= json_encode($_SESSION['flash_success']) ?>,
    showConfirmButton: false,
    timer: 1800
}).then(() => {
    window.location.href = <?= json_encode($_SESSION['redirect_to']) ?>;
});
</script>
<?php
unset($_SESSION['flash_success']);
unset($_SESSION['redirect_to']);
endif;
?>

<!-- SweetAlert: Logout Berhasil -->
<?php if (isset($_SESSION['logout_success'])): ?>
<script>
Swal.fire({
    icon: 'success',
    title: 'Logout Berhasil!',
    text: 'Anda telah keluar dari sistem.',
    confirmButtonText: 'OK'
});
</script>
<?php unset($_SESSION['logout_success']); endif; ?>

</body>
</html>
