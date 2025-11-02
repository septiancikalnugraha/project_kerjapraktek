<?php
$user = getCurrentUser();
$page_title = $page_title ?? 'Dashboard';
?>
<header class="dashboard-header">
    <div class="header-content">
        <div class="header-left">
            <button class="sidebar-toggle" id="sidebarToggle">
                <span>☰</span>
            </button>
            <h1 class="page-title"><?php echo htmlspecialchars($page_title); ?></h1>
        </div>
        <div class="header-right">
            <div class="header-user">
                <span>Halo, <strong><?php echo htmlspecialchars($user['full_name']); ?></strong></span>
            </div>
        </div>
    </div>
</header>

