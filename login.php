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
<body class="auth-page">
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <h1>CV. PANCA INDRA KEMASAN</h1>
                <h2>Masuk ke Sistem</h2>
                <p>Sistem Informasi Penjualan dan Keuangan</p>
            </div>
            
            <?php if ($error): ?>
                <div class="alert alert-error">
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>
            
            <?php if ($success): ?>
                <div class="alert alert-success">
                    <?php echo htmlspecialchars($success); ?>
                </div>
            <?php endif; ?>
            
            <form method="POST" action="login.php" class="auth-form">
                <div class="form-group">
                    <label for="username">Username atau Email</label>
                    <input type="text" id="username" name="username" required 
                           value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>"
                           placeholder="Masukkan username atau email">
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required 
                           placeholder="Masukkan password">
                </div>
                
                <button type="submit" class="btn btn-primary btn-block">Masuk</button>
            </form>
            
            <div class="auth-footer">
                <p>Belum punya akun? <a href="register.php">Daftar di sini</a></p>
                <p><a href="index.php">Kembali ke Beranda</a></p>
            </div>
        </div>
    </div>
    <script src="assets/js/main.js"></script>
</body>
</html>

