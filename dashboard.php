<?php
require_once 'config/database.php';
require_once 'config/auth.php';

// Require login
requireLogin();

$user = getCurrentUser();
$conn = getConnection();

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
    <title>Dashboard - Sistem Informasi Penjualan dan Keuangan</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <div class="nav-brand">
                <h1>PANCA INDRA KEMASAN</h1>
            </div>
            <div class="nav-menu">
                <a href="dashboard.php" class="nav-link active">Dashboard</a>
                <a href="#" class="nav-link">Penjualan</a>
                <a href="#" class="nav-link">Produk</a>
                <a href="#" class="nav-link">Keuangan</a>
                <?php if ($user['role'] == 'admin'): ?>
                    <a href="#" class="nav-link">Laporan</a>
                <?php endif; ?>
                <div class="nav-user">
                    <span>Halo, <?php echo htmlspecialchars($user['full_name']); ?></span>
                    <a href="logout.php" class="nav-link btn-danger">Keluar</a>
                </div>
            </div>
        </div>
    </nav>

    <main class="container">
        <div class="page-header">
            <h1>Dashboard</h1>
            <p>Selamat datang, <?php echo htmlspecialchars($user['full_name']); ?>!</p>
        </div>

        <!-- Statistics Cards -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon">💰</div>
                <div class="stat-content">
                    <h3>Penjualan Hari Ini</h3>
                    <p class="stat-value">Rp <?php echo number_format($today_sales, 0, ',', '.'); ?></p>
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">📊</div>
                <div class="stat-content">
                    <h3>Penjualan Bulan Ini</h3>
                    <p class="stat-value">Rp <?php echo number_format($month_sales, 0, ',', '.'); ?></p>
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">📈</div>
                <div class="stat-content">
                    <h3>Pemasukan Bulan Ini</h3>
                    <p class="stat-value">Rp <?php echo number_format($month_income, 0, ',', '.'); ?></p>
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">📉</div>
                <div class="stat-content">
                    <h3>Pengeluaran Bulan Ini</h3>
                    <p class="stat-value">Rp <?php echo number_format($month_expenses, 0, ',', '.'); ?></p>
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">📦</div>
                <div class="stat-content">
                    <h3>Total Produk</h3>
                    <p class="stat-value"><?php echo number_format($total_products, 0, ',', '.'); ?></p>
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">👥</div>
                <div class="stat-content">
                    <h3>Total Pelanggan</h3>
                    <p class="stat-value"><?php echo number_format($total_customers, 0, ',', '.'); ?></p>
                </div>
            </div>
        </div>

        <!-- Recent Sales -->
        <div class="dashboard-section">
            <div class="section-header">
                <h2>Penjualan Terakhir</h2>
                <a href="#" class="btn btn-secondary">Lihat Semua</a>
            </div>
            
            <div class="table-container">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>No. Invoice</th>
                            <th>Tanggal</th>
                            <th>Pelanggan</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Kasir</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($recent_sales)): ?>
                            <tr>
                                <td colspan="6" class="text-center">Belum ada data penjualan</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($recent_sales as $sale): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($sale['invoice_number']); ?></td>
                                    <td><?php echo date('d/m/Y H:i', strtotime($sale['sale_date'])); ?></td>
                                    <td><?php echo htmlspecialchars($sale['customer_name'] ?? 'Pelanggan Umum'); ?></td>
                                    <td>Rp <?php echo number_format($sale['total'], 0, ',', '.'); ?></td>
                                    <td>
                                        <span class="badge badge-<?php echo $sale['status'] == 'completed' ? 'success' : ($sale['status'] == 'pending' ? 'warning' : 'danger'); ?>">
                                            <?php echo ucfirst($sale['status']); ?>
                                        </span>
                                    </td>
                                    <td><?php echo htmlspecialchars($sale['seller_name']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="dashboard-section">
            <h2>Aksi Cepat</h2>
            <div class="quick-actions">
                <a href="#" class="action-btn">
                    <div class="action-icon">➕</div>
                    <span>Penjualan Baru</span>
                </a>
                <a href="#" class="action-btn">
                    <div class="action-icon">📦</div>
                    <span>Tambah Produk</span>
                </a>
                <a href="#" class="action-btn">
                    <div class="action-icon">👤</div>
                    <span>Tambah Pelanggan</span>
                </a>
                <a href="#" class="action-btn">
                    <div class="action-icon">💰</div>
                    <span>Catat Pemasukan</span>
                </a>
                <a href="#" class="action-btn">
                    <div class="action-icon">💸</div>
                    <span>Catat Pengeluaran</span>
                </a>
                <a href="#" class="action-btn">
                    <div class="action-icon">📊</div>
                    <span>Lihat Laporan</span>
                </a>
            </div>
        </div>
    </main>

    <footer class="footer">
        <div class="container">
            <p>&copy; <?php echo date('Y'); ?> CV. PANCA INDRA KEMASAN. All rights reserved.</p>
        </div>
    </footer>

    <script src="assets/js/main.js"></script>
</body>
</html>

