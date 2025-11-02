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
</head>
<body class="dashboard-body">
    <div class="dashboard-wrapper">
        <?php include 'includes/dashboard_sidebar.php'; ?>
        
        <div class="dashboard-main">
            <?php include 'includes/dashboard_header.php'; ?>
            
            <main class="dashboard-content">
                <div class="page-header">
                    <h2>Data Penjualan</h2>
                    <a href="penjualan_tambah.php" class="btn btn-primary">➕ Penjualan Baru</a>
                </div>

                <div class="dashboard-section">
                    <div class="table-container">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>No. Invoice</th>
                                    <th>Tanggal</th>
                                    <th>Pelanggan</th>
                                    <th>Total</th>
                                    <th>Metode Pembayaran</th>
                                    <th>Status</th>
                                    <th>Kasir</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($sales)): ?>
                                    <tr>
                                        <td colspan="8" class="text-center">Belum ada data penjualan</td>
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

