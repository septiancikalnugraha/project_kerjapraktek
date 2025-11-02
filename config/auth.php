<?php
/**
 * Authentication Helper Functions
 */

session_start();

// Check if user is logged in
function isLoggedIn() {
    return isset($_SESSION['user_id']) && isset($_SESSION['username']);
}

// Check user role
function checkRole($requiredRole) {
    if (!isLoggedIn()) {
        header('Location: login.php');
        exit();
    }
    
    $allowedRoles = is_array($requiredRole) ? $requiredRole : [$requiredRole];
    
    if (!in_array($_SESSION['role'], $allowedRoles)) {
        header('Location: dashboard.php');
        exit();
    }
}

// Get current user data
function getCurrentUser() {
    if (!isLoggedIn()) {
        return null;
    }
    
    return [
        'id' => $_SESSION['user_id'],
        'username' => $_SESSION['username'],
        'full_name' => $_SESSION['full_name'],
        'role' => $_SESSION['role']
    ];
}

// Redirect if not logged in
function requireLogin() {
    if (!isLoggedIn()) {
        header('Location: login.php');
        exit();
    }
}

// Logout function
function logout() {
    session_unset();
    session_destroy();
    header('Location: login.php');
    exit();
}
?>

