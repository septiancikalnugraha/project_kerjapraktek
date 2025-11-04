<?php
/**
 * Konfigurasi Database
 * Sistem Informasi Penjualan dan Keuangan
 * CV. PANCA INDRA KEMASAN
 */

// Konfigurasi Database
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'kerjapraktek_db');

// Koneksi ke Database
try {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    
    // Set charset
    $conn->set_charset("utf8mb4");
    
    // Check connection
    if ($conn->connect_error) {
        throw new Exception("Koneksi database gagal: " . $conn->connect_error);
    }
} catch (Exception $e) {
    die("Error: " . $e->getMessage());
}

// Fungsi untuk mendapatkan koneksi
function getConnection() {
    global $conn;
    return $conn;
}

/**
 * Ensure default owner account exists and stays active
 */
function ensureDefaultOwnerAccount() {
    $conn = getConnection();

    $defaultUsername = 'owner';
    $defaultEmail = 'pancaindra@gmail.com';
    $defaultFullName = 'Pemilik Perusahaan';
    $defaultPassword = 'owner123';

    $query = "SELECT id, email, password, status FROM users WHERE username = ? OR role = 'owner' ORDER BY id ASC LIMIT 1";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $defaultUsername);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($owner = $result->fetch_assoc()) {
        $stmt->close();

        $needsUpdate = false;
        $newEmail = $owner['email'];
        $newPasswordHash = $owner['password'];
        $newStatus = $owner['status'];

        if ($owner['email'] !== $defaultEmail) {
            $newEmail = $defaultEmail;
            $needsUpdate = true;
        }

        if (!password_verify($defaultPassword, $owner['password'])) {
            $newPasswordHash = password_hash($defaultPassword, PASSWORD_DEFAULT);
            $needsUpdate = true;
        }

        if ($owner['status'] !== 'active') {
            $newStatus = 'active';
            $needsUpdate = true;
        }

        if ($needsUpdate) {
            $updateStmt = $conn->prepare("UPDATE users SET email = ?, password = ?, status = ?, role = 'owner' WHERE id = ?");
            $updateStmt->bind_param('sssi', $newEmail, $newPasswordHash, $newStatus, $owner['id']);
            $updateStmt->execute();
            $updateStmt->close();
        }
    } else {
        $stmt->close();
        $hashedPassword = password_hash($defaultPassword, PASSWORD_DEFAULT);

        $insertStmt = $conn->prepare("INSERT INTO users (username, email, password, full_name, role, status) VALUES (?, ?, ?, ?, 'owner', 'active')");
        $insertStmt->bind_param('ssss', $defaultUsername, $defaultEmail, $hashedPassword, $defaultFullName);
        $insertStmt->execute();
        $insertStmt->close();
    }
}
?>

