<?php
/**
 * Setup Script untuk Membuat Admin User
 * Jalankan sekali saja untuk membuat akun admin
 * Hapus file ini setelah setup selesai untuk keamanan
 */

require_once 'config/database.php';

$message = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $full_name = trim($_POST['full_name'] ?? '');
    
    if (empty($username) || empty($email) || empty($password) || empty($full_name)) {
        $error = 'Semua field harus diisi!';
    } else {
        $conn = getConnection();
        
        // Check if username exists
        $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $error = 'Username sudah digunakan!';
        } else {
            $stmt->close();
            
            // Check if email exists
            $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result->num_rows > 0) {
                $error = 'Email sudah terdaftar!';
            } else {
                $stmt->close();
                
                // Hash password
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                
                // Insert admin user
                $stmt = $conn->prepare("INSERT INTO users (username, email, password, full_name, role) VALUES (?, ?, ?, ?, 'admin')");
                $stmt->bind_param("ssss", $username, $email, $hashed_password, $full_name);
                
                if ($stmt->execute()) {
                    $message = 'Akun admin berhasil dibuat! Silakan login dengan kredensial yang telah dibuat.';
                    $username = '';
                    $email = '';
                    $full_name = '';
                } else {
                    $error = 'Terjadi kesalahan saat membuat akun admin.';
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
    <title>Setup Admin - Sistem Informasi Penjualan dan Keuangan</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="auth-page">
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <h1>Setup Admin</h1>
                <h2>Buat Akun Administrator</h2>
                <p>Jalankan sekali untuk membuat akun admin pertama</p>
            </div>
            
            <?php if ($error): ?>
                <div class="alert alert-error">
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>
            
            <?php if ($message): ?>
                <div class="alert alert-success">
                    <?php echo htmlspecialchars($message); ?>
                </div>
            <?php endif; ?>
            
            <form method="POST" action="setup_admin.php" class="auth-form">
                <div class="form-group">
                    <label for="full_name">Nama Lengkap</label>
                    <input type="text" id="full_name" name="full_name" required 
                           value="<?php echo htmlspecialchars($_POST['full_name'] ?? ''); ?>"
                           placeholder="Masukkan nama lengkap">
                </div>
                
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required 
                           value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>"
                           placeholder="Masukkan username">
                </div>
                
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required 
                           value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>"
                           placeholder="Masukkan email">
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required 
                           placeholder="Masukkan password (min. 6 karakter)"
                           minlength="6">
                </div>
                
                <button type="submit" class="btn btn-primary btn-block">Buat Akun Admin</button>
            </form>
            
            <div class="auth-footer">
                <p><a href="index.php">Kembali ke Beranda</a></p>
                <p style="color: #ef4444; font-size: 0.75rem; margin-top: 1rem;">
                    ⚠️ Hapus file ini setelah setup selesai untuk keamanan!
                </p>
            </div>
        </div>
    </div>
    <script src="assets/js/main.js"></script>
</body>
</html>

