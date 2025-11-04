<?php
$user = getCurrentUser();
$page_title = $page_title ?? 'Dashboard';
?>
<header class="dashboard-header">
    <div class="header-content">
        <button class="sidebar-toggle" id="sidebarToggle" aria-label="Toggle sidebar">
            <span class="toggle-bar"></span>
            <span class="toggle-bar"></span>
            <span class="toggle-bar"></span>
        </button>

        <div class="page-heading">
            <p class="page-subtitle">Ringkasan hari ini</p>
            <h1 class="page-title"><?php echo htmlspecialchars($page_title); ?></h1>
        </div>

        <div class="header-actions">
            <div class="header-user">
                <span class="user-greeting">Halo,</span>
                <strong class="user-name"><?php echo htmlspecialchars($user['full_name']); ?></strong>
            </div>
        </div>
    </div>
</header>

