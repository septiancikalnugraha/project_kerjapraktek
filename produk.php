<?php
require_once 'config/database.php';
require_once 'config/auth.php';

// Require login
requireLogin();

$user = getCurrentUser();
$conn = getConnection();
$page_title = 'Produk';

// Get products data
$products = [];
$result = $conn->query("SELECT p.*, c.name as category_name 
                        FROM products p 
                        LEFT JOIN categories c ON p.category_id = c.id 
                        ORDER BY p.name ASC");
if ($result) {
    $products = $result->fetch_all(MYSQLI_ASSOC);
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
                            <p class="welcome-subtitle">Inventori produk</p>
                            <h2 class="welcome-title">Daftar Produk</h2>
                            <p class="welcome-text">Kelola katalog produk, kategori, serta ketersediaan stok dengan cepat.</p>
                        </div>
                        <div class="header-actions">
                            <a href="produk_tambah.php" class="btn btn-primary">➕ Tambah Produk</a>
                        </div>
                    </section>

                    <section class="panel-card">
                        <div class="panel-heading">
                            <h3>Katalog Produk</h3>
                            <div class="panel-actions">
                                <button type="button" class="btn btn-light">⬇️ Ekspor</button>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="data-table">
                                    <thead>
                                        <tr>
                                            <th>Nama Produk</th>
                                            <th>Kategori</th>
                                            <th>Harga</th>
                                            <th>Stok</th>
                                            <th>Satuan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (empty($products)): ?>
                                            <tr>
                                                <td colspan="6">
                                                    <div class="empty-state">
                                                        <span class="empty-icon">📦</span>
                                                        <p>Belum ada produk yang terdaftar.</p>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php else: ?>
                                            <?php foreach ($products as $product): ?>
                                                <tr>
                                                    <td><?php echo htmlspecialchars($product['name']); ?></td>
                                                    <td><?php echo htmlspecialchars($product['category_name'] ?? '-'); ?></td>
                                                    <td>Rp <?php echo number_format($product['price'], 0, ',', '.'); ?></td>
                                                    <td>
                                                        <span class="badge badge-<?php echo $product['stock'] > 0 ? 'success' : 'danger'; ?>">
                                                            <?php echo number_format($product['stock'], 0, ',', '.'); ?>
                                                        </span>
                                                    </td>
                                                    <td><?php echo htmlspecialchars($product['unit']); ?></td>
                                                    <td>
                                                        <a href="produk_edit.php?id=<?php echo $product['id']; ?>" class="btn btn-secondary btn-sm">Edit</a>
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

