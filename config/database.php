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
?>

