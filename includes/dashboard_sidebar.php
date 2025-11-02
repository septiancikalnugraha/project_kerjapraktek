<?php
// Sidebar Navigation untuk Dashboard
$current_page = basename($_SERVER['PHP_SELF']);
$user = getCurrentUser();
?>
<aside class="dashboard-sidebar">
    <div class="sidebar-header">
        <div class="brand-logo">📦</div>
        <div class="sidebar-brand">
            <h2>PANCA INDRA</h2>
            <span>KEMASAN</span>
        </div>
    </div>
    
    <nav class="sidebar-nav">
        <ul class="nav-menu-list">
            <li>
                <a href="dashboard.php" class="nav-item <?php echo ($current_page == 'dashboard.php') ? 'active' : ''; ?>">
                    <span class="nav-icon">📊</span>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="penjualan.php" class="nav-item <?php echo ($current_page == 'penjualan.php') ? 'active' : ''; ?>">
                    <span class="nav-icon">💵</span>
                    <span class="nav-text">Penjualan</span>
                </a>
            </li>
            <li>
                <a href="produk.php" class="nav-item <?php echo ($current_page == 'produk.php') ? 'active' : ''; ?>">
                    <span class="nav-icon">📦</span>
                    <span class="nav-text">Produk</span>
                </a>
            </li>
            <li>
                <a href="pelanggan.php" class="nav-item <?php echo ($current_page == 'pelanggan.php') ? 'active' : ''; ?>">
                    <span class="nav-icon">👥</span>
                    <span class="nav-text">Pelanggan</span>
                </a>
            </li>
            <li>
                <a href="keuangan.php" class="nav-item <?php echo ($current_page == 'keuangan.php') ? 'active' : ''; ?>">
                    <span class="nav-icon">💰</span>
                    <span class="nav-text">Keuangan</span>
                </a>
            </li>
            <?php if ($user['role'] == 'admin' || $user['role'] == 'manajer'): ?>
            <li>
                <a href="laporan.php" class="nav-item <?php echo ($current_page == 'laporan.php') ? 'active' : ''; ?>">
                    <span class="nav-icon">📈</span>
                    <span class="nav-text">Laporan</span>
                </a>
            </li>
            <?php endif; ?>
        </ul>
    </nav>
    
    <div class="sidebar-footer">
        <div class="user-info">
            <div class="user-avatar">👤</div>
            <div class="user-details">
                <strong><?php echo htmlspecialchars($user['full_name']); ?></strong>
                <span><?php echo htmlspecialchars($user['role']); ?></span>
            </div>
        </div>
        <a href="logout.php" class="logout-btn">
            <span class="nav-icon">🚪</span>
            <span>Keluar</span>
        </a>
    </div>
</aside>

