<?php
require_once 'config/database.php';
require_once 'config/auth.php';

// Require login and admin/manager role
requireLogin();
checkRole(['admin', 'manajer']);

$user = getCurrentUser();
$conn = getConnection();
$page_title = 'Laporan';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($page_title); ?> - Sistem Informasi Penjualan dan Keuangan</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="dashboard-body">
    <div class="dashboard-wrapper">
        <?php include 'includes/dashboard_sidebar.php'; ?>
        
        <div class="dashboard-main">
            <?php include 'includes/dashboard_header.php'; ?>
            
            <main class="dashboard-content">
                <div class="page-header">
                    <h2>Laporan & Analitik</h2>
                </div>

                <div class="dashboard-section">
                    <h3>Pilih Jenis Laporan</h3>
                    <div class="quick-actions">
                        <a href="laporan_penjualan.php" class="action-btn">
                            <div class="action-icon">💵</div>
                            <span>Laporan Penjualan</span>
                        </a>
                        <a href="laporan_keuangan.php" class="action-btn">
                            <div class="action-icon">💰</div>
                            <span>Laporan Keuangan</span>
                        </a>
                        <a href="laporan_produk.php" class="action-btn">
                            <div class="action-icon">📦</div>
                            <span>Laporan Produk</span>
                        </a>
                        <a href="laporan_pelanggan.php" class="action-btn">
                            <div class="action-icon">👥</div>
                            <span>Laporan Pelanggan</span>
                        </a>
                    </div>
                    <p style="margin-top: 2rem; color: var(--text-light); text-align: center;">
                        Pilih jenis laporan yang ingin Anda lihat atau cetak.
                    </p>
                </div>
            </main>
        </div>
    </div>

    <script src="assets/js/main.js"></script>
    <script>
        document.getElementById('sidebarToggle')?.addEventListener('click', function() {
            document.querySelector('.dashboard-sidebar').classList.toggle('active');
        });
    </script>
</body>
</html>

