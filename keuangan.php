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
                            <p class="welcome-subtitle">Ringkasan cashflow</p>
                            <h2 class="welcome-title">Manajemen Keuangan</h2>
                            <p class="welcome-text">Monitor pemasukan dan pengeluaran bisnis Anda, lalu catat transaksi baru secara cepat.</p>
                        </div>
                        <div class="header-actions">
                            <a href="keuangan_pemasukan.php" class="btn btn-primary">💰 Catat Pemasukan</a>
                            <a href="keuangan_pengeluaran.php" class="btn btn-secondary">💸 Catat Pengeluaran</a>
                        </div>
                    </section>

                    <section class="stat-grid">
                        <article class="stat-card">
                            <div class="stat-icon gradient-emerald">📈</div>
                            <div class="stat-detail">
                                <p class="stat-label">Total Pemasukan</p>
                                <h3 class="stat-value">Rp <?php echo number_format($total_income, 0, ',', '.'); ?></h3>
                                <span class="stat-caption">Akumulasi pemasukan tercatat</span>
                            </div>
                        </article>

                        <article class="stat-card">
                            <div class="stat-icon gradient-orange">📉</div>
                            <div class="stat-detail">
                                <p class="stat-label">Total Pengeluaran</p>
                                <h3 class="stat-value">Rp <?php echo number_format($total_expenses, 0, ',', '.'); ?></h3>
                                <span class="stat-caption">Pengeluaran operasional & lainnya</span>
                            </div>
                        </article>

                        <article class="stat-card">
                            <div class="stat-icon gradient-blue">💰</div>
                            <div class="stat-detail">
                                <p class="stat-label">Saldo</p>
                                <h3 class="stat-value" style="color: <?php echo $balance >= 0 ? 'var(--success-color)' : 'var(--danger-color)'; ?>;">
                                    Rp <?php echo number_format($balance, 0, ',', '.'); ?>
                                </h3>
                                <span class="stat-caption">Selisih pemasukan dan pengeluaran</span>
                            </div>
                        </article>
                    </section>

                    <section class="data-panels">
                        <div class="panel-card">
                            <div class="panel-heading">
                                <h3>Pemasukan Terbaru</h3>
                                <div class="panel-actions">
                                    <a href="keuangan_pemasukan.php" class="btn btn-secondary btn-sm">Lihat semua</a>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
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
                                                    <td colspan="3">
                                                        <div class="empty-state">
                                                            <span class="empty-icon">💵</span>
                                                            <p>Belum ada data pemasukan</p>
                                                        </div>
                                                    </td>
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
                        </div>

                        <div class="panel-card">
                            <div class="panel-heading">
                                <h3>Pengeluaran Terbaru</h3>
                                <div class="panel-actions">
                                    <a href="keuangan_pengeluaran.php" class="btn btn-secondary btn-sm">Lihat semua</a>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
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
                                                    <td colspan="3">
                                                        <div class="empty-state">
                                                            <span class="empty-icon">💸</span>
                                                            <p>Belum ada data pengeluaran</p>
                                                        </div>
                                                    </td>
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

