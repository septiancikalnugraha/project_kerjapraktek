<?php
require_once 'config/database.php';
require_once 'config/auth.php';

// Redirect if already logged in
if (isLoggedIn()) {
    header('Location: dashboard.php');
    exit();
}

$error = '';
$success = '';

// Handle registration form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    $full_name = trim($_POST['full_name'] ?? '');
    
    // Validation
    if (empty($username) || empty($email) || empty($password) || empty($full_name)) {
        $error = 'Semua field harus diisi!';
    } elseif (strlen($username) < 3) {
        $error = 'Username minimal 3 karakter!';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Format email tidak valid!';
    } elseif (strlen($password) < 6) {
        $error = 'Password minimal 6 karakter!';
    } elseif ($password !== $confirm_password) {
        $error = 'Password dan konfirmasi password tidak cocok!';
    } else {
        $conn = getConnection();
        
        // Check if username exists
        $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $error = 'Username sudah digunakan!';
            $stmt->close();
        } else {
            $stmt->close();
            
            // Check if email exists
            $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result->num_rows > 0) {
                $error = 'Email sudah terdaftar!';
                $stmt->close();
            } else {
                $stmt->close();
                
                // Hash password
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                
                // Insert new admin user
                $stmt = $conn->prepare("INSERT INTO users (username, email, password, full_name, role) VALUES (?, ?, ?, ?, 'admin')");
                $stmt->bind_param("ssss", $username, $email, $hashed_password, $full_name);
                
                if ($stmt->execute()) {
                    header('Location: login.php?registered=1');
                    exit();
                } else {
                    $error = 'Terjadi kesalahan saat mendaftar. Silakan coba lagi.';
                }
                
                $stmt->close();
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi - Sistem Informasi Penjualan dan Keuangan</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="auth-page auth-register">
    <div class="auth-wrapper">
        <div class="auth-card">
            <div class="auth-grid">
                <div class="auth-info">
                    <div class="auth-info-inner">
                        <div class="auth-brand">
                            <div class="auth-logo">📦</div>
                            <div>
                                <p class="auth-brand-subtitle">Sistem Informasi Penjualan &amp; Keuangan</p>
                                <h2>CV. PANCA INDRA KEMASAN</h2>
                            </div>
                        </div>
                        <h3>Registrasi administrator sistem</h3>
                        <p>
                            Buat akun admin untuk mengelola penjualan, pelanggan, stok, dan laporan keuangan perusahaan secara terpusat.
                        </p>
                        <ul class="auth-highlights">
                            <li><span>🧾</span> Input transaksi cepat dengan validasi otomatis</li>
                            <li><span>👥</span> Pantau hubungan pelanggan dan riwayat pembelian</li>
                            <li><span>📈</span> Insight finansial real-time untuk keputusan strategis</li>
                        </ul>
                        <div class="auth-meta-note">
                            <span class="meta-badge meta-admin">Admin Only</span>
                            <p>Hanya pengguna dengan peran administrator yang dapat mendaftar melalui halaman ini.</p>
                        </div>
                    </div>
                    <div class="auth-info-footer">
                        <p>Sudah punya akun? <a href="login.php">Masuk di sini</a></p>
                    </div>
                </div>

                <div class="auth-form">
                    <div class="auth-header">
                        <span class="auth-badge">Admin</span>
                        <h1>Daftarkan akun administrator 🚀</h1>
                        <p>Isi data berikut dengan benar. Hanya akun admin yang dapat dibuat melalui halaman ini.</p>
                    </div>

                    <?php if ($error): ?>
                        <div class="alert alert-error" role="alert">
                            <?php echo htmlspecialchars($error); ?>
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="register.php" class="auth-form-body" id="registerForm" novalidate>
                        <div class="form-group">
                            <label for="full_name">Nama Lengkap</label>
                            <div class="form-field">
                                <span class="input-icon">🙍‍♂️</span>
                                <input
                                    type="text"
                                    id="full_name"
                                    name="full_name"
                                    class="form-control"
                                    required
                                    value="<?php echo htmlspecialchars($_POST['full_name'] ?? ''); ?>"
                                    placeholder="Masukkan nama lengkap"
                                    autocomplete="name"
                                >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="username">Username</label>
                            <div class="form-field">
                                <span class="input-icon">🆔</span>
                                <input
                                    type="text"
                                    id="username"
                                    name="username"
                                    class="form-control"
                                    required
                                    minlength="3"
                                    value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>"
                                    placeholder="Masukkan username (min. 3 karakter)"
                                    autocomplete="username"
                                >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <div class="form-field">
                                <span class="input-icon">✉️</span>
                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    class="form-control"
                                    required
                                    value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>"
                                    placeholder="Masukkan email aktif"
                                    autocomplete="email"
                                >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <div class="form-field">
                                <span class="input-icon">🔒</span>
                                <input
                                    type="password"
                                    id="password"
                                    name="password"
                                    class="form-control"
                                    required
                                    minlength="6"
                                    placeholder="Masukkan password (min. 6 karakter)"
                                    autocomplete="new-password"
                                >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="confirm_password">Konfirmasi Password</label>
                            <div class="form-field">
                                <span class="input-icon">✅</span>
                                <input
                                    type="password"
                                    id="confirm_password"
                                    name="confirm_password"
                                    class="form-control"
                                    required
                                    placeholder="Ulangi password"
                                    autocomplete="new-password"
                                >
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">Daftar Sekarang</button>
                    </form>

                    <div class="auth-footer">
                        <p>Sudah punya akun? <a href="login.php">Masuk di sini</a></p>
                        <p><a href="index.php" class="auth-link">← Kembali ke Beranda</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/main.js"></script>
</body>
</html>

