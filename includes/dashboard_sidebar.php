<?php
// Sidebar Navigation untuk Dashboard
$current_page = basename($_SERVER['PHP_SELF']);
$user = getCurrentUser();
?>
<aside class="dashboard-sidebar" id="dashboardSidebar">
    <div class="sidebar-header">
        <div class="brand-badge">
            <span class="brand-icon">📦</span>
        </div>
        <div class="brand-text">
            <h2>Panca Indra</h2>
            <p>Kemasan</p>
        </div>
    </div>

    <nav class="sidebar-nav">
        <span class="nav-label">Menu utama</span>
        <ul class="nav-menu-list">
            <li>
                <a href="dashboard.php" class="nav-item <?php echo ($current_page == 'dashboard.php') ? 'active' : ''; ?>">
                    <span class="nav-icon">📊</span>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="penjualan.php" class="nav-item <?php echo ($current_page == 'penjualan.php') ? 'active' : ''; ?>">
                    <span class="nav-icon">💵</span>
                    <span>Penjualan</span>
                </a>
            </li>
            <li>
                <a href="produk.php" class="nav-item <?php echo ($current_page == 'produk.php') ? 'active' : ''; ?>">
                    <span class="nav-icon">📦</span>
                    <span>Produk</span>
                </a>
            </li>
            <li>
                <a href="pelanggan.php" class="nav-item <?php echo ($current_page == 'pelanggan.php') ? 'active' : ''; ?>">
                    <span class="nav-icon">👥</span>
                    <span>Pelanggan</span>
                </a>
            </li>
            <li>
                <a href="keuangan.php" class="nav-item <?php echo ($current_page == 'keuangan.php') ? 'active' : ''; ?>">
                    <span class="nav-icon">💰</span>
                    <span>Keuangan</span>
                </a>
            </li>
            <?php if ($user['role'] == 'admin' || $user['role'] == 'manajer'): ?>
            <li>
                <a href="laporan.php" class="nav-item <?php echo ($current_page == 'laporan.php') ? 'active' : ''; ?>">
                    <span class="nav-icon">📈</span>
                    <span>Laporan</span>
                </a>
            </li>
            <?php endif; ?>
        </ul>
    </nav>

    <div class="sidebar-footer">
        <div class="user-card">
            <div class="user-avatar">👤</div>
            <div>
                <p class="user-name"><?php echo htmlspecialchars($user['full_name']); ?></p>
                <span class="user-role"><?php echo ucfirst(htmlspecialchars($user['role'])); ?></span>
            </div>
        </div>
        <a href="logout.php" class="logout-btn">
            <span>Keluar</span>
            <span class="logout-icon">↗</span>
        </a>
    </div>
</aside>

