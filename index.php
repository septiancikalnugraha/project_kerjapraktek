<?php
require_once 'config/database.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sistem Informasi Penjualan dan Keuangan CV. PANCA INDRA KEMASAN - Solusi terintegrasi untuk meningkatkan efisiensi operasional perusahaan">
    <title>Sistem Informasi Penjualan dan Keuangan - CV. PANCA INDRA KEMASAN</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="container">
            <div class="nav-brand">
                <div class="brand-logo">📦</div>
                <div class="brand-text">
                    <h1>PANCA INDRA KEMASAN</h1>
                    <span class="brand-tagline">Solusi Kemasan Terpercaya</span>
                </div>
            </div>
            <div class="nav-menu">
                <button class="nav-tab active" data-panel="beranda" onclick="switchPanel('beranda'); return false;">
                    <span class="tab-icon">🏠</span>
                    <span>Beranda</span>
                </button>
                <button class="nav-tab" data-panel="fitur" onclick="switchPanel('fitur'); return false;">
                    <span class="tab-icon">⭐</span>
                    <span>Fitur</span>
                </button>
                <button class="nav-tab" data-panel="keunggulan" onclick="switchPanel('keunggulan'); return false;">
                    <span class="tab-icon">🎯</span>
                    <span>Keunggulan</span>
                </button>
                <a href="login.php" class="nav-link">Masuk</a>
                <a href="register.php" class="nav-link btn-primary">Daftar Sekarang</a>
            </div>
        </div>
    </nav>

    <?php include 'includes/home_panels.php'; ?>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <div class="cta-content">
                <h2>Siap Meningkatkan Efisiensi Operasional?</h2>
                <p>Bergabunglah dengan CV. PANCA INDRA KEMASAN dan rasakan kemudahan mengelola penjualan dan keuangan</p>
                <div class="cta-buttons">
                    <a href="register.php" class="btn btn-large btn-primary">
                        <span>Daftar Sekarang</span>
                        <span class="btn-icon">→</span>
                    </a>
                    <a href="login.php" class="btn btn-large btn-light">Masuk ke Sistem</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <div class="footer-brand">
                        <div class="brand-logo">📦</div>
                        <h3>PANCA INDRA KEMASAN</h3>
                        <p>Solusi kemasan terpercaya untuk kebutuhan bisnis Anda</p>
                    </div>
                </div>
                <div class="footer-section">
                    <h4>Navigasi</h4>
                    <ul>
                        <li><a href="index.php">Beranda</a></li>
                        <li><a href="#fitur" onclick="switchPanel('fitur'); return false;">Fitur</a></li>
                        <li><a href="#keunggulan" onclick="switchPanel('keunggulan'); return false;">Keunggulan</a></li>
                        <li><a href="login.php">Masuk</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h4>Sistem</h4>
                    <ul>
                        <li><a href="register.php">Daftar</a></li>
                        <li><a href="login.php">Login</a></li>
                        <li><a href="dashboard.php">Dashboard</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h4>Kontak</h4>
                    <ul>
                        <li>Email: info@pancaindra.com</li>
                        <li>Telp: (021) 1234-5678</li>
                        <li>Alamat: Jakarta, Indonesia</li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; <?php echo date('Y'); ?> CV. PANCA INDRA KEMASAN. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="assets/js/main.js"></script>
</body>
</html>

