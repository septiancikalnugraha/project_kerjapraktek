<?php
require_once 'config/database.php';
require_once 'config/auth.php';

// Require login
requireLogin();

$user = getCurrentUser();
$conn = getConnection();
$page_title = 'Dashboard';

// Get dashboard statistics
// Total Sales Today
$today = date('Y-m-d');
$stmt = $conn->prepare("SELECT COALESCE(SUM(total), 0) as total_sales FROM sales WHERE DATE(sale_date) = ? AND status = 'completed'");
$stmt->bind_param("s", $today);
$stmt->execute();
$result = $stmt->get_result();
$today_sales = $result->fetch_assoc()['total_sales'];
$stmt->close();

// Total Sales This Month
$month_start = date('Y-m-01');
$stmt = $conn->prepare("SELECT COALESCE(SUM(total), 0) as total_sales FROM sales WHERE DATE(sale_date) >= ? AND status = 'completed'");
$stmt->bind_param("s", $month_start);
$stmt->execute();
$result = $stmt->get_result();
$month_sales = $result->fetch_assoc()['total_sales'];
$stmt->close();

// Total Income This Month
$stmt = $conn->prepare("SELECT COALESCE(SUM(amount), 0) as total_income FROM income WHERE DATE(income_date) >= ?");
$stmt->bind_param("s", $month_start);
$stmt->execute();
$result = $stmt->get_result();
$month_income = $result->fetch_assoc()['total_income'];
$stmt->close();

// Total Expenses This Month
$stmt = $conn->prepare("SELECT COALESCE(SUM(amount), 0) as total_expenses FROM expenses WHERE DATE(expense_date) >= ?");
$stmt->bind_param("s", $month_start);
$stmt->execute();
$result = $stmt->get_result();
$month_expenses = $result->fetch_assoc()['total_expenses'];
$stmt->close();

// Total Products
$result = $conn->query("SELECT COUNT(*) as total FROM products");
$total_products = $result->fetch_assoc()['total'];

// Total Customers
$result = $conn->query("SELECT COUNT(*) as total FROM customers");
$total_customers = $result->fetch_assoc()['total'];

// Recent Sales
$recent_sales = [];
$result = $conn->query("SELECT s.*, c.name as customer_name, u.full_name as seller_name 
                        FROM sales s 
                        LEFT JOIN customers c ON s.customer_id = c.id 
                        LEFT JOIN users u ON s.user_id = u.id 
                        ORDER BY s.sale_date DESC LIMIT 5");
if ($result) {
    $recent_sales = $result->fetch_all(MYSQLI_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($page_title); ?> - Sistem Informasi Penjualan dan Keuangan</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/dashboard.css">
</head>
<body class="dashboard-body">
    <div class="dashboard-wrapper">
        <?php include 'includes/dashboard_sidebar.php'; ?>
        
        <div class="dashboard-main">
            <?php include 'includes/dashboard_header.php'; ?>
            
            <main class="dashboard-content">
                <div class="page-grid">
                    <section class="welcome-card glass-card">
                        <div>
                            <p class="welcome-subtitle">Halo, <?php echo htmlspecialchars($user['full_name']); ?></p>
                            <h2 class="welcome-title">Selamat datang kembali!</h2>
                            <p class="welcome-text">Pantau performa penjualan, pelanggan, dan cashflow bisnis Anda di satu tempat.</p>
                        </div>
                        <div class="welcome-icon">📈</div>
                    </section>

                    <section class="stat-grid">
                        <article class="stat-card">
                            <div class="stat-icon gradient-blue">💰</div>
                            <div class="stat-detail">
                                <p class="stat-label">Penjualan Hari Ini</p>
                                <h3 class="stat-value">Rp <?php echo number_format($today_sales, 0, ',', '.'); ?></h3>
                                <span class="stat-caption">Perbandingan dengan kemarin akan tampil di sini</span>
                            </div>
                        </article>

                        <article class="stat-card">
                            <div class="stat-icon gradient-purple">📊</div>
                            <div class="stat-detail">
                                <p class="stat-label">Penjualan Bulan Ini</p>
                                <h3 class="stat-value">Rp <?php echo number_format($month_sales, 0, ',', '.'); ?></h3>
                                <span class="stat-caption">Akumulasi transaksi sejak awal bulan</span>
                            </div>
                        </article>

                        <article class="stat-card">
                            <div class="stat-icon gradient-emerald">🧾</div>
                            <div class="stat-detail">
                                <p class="stat-label">Pelanggan Terdaftar</p>
                                <h3 class="stat-value"><?php echo number_format($total_customers, 0, ',', '.'); ?></h3>
                                <span class="stat-caption">Total pelanggan aktif saat ini</span>
                            </div>
                        </article>
                    </section>

                    <section class="data-panels">
                        <div class="panel-card">
                            <div class="panel-heading">
                                <h3>Transaksi Terbaru</h3>
                                <a href="penjualan.php" class="panel-link">Lihat semua</a>
                            </div>
                            <div class="panel-body">
                                <?php if (!empty($recent_sales)): ?>
                                    <table class="data-table">
                                        <thead>
                                            <tr>
                                                <th>Tanggal</th>
                                                <th>Pelanggan</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($recent_sales as $sale): ?>
                                                <tr>
                                                    <td><?php echo date('d M Y', strtotime($sale['sale_date'])); ?></td>
                                                    <td><?php echo htmlspecialchars($sale['customer_name'] ?? '-'); ?></td>
                                                    <td>Rp <?php echo number_format($sale['total'], 0, ',', '.'); ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                <?php else: ?>
                                    <div class="empty-state">
                                        <span class="empty-icon">🗒️</span>
                                        <p>Belum ada transaksi yang tercatat.</p>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="panel-card">
                            <div class="panel-heading">
                                <h3>Produk Terlaris</h3>
                                <a href="produk.php" class="panel-link">Kelola produk</a>
                            </div>
                            <div class="panel-body">
                                <?php if (!empty($topProducts)): ?>
                                    <table class="data-table">
                                        <thead>
                                            <tr>
                                                <th>Produk</th>
                                                <th>Jumlah Terjual</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($topProducts as $product): ?>
                                                <tr>
                                                    <td><?php echo htmlspecialchars($product['name']); ?></td>
                                                    <td><?php echo $product['total_sold']; ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                <?php else: ?>
                                    <div class="empty-state">
                                        <span class="empty-icon">📦</span>
                                        <p>Belum ada data produk terlaris yang tersedia.</p>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </section>

                    <section class="quick-links">
                        <h3 class="quick-title">Akses cepat</h3>
                        <div class="quick-grid">
                            <a href="penjualan.php" class="quick-card">
                                <span class="quick-icon gradient-blue">💵</span>
                                <div>
                                    <p>Penjualan</p>
                                    <span>Catat transaksi baru</span>
                                </div>
                            </a>
                            <a href="produk.php" class="quick-card">
                                <span class="quick-icon gradient-purple">📦</span>
                                <div>
                                    <p>Produk</p>
                                    <span>Kelola inventori</span>
                                </div>
                            </a>
                            <a href="pelanggan.php" class="quick-card">
                                <span class="quick-icon gradient-emerald">👥</span>
                                <div>
                                    <p>Pelanggan</p>
                                    <span>Lihat relasi pelanggan</span>
                                </div>
                            </a>
                            <a href="keuangan.php" class="quick-card">
                                <span class="quick-icon gradient-orange">💰</span>
                                <div>
                                    <p>Keuangan</p>
                                    <span>Rekap pemasukan & pengeluaran</span>
                                </div>
                            </a>
                            <?php if ($user['role'] == 'admin' || $user['role'] == 'manajer'): ?>
                            <a href="laporan.php" class="quick-card">
                                <span class="quick-icon gradient-pink">📈</span>
                                <div>
                                    <p>Laporan</p>
                                    <span>Review performa bisnis</span>
                                </div>
                            </a>
                            <?php endif; ?>
                        </div>
                    </section>
                </div>
            </main>
        </div>
    </div>

    <script src="assets/js/main.js"></script>
    <script>
        // Sidebar toggle for mobile
        document.getElementById('sidebarToggle')?.addEventListener('click', function() {
            document.querySelector('.dashboard-sidebar').classList.toggle('active');
        });
    </script>
</body>
</html>

