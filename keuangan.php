<?php
require_once 'config/database.php';
require_once 'config/auth.php';

// Require login
requireLogin();

$user = getCurrentUser();
$conn = getConnection();
$page_title = 'Keuangan';

// Get income data
$income = [];
$income_result = $conn->query("SELECT * FROM income ORDER BY income_date DESC LIMIT 10");
if ($income_result) {
    $income = $income_result->fetch_all(MYSQLI_ASSOC);
}

// Get expenses data
$expenses = [];
$expenses_result = $conn->query("SELECT * FROM expenses ORDER BY expense_date DESC LIMIT 10");
if ($expenses_result) {
    $expenses = $expenses_result->fetch_all(MYSQLI_ASSOC);
}

// Get totals
$total_income = $conn->query("SELECT COALESCE(SUM(amount), 0) as total FROM income")->fetch_assoc()['total'];
$total_expenses = $conn->query("SELECT COALESCE(SUM(amount), 0) as total FROM expenses")->fetch_assoc()['total'];
$balance = $total_income - $total_expenses;
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
                    <h2>Manajemen Keuangan</h2>
                    <div>
                        <a href="keuangan_pemasukan.php" class="btn btn-primary">💰 Catat Pemasukan</a>
                        <a href="keuangan_pengeluaran.php" class="btn btn-secondary">💸 Catat Pengeluaran</a>
                    </div>
                </div>

                <!-- Summary Cards -->
                <div class="stats-grid" style="margin-bottom: 2rem;">
                    <div class="stat-card">
                        <div class="stat-icon">📈</div>
                        <div class="stat-content">
                            <h3>Total Pemasukan</h3>
                            <p class="stat-value">Rp <?php echo number_format($total_income, 0, ',', '.'); ?></p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon">📉</div>
                        <div class="stat-content">
                            <h3>Total Pengeluaran</h3>
                            <p class="stat-value">Rp <?php echo number_format($total_expenses, 0, ',', '.'); ?></p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon">💰</div>
                        <div class="stat-content">
                            <h3>Saldo</h3>
                            <p class="stat-value" style="color: <?php echo $balance >= 0 ? 'var(--success-color)' : 'var(--danger-color)'; ?>;">
                                Rp <?php echo number_format($balance, 0, ',', '.'); ?>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="keuangan-grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
                    <!-- Pemasukan -->
                    <div class="dashboard-section">
                        <div class="section-header">
                            <h3>Pemasukan Terakhir</h3>
                            <a href="keuangan_pemasukan.php" class="btn btn-secondary btn-sm">Lihat Semua</a>
                        </div>
                        <div class="table-container">
                            <table class="data-table">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Sumber</th>
                                        <th>Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($income)): ?>
                                        <tr>
                                            <td colspan="3" class="text-center">Belum ada data pemasukan</td>
                                        </tr>
                                    <?php else: ?>
                                        <?php foreach ($income as $inc): ?>
                                            <tr>
                                                <td><?php echo date('d/m/Y', strtotime($inc['income_date'])); ?></td>
                                                <td><?php echo htmlspecialchars($inc['source']); ?></td>
                                                <td>Rp <?php echo number_format($inc['amount'], 0, ',', '.'); ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Pengeluaran -->
                    <div class="dashboard-section">
                        <div class="section-header">
                            <h3>Pengeluaran Terakhir</h3>
                            <a href="keuangan_pengeluaran.php" class="btn btn-secondary btn-sm">Lihat Semua</a>
                        </div>
                        <div class="table-container">
                            <table class="data-table">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Kategori</th>
                                        <th>Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($expenses)): ?>
                                        <tr>
                                            <td colspan="3" class="text-center">Belum ada data pengeluaran</td>
                                        </tr>
                                    <?php else: ?>
                                        <?php foreach ($expenses as $exp): ?>
                                            <tr>
                                                <td><?php echo date('d/m/Y', strtotime($exp['expense_date'])); ?></td>
                                                <td><?php echo htmlspecialchars($exp['category']); ?></td>
                                                <td>Rp <?php echo number_format($exp['amount'], 0, ',', '.'); ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
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

