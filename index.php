<?php
require_once 'config/database.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Penjualan dan Keuangan - CV. PANCA INDRA KEMASAN</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <div class="nav-brand">
                <h1>PANCA INDRA KEMASAN</h1>
            </div>
            <div class="nav-menu">
                <a href="index.php" class="nav-link active">Beranda</a>
                <a href="login.php" class="nav-link">Masuk</a>
                <a href="register.php" class="nav-link btn-primary">Daftar</a>
            </div>
        </div>
    </nav>

    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <h1 class="hero-title">Sistem Informasi Penjualan dan Keuangan</h1>
                <p class="hero-subtitle">Sebagai Upaya Peningkatan Efisiensi Operasional</p>
                <p class="hero-description">
                    Solusi terintegrasi untuk mengelola penjualan dan keuangan perusahaan secara efisien dan akurat.
                    Sistem ini membantu meningkatkan produktivitas dan kontrol operasional CV. PANCA INDRA KEMASAN.
                </p>
                <div class="hero-buttons">
                    <a href="register.php" class="btn btn-large btn-primary">Mulai Sekarang</a>
                    <a href="login.php" class="btn btn-large btn-secondary">Masuk ke Sistem</a>
                </div>
            </div>
        </div>
    </section>

    <section class="features">
        <div class="container">
            <h2 class="section-title">Fitur Utama</h2>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">📊</div>
                    <h3>Manajemen Penjualan</h3>
                    <p>Kelola penjualan, invoice, dan transaksi dengan mudah dan cepat.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">💰</div>
                    <h3>Manajemen Keuangan</h3>
                    <p>Pantau pemasukan dan pengeluaran perusahaan secara real-time.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">📦</div>
                    <h3>Manajemen Produk</h3>
                    <p>Kelola katalog produk, stok, dan kategori dengan efisien.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">👥</div>
                    <h3>Manajemen Pelanggan</h3>
                    <p>Database pelanggan terintegrasi untuk meningkatkan layanan.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">📈</div>
                    <h3>Laporan & Analitik</h3>
                    <p>Laporan penjualan dan keuangan untuk pengambilan keputusan.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">🔒</div>
                    <h3>Keamanan Data</h3>
                    <p>Sistem keamanan tingkat tinggi untuk melindungi data perusahaan.</p>
                </div>
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="container">
            <p>&copy; <?php echo date('Y'); ?> CV. PANCA INDRA KEMASAN. All rights reserved.</p>
        </div>
    </footer>

    <script src="assets/js/main.js"></script>
</body>
</html>

