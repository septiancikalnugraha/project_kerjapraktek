<?php
require_once 'config/database.php';
require_once 'config/auth.php';

// Require login
requireLogin();

$user = getCurrentUser();
$conn = getConnection();
$page_title = 'Pelanggan';

// Get customers data
$customers = [];
$result = $conn->query("SELECT * FROM customers ORDER BY name ASC");
if ($result) {
    $customers = $result->fetch_all(MYSQLI_ASSOC);
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
                            <p class="welcome-subtitle">Manajemen relasi</p>
                            <h2 class="welcome-title">Data Pelanggan</h2>
                            <p class="welcome-text">Simpan informasi pelanggan dan hubungi mereka lebih cepat untuk meningkatkan loyalitas.</p>
                        </div>
                        <div class="header-actions">
                            <a href="pelanggan_tambah.php" class="btn btn-primary">➕ Tambah Pelanggan</a>
                        </div>
                    </section>

                    <section class="panel-card">
                        <div class="panel-heading">
                            <h3>Daftar Pelanggan</h3>
                            <div class="panel-actions">
                                <button type="button" class="btn btn-light">⬇️ Ekspor</button>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="data-table">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Telepon</th>
                                            <th>Alamat</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (empty($customers)): ?>
                                            <tr>
                                                <td colspan="5">
                                                    <div class="empty-state">
                                                        <span class="empty-icon">👥</span>
                                                        <p>Belum ada data pelanggan.</p>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php else: ?>
                                            <?php foreach ($customers as $customer): ?>
                                                <tr>
                                                    <td><?php echo htmlspecialchars($customer['name']); ?></td>
                                                    <td><?php echo htmlspecialchars($customer['email'] ?? '-'); ?></td>
                                                    <td><?php echo htmlspecialchars($customer['phone'] ?? '-'); ?></td>
                                                    <td><?php echo htmlspecialchars($customer['address'] ?? '-'); ?></td>
                                                    <td>
                                                        <a href="pelanggan_edit.php?id=<?php echo $customer['id']; ?>" class="btn btn-secondary btn-sm">Edit</a>
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

