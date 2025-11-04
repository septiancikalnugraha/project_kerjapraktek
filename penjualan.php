<?php
require_once 'config/database.php';
require_once 'config/auth.php';

// Require login
requireLogin();

$user = getCurrentUser();
$conn = getConnection();
$page_title = 'Penjualan';

// Get sales data
$sales = [];
$result = $conn->query("SELECT s.*, c.name as customer_name, u.full_name as seller_name 
                        FROM sales s 
                        LEFT JOIN customers c ON s.customer_id = c.id 
                        LEFT JOIN users u ON s.user_id = u.id 
                        ORDER BY s.sale_date DESC");
if ($result) {
    $sales = $result->fetch_all(MYSQLI_ASSOC);
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
                    <section class="page-header-card glass-card">
                        <div>
                            <p class="welcome-subtitle">Kelola transaksi</p>
                            <h2 class="welcome-title">Data Penjualan</h2>
                            <p class="welcome-text">Pantau setiap transaksi yang masuk, status pembayaran, dan performa kasir dalam satu halaman.</p>
                        </div>
                        <div class="header-actions">
                            <a href="penjualan_tambah.php" class="btn btn-primary">➕ Penjualan Baru</a>
                        </div>
                    </section>

                    <section class="filter-bar">
                        <form class="filter-form">
                            <div class="filter-group">
                                <label for="filter-date">Rentang tanggal</label>
                                <input type="date" id="filter-date" name="start_date">
                                <span class="filter-separator">sampai</span>
                                <input type="date" name="end_date">
                            </div>
                            <div class="filter-group">
                                <label for="filter-status">Status</label>
                                <select id="filter-status" name="status">
                                    <option value="">Semua status</option>
                                    <option value="completed">Selesai</option>
                                    <option value="pending">Pending</option>
                                    <option value="cancelled">Batal</option>
                                </select>
                            </div>
                            <div class="filter-group">
                                <label for="filter-payment">Metode</label>
                                <select id="filter-payment" name="payment_method">
                                    <option value="">Semua metode</option>
                                    <option value="cash">Tunai</option>
                                    <option value="transfer">Transfer</option>
                                    <option value="credit">Kredit</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-secondary">Terapkan</button>
                        </form>
                    </section>

                    <section class="panel-card">
                        <div class="panel-heading">
                            <h3>Daftar Penjualan</h3>
                            <div class="panel-actions">
                                <button class="btn btn-light" type="button">⬇️ Ekspor</button>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="data-table">
                                    <thead>
                                        <tr>
                                            <th>No. Invoice</th>
                                            <th>Tanggal</th>
                                            <th>Pelanggan</th>
                                            <th>Total</th>
                                            <th>Metode</th>
                                            <th>Status</th>
                                            <th>Kasir</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (empty($sales)): ?>
                                            <tr>
                                                <td colspan="8">
                                                    <div class="empty-state">
                                                        <span class="empty-icon">🗒️</span>
                                                        <p>Belum ada data penjualan yang tercatat.</p>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php else: ?>
                                            <?php foreach ($sales as $sale): ?>
                                                <tr>
                                                    <td><?php echo htmlspecialchars($sale['invoice_number']); ?></td>
                                                    <td><?php echo date('d/m/Y H:i', strtotime($sale['sale_date'])); ?></td>
                                                    <td><?php echo htmlspecialchars($sale['customer_name'] ?? 'Pelanggan Umum'); ?></td>
                                                    <td>Rp <?php echo number_format($sale['total'], 0, ',', '.'); ?></td>
                                                    <td><?php echo ucfirst($sale['payment_method']); ?></td>
                                                    <td>
                                                        <span class="badge badge-<?php echo $sale['status'] == 'completed' ? 'success' : ($sale['status'] == 'pending' ? 'warning' : 'danger'); ?>">
                                                            <?php echo ucfirst($sale['status']); ?>
                                                        </span>
                                                    </td>
                                                    <td><?php echo htmlspecialchars($sale['seller_name']); ?></td>
                                                    <td>
                                                        <a href="penjualan_detail.php?id=<?php echo $sale['id']; ?>" class="btn btn-secondary btn-sm">Detail</a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </section>
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

