<?php
require_once 'config/database.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sistem Informasi Penjualan dan Keuangan CV. PANCA INDRA KEMASAN - Solusi terintegrasi untuk meningkatkan efisiensi operasional perusahaan">
    <meta name="keywords" content="sistem penjualan, sistem keuangan, manajemen bisnis, CV Panca Indra Kemasan">
    <meta name="author" content="CV. PANCA INDRA KEMASAN">
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
                <button class="nav-tab active" data-panel="beranda" onclick="switchPanel('beranda')">
                    <span class="tab-icon">🏠</span>
                    <span>Beranda</span>
                </button>
                <button class="nav-tab" data-panel="fitur" onclick="switchPanel('fitur')">
                    <span class="tab-icon">⭐</span>
                    <span>Fitur</span>
                </button>
                <button class="nav-tab" data-panel="keunggulan" onclick="switchPanel('keunggulan')">
                    <span class="tab-icon">🎯</span>
                    <span>Keunggulan</span>
                </button>
                <a href="login.php" class="nav-link">Masuk</a>
                <a href="register.php" class="nav-link btn-primary">Daftar Sekarang</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-background">
            <div class="hero-shape hero-shape-1"></div>
            <div class="hero-shape hero-shape-2"></div>
            <div class="hero-shape hero-shape-3"></div>
        </div>
        <div class="container">
            <div class="hero-content">
                <div class="hero-badge">
                    <span class="badge-icon">✨</span>
                    <span>Sistem Terintegrasi & Modern</span>
                </div>
                <h1 class="hero-title">
                    Kelola Bisnis Anda dengan <br>
                    <span class="gradient-text">Lebih Efisien & Cerdas</span>
                </h1>
                <p class="hero-subtitle">Sistem Informasi Penjualan dan Keuangan Terpadu</p>
                <p class="hero-description">
                    Tingkatkan produktivitas dan transparansi bisnis Anda dengan sistem manajemen penjualan dan keuangan yang komprehensif. 
                    Dapatkan insight real-time, otomatisasi proses, dan kontrol penuh atas operasional perusahaan.
                </p>
                <div class="hero-buttons">
                    <a href="register.php" class="btn btn-large btn-primary btn-glow">
                        <span>Mulai Gratis Sekarang</span>
                        <span class="btn-icon">→</span>
                    </a>
                    <a href="login.php" class="btn btn-large btn-light">
                        <span class="btn-icon">🔓</span>
                        <span>Masuk ke Sistem</span>
                    </a>
                </div>
                <div class="hero-stats">
                    <div class="stat-item">
                        <div class="stat-number">99.9%</div>
                        <div class="stat-label">Uptime Sistem</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">10+</div>
                        <div class="stat-label">Fitur Terintegrasi</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">24/7</div>
                        <div class="stat-label">Support Tersedia</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">100%</div>
                        <div class="stat-label">Data Aman</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Dynamic Panels Container -->
    <div class="home-panels-container">
        <div class="container">
            <div class="home-panels-wrapper">
                
                <!-- Panel Beranda -->
                <div id="panel-beranda" class="home-panel active">
                    <div class="panel-content">
                        <div class="panel-header">
                            <span class="section-badge">🚀 Mengapa Kami?</span>
                            <h2>Solusi Terbaik untuk Bisnis Modern</h2>
                            <p>Platform all-in-one yang dirancang khusus untuk meningkatkan efisiensi dan produktivitas bisnis Anda</p>
                        </div>
                        
                        <div class="panel-stats-modern">
                            <div class="panel-stat-card-modern">
                                <div class="stat-icon-modern stat-gradient-1">
                                    <span>📊</span>
                                </div>
                                <div class="stat-info">
                                    <h3>Dashboard Interaktif Real-Time</h3>
                                    <p>Visualisasi data yang powerful dengan grafik dan chart interaktif. Pantau KPI bisnis Anda secara real-time dan buat keputusan cepat berdasarkan data akurat.</p>
                                    <div class="stat-features">
                                        <span class="feature-tag">📈 Analytics</span>
                                        <span class="feature-tag">📉 Reports</span>
                                        <span class="feature-tag">🎯 KPI Tracking</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="panel-stat-card-modern">
                                <div class="stat-icon-modern stat-gradient-2">
                                    <span>🔒</span>
                                </div>
                                <div class="stat-info">
                                    <h3>Keamanan Enterprise-Grade</h3>
                                    <p>Perlindungan data maksimal dengan enkripsi AES-256, backup otomatis setiap hari, dan compliance dengan standar keamanan internasional.</p>
                                    <div class="stat-features">
                                        <span class="feature-tag">🛡️ Encrypted</span>
                                        <span class="feature-tag">💾 Auto Backup</span>
                                        <span class="feature-tag">✅ Compliant</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="panel-stat-card-modern">
                                <div class="stat-icon-modern stat-gradient-3">
                                    <span>⚡</span>
                                </div>
                                <div class="stat-info">
                                    <h3>Performa Super Cepat</h3>
                                    <p>Teknologi cloud computing terkini memastikan akses instan dari perangkat apapun. Loading time kurang dari 2 detik, guaranteed!</p>
                                    <div class="stat-features">
                                        <span class="feature-tag">☁️ Cloud-Based</span>
                                        <span class="feature-tag">📱 Mobile Ready</span>
                                        <span class="feature-tag">🚀 Fast</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="panel-cta-modern">
                            <div class="cta-box">
                                <div class="cta-icon">🎁</div>
                                <div class="cta-text">
                                    <h3>Siap memulai transformasi digital?</h3>
                                    <p>Daftar sekarang dan dapatkan akses gratis selama 30 hari</p>
                                </div>
                                <a href="register.php" class="btn btn-primary btn-glow">Coba Gratis</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Panel Fitur -->
                <div id="panel-fitur" class="home-panel">
                    <div class="panel-content">
                        <div class="panel-header">
                            <span class="section-badge">⭐ Fitur Lengkap</span>
                            <h2>Semua Yang Anda Butuhkan, Dalam Satu Platform</h2>
                            <p>Fitur-fitur powerful yang dirancang untuk memaksimalkan efisiensi operasional bisnis Anda</p>
                        </div>
                        
                        <div class="features-grid-modern">
                            <div class="feature-card-modern feature-highlight">
                                <div class="feature-badge">Populer</div>
                                <div class="feature-icon-wrapper-modern">
                                    <span class="feature-icon">🛒</span>
                                </div>
                                <h3>Manajemen Penjualan Terintegrasi</h3>
                                <p>Kelola seluruh proses penjualan dari awal hingga akhir. Catat pesanan, buat invoice otomatis, lacak pembayaran, dan kelola return dengan mudah.</p>
                                <ul class="feature-list">
                                    <li>✓ Invoice & Quotation Generator</li>
                                    <li>✓ Payment Tracking Multi-Channel</li>
                                    <li>✓ Sales Analytics & Forecasting</li>
                                    <li>✓ Customer Order History</li>
                                </ul>
                                <a href="#" class="feature-link-modern">Pelajari Selengkapnya →</a>
                            </div>
                            
                            <div class="feature-card-modern">
                                <div class="feature-icon-wrapper-modern">
                                    <span class="feature-icon">📦</span>
                                </div>
                                <h3>Kontrol Inventori Pintar</h3>
                                <p>Sistem inventory management yang cerdas dengan notifikasi otomatis untuk stok menipis, tracking batch number, dan integrasi dengan supplier.</p>
                                <ul class="feature-list">
                                    <li>✓ Real-Time Stock Monitoring</li>
                                    <li>✓ Low Stock Alerts</li>
                                    <li>✓ Batch & Serial Tracking</li>
                                    <li>✓ Supplier Management</li>
                                </ul>
                                <a href="#" class="feature-link-modern">Pelajari Selengkapnya →</a>
                            </div>
                            
                            <div class="feature-card-modern">
                                <div class="feature-icon-wrapper-modern">
                                    <span class="feature-icon">💰</span>
                                </div>
                                <h3>Keuangan & Accounting</h3>
                                <p>Modul keuangan lengkap dengan multi-currency support, jurnal otomatis, laporan laba rugi, dan analisis cash flow mendalam.</p>
                                <ul class="feature-list">
                                    <li>✓ Automated Bookkeeping</li>
                                    <li>✓ P&L Statement Generator</li>
                                    <li>✓ Cash Flow Analysis</li>
                                    <li>✓ Tax Calculation Helper</li>
                                </ul>
                                <a href="#" class="feature-link-modern">Pelajari Selengkapnya →</a>
                            </div>
                            
                            <div class="feature-card-modern">
                                <div class="feature-icon-wrapper-modern">
                                    <span class="feature-icon">👥</span>
                                </div>
                                <h3>CRM & Customer Management</h3>
                                <p>Database pelanggan komprehensif dengan segmentasi otomatis, riwayat transaksi lengkap, dan tools untuk meningkatkan customer retention.</p>
                                <ul class="feature-list">
                                    <li>✓ Customer Database 360°</li>
                                    <li>✓ Purchase History Tracking</li>
                                    <li>✓ Customer Segmentation</li>
                                    <li>✓ Loyalty Program Support</li>
                                </ul>
                                <a href="#" class="feature-link-modern">Pelajari Selengkapnya →</a>
                            </div>
                            
                            <div class="feature-card-modern feature-highlight">
                                <div class="feature-badge">Terbaru</div>
                                <div class="feature-icon-wrapper-modern">
                                    <span class="feature-icon">📈</span>
                                </div>
                                <h3>Business Intelligence & Analytics</h3>
                                <p>Dashboard analitik dengan AI-powered insights, predictive analytics, dan customizable reports dalam berbagai format export.</p>
                                <ul class="feature-list">
                                    <li>✓ Interactive Dashboards</li>
                                    <li>✓ AI-Powered Insights</li>
                                    <li>✓ Custom Report Builder</li>
                                    <li>✓ Export PDF/Excel/CSV</li>
                                </ul>
                                <a href="#" class="feature-link-modern">Pelajari Selengkapnya →</a>
                            </div>
                            
                            <div class="feature-card-modern">
                                <div class="feature-icon-wrapper-modern">
                                    <span class="feature-icon">⚙️</span>
                                </div>
                                <h3>Multi-User & Role Management</h3>
                                <p>Sistem berbasis role dengan granular permissions. Kelola tim dengan hak akses yang fleksibel dan audit trail lengkap.</p>
                                <ul class="feature-list">
                                    <li>✓ Role-Based Access Control</li>
                                    <li>✓ User Activity Logging</li>
                                    <li>✓ Team Collaboration Tools</li>
                                    <li>✓ Permission Management</li>
                                </ul>
                                <a href="#" class="feature-link-modern">Pelajari Selengkapnya →</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Panel Keunggulan -->
                <div id="panel-keunggulan" class="home-panel">
                    <div class="panel-content">
                        <div class="panel-header">
                            <span class="section-badge">🎯 Keunggulan Kami</span>
                            <h2>Mengapa Ribuan Bisnis Memilih Kami</h2>
                            <p>Keunggulan kompetitif yang membuat sistem kami berbeda dari yang lain</p>
                        </div>
                        
                        <div class="benefits-modern-grid">
                            <div class="benefits-left">
                                <div class="benefit-item-modern">
                                    <div class="benefit-number">01</div>
                                    <div class="benefit-content-modern">
                                        <h3>Efisiensi Operasional Maksimal</h3>
                                        <p>Otomatisasi proses bisnis mengurangi waktu kerja manual hingga 70%. Fokuskan energi tim pada strategi growth dan inovasi yang lebih penting.</p>
                                        <div class="benefit-metrics">
                                            <div class="metric-item">
                                                <span class="metric-value">70%</span>
                                                <span class="metric-label">Lebih Cepat</span>
                                            </div>
                                            <div class="metric-item">
                                                <span class="metric-value">50%</span>
                                                <span class="metric-label">Hemat Biaya</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="benefit-item-modern">
                                    <div class="benefit-number">02</div>
                                    <div class="benefit-content-modern">
                                        <h3>Transparansi Keuangan Total</h3>
                                        <p>Lacak setiap rupiah yang masuk dan keluar dengan detail. Dapatkan visibility penuh atas kesehatan finansial dengan real-time monitoring dan alerts.</p>
                                        <div class="benefit-metrics">
                                            <div class="metric-item">
                                                <span class="metric-value">100%</span>
                                                <span class="metric-label">Akurat</span>
                                            </div>
                                            <div class="metric-item">
                                                <span class="metric-value">Real-Time</span>
                                                <span class="metric-label">Updates</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="benefit-item-modern">
                                    <div class="benefit-number">03</div>
                                    <div class="benefit-content-modern">
                                        <h3>Keputusan Berbasis Data</h3>
                                        <p>Analytics dashboard yang powerful dengan AI insights membantu Anda membuat keputusan bisnis yang tepat berdasarkan data real dan prediksi akurat.</p>
                                        <div class="benefit-metrics">
                                            <div class="metric-item">
                                                <span class="metric-value">AI</span>
                                                <span class="metric-label">Powered</span>
                                            </div>
                                            <div class="metric-item">
                                                <span class="metric-value">Smart</span>
                                                <span class="metric-label">Insights</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="benefit-item-modern">
                                    <div class="benefit-number">04</div>
                                    <div class="benefit-content-modern">
                                        <h3>Skalabilitas Tanpa Batas</h3>
                                        <p>Sistem yang tumbuh bersama bisnis Anda. Dari startup hingga enterprise dengan ribuan transaksi, infrastruktur kami siap mendukung pertumbuhan.</p>
                                        <div class="benefit-metrics">
                                            <div class="metric-item">
                                                <span class="metric-value">∞</span>
                                                <span class="metric-label">Scalable</span>
                                            </div>
                                            <div class="metric-item">
                                                <span class="metric-value">99.9%</span>
                                                <span class="metric-label">Uptime</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="benefits-right">
                                <div class="visual-card-modern">
                                    <div class="visual-icon-modern">🚀</div>
                                    <h3>Implementasi Kilat</h3>
                                    <p>Setup sistem dalam 15 menit. Onboarding cepat dengan guided tutorial dan migrasi data gratis.</p>
                                    <div class="visual-stats">
                                        <span class="visual-stat">⏱️ 15 menit setup</span>
                                        <span class="visual-stat">📚 Free training</span>
                                    </div>
                                </div>
                                
                                <div class="visual-card-modern">
                                    <div class="visual-icon-modern">🎓</div>
                                    <h3>Support Premium 24/7</h3>
                                    <p>Tim expert yang siap membantu kapanpun. Live chat, email, phone support, dan knowledge base lengkap.</p>
                                    <div class="visual-stats">
                                        <span class="visual-stat">💬 Live chat</span>
                                        <span class="visual-stat">📞 Phone support</span>
                                    </div>
                                </div>
                                
                                <div class="visual-card-modern visual-highlight">
                                    <div class="visual-icon-modern">💎</div>
                                    <h3>ROI Terbukti</h3>
                                    <p>Rata-rata klien kami mengalami peningkatan efisiensi 65% dan ROI positif dalam 3 bulan pertama.</p>
                                    <div class="visual-stats">
                                        <span class="visual-stat">📊 +65% efisiensi</span>
                                        <span class="visual-stat">💰 ROI 3 bulan</span>
                                    </div>
                                </div>
                                
                                <div class="visual-card-modern">
                                    <div class="visual-icon-modern">🏆</div>
                                    <h3>Award-Winning Platform</h3>
                                    <p>Dipercaya oleh 1000+ bisnis dan mendapat berbagai penghargaan industri untuk inovasi teknologi.</p>
                                    <div class="visual-stats">
                                        <span class="visual-stat">🏅 Top rated</span>
                                        <span class="visual-stat">⭐ 4.9/5 rating</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <div class="cta-content">
                <h2>Siap Transformasi Digital Bisnis Anda?</h2>
                <p>Bergabunglah dengan ribuan bisnis yang telah merasakan kemudahan mengelola penjualan dan keuangan</p>
                <div class="cta-buttons">
                    <a href="register.php" class="btn btn-large btn-primary btn-glow">
                        <span>Daftar Gratis Sekarang</span>
                        <span class="btn-icon">→</span>
                    </a>
                    <a href="login.php" class="btn btn-large btn-light">Sudah Punya Akun? Masuk</a>
                </div>
                <p class="cta-note">💳 Tidak perlu kartu kredit • ✅ Setup 15 menit • 🎁 Gratis 30 hari</p>
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
                        <p>Solusi kemasan terpercaya untuk kebutuhan bisnis Anda. Kami berkomitmen memberikan layanan terbaik dengan teknologi terdepan.</p>
                    </div>
                </div>
                <div class="footer-section">
                    <h4>Navigasi</h4>
                    <ul>
                        <li><a href="#" onclick="switchPanel('beranda'); return false;">Beranda</a></li>
                        <li><a href="#" onclick="switchPanel('fitur'); return false;">Fitur</a></li>
                        <li><a href="#" onclick="switchPanel('keunggulan'); return false;">Keunggulan</a></li>
                        <li><a href="login.php">Masuk</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h4>Sistem</h4>
                    <ul>
                        <li><a href="register.php">Daftar Baru</a></li>
                        <li><a href="login.php">Login</a></li>
                        <li><a href="dashboard.php">Dashboard</a></li>
                        <li><a href="#">Dokumentasi</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h4>Kontak</h4>
                    <ul>
                        <li>📧 info@pancaindra.com</li>
                        <li>📞 (021) 1234-5678</li>
                        <li>📱 +62 812-3456-7890</li>
                        <li>📍 Jakarta, Indonesia</li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; <?php echo date('Y'); ?> CV. PANCA INDRA KEMASAN. All rights reserved. | <a href="#" style="color: rgba(255, 255, 255, 0.7);">Privacy Policy</a> | <a href="#" style="color: rgba(255, 255, 255, 0.7);">Terms of Service</a></p>
            </div>
        </div>
    </footer>

    <script src="assets/js/main.js"></script>
</body>
</html>