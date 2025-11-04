<?php
require_once 'config/database.php';
require_once 'config/auth.php';

// Ensure default owner is available
ensureDefaultOwnerAccount();

// Redirect if already logged in
if (isLoggedIn()) {
    header('Location: dashboard.php');
    exit();
}

$error = '';
$success = '';

// Handle login form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    if (empty($username) || empty($password)) {
        $error = 'Username dan password harus diisi!';
    } else {
        $conn = getConnection();
        $stmt = $conn->prepare("SELECT id, username, email, password, full_name, role, status FROM users WHERE username = ? OR email = ?");
        $stmt->bind_param("ss", $username, $username);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            
            // Check if user is active
            if ($user['status'] !== 'active') {
                $error = 'Akun Anda tidak aktif. Hubungi administrator.';
            } elseif (password_verify($password, $user['password'])) {
                // Set session
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['full_name'] = $user['full_name'];
                $_SESSION['role'] = $user['role'];
                $_SESSION['email'] = $user['email'];
                
                // Redirect to dashboard
                header('Location: dashboard.php');
                exit();
            } else {
                $error = 'Username atau password salah!';
            }
        } else {
            $error = 'Username atau password salah!';
        }
        
        $stmt->close();
    }
}

// Check for success message from registration
if (isset($_GET['registered'])) {
    $success = 'Registrasi berhasil! Silakan login dengan akun Anda.';
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Informasi Penjualan dan Keuangan</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="auth-page auth-login">
    <div class="auth-wrapper">
        <div class="auth-card">
            <div class="auth-grid">
                <div class="auth-info">
                    <div class="auth-info-inner">
                        <div class="auth-brand">
                            <div class="auth-logo">📦</div>
                            <div class="auth-copy">
                                <span class="auth-eyebrow">Sistem Informasi Penjualan &amp; Keuangan</span>
                                <h2>CV. PANCA INDRA KEMASAN</h2>
                            </div>
                        </div>
                        <p class="auth-lead">
                            Dashboard tunggal untuk memantau penjualan, pelanggan, dan arus kas tanpa kerumitan.
                        </p>
                        <div class="auth-highlight-card">
                            <span class="meta-badge">Admin &amp; Owner</span>
                            <p>Masuk untuk melanjutkan pekerjaan Anda dan tetap selangkah di depan kinerja bisnis.</p>
                        </div>
                    </div>
                    <div class="auth-info-footer">
                        <p>Belum punya akun? <a href="register.php">Daftar sekarang</a></p>
                    </div>
                </div>

                <div class="auth-form">
                    <div class="auth-header">
                        <span class="auth-badge">Masuk</span>
                        <h1>Selamat datang kembali 👋</h1>
                        <p>Gunakan username atau email terdaftar untuk mengakses dashboard.</p>
                    </div>

                    <?php if ($error): ?>
                        <div class="alert alert-error" role="alert">
                            <?php echo htmlspecialchars($error); ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($success): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo htmlspecialchars($success); ?>
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="login.php" class="auth-form-body" novalidate>
                        <div class="form-group">
                            <label for="username">Username atau Email</label>
                            <div class="form-field">
                                <span class="input-icon">👤</span>
                                <input
                                    type="text"
                                    id="username"
                                    name="username"
                                    class="form-control"
                                    required
                                    value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>"
                                    placeholder="Masukkan username atau email"
                                    autocomplete="username"
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
                                    placeholder="Masukkan password"
                                    autocomplete="current-password"
                                >
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">Masuk ke Dashboard</button>
                    </form>

                    <div class="auth-footer">
                        <p>Belum punya akun? <a href="register.php">Daftar di sini</a></p>
                        <p><a href="index.php" class="auth-link">← Kembali ke Beranda</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/main.js"></script>
</body>
</html>

