/**
 * Main JavaScript File
 * Sistem Informasi Penjualan dan Keuangan
 * CV. PANCA INDRA KEMASAN
 */

// Wait for DOM to be ready
document.addEventListener('DOMContentLoaded', function() {
    // Initialize form validation
    initFormValidation();
    
    // Initialize password confirmation validation
    initPasswordValidation();
    
    // Initialize smooth scrolling
    initSmoothScrolling();
    
    // Initialize mobile menu toggle (if needed)
    initMobileMenu();
    
    // Initialize home panels tab switching
    initHomePanels();
});

/**
 * Initialize form validation
 */
function initFormValidation() {
    const forms = document.querySelectorAll('form');
    
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            if (!form.checkValidity()) {
                e.preventDefault();
                e.stopPropagation();
            }
            
            form.classList.add('was-validated');
        });
    });
}

/**
 * Initialize password confirmation validation
 */
function initPasswordValidation() {
    const registerForm = document.getElementById('registerForm');
    
    if (registerForm) {
        const password = document.getElementById('password');
        const confirmPassword = document.getElementById('confirm_password');
        
        function validatePassword() {
            if (password.value !== confirmPassword.value) {
                confirmPassword.setCustomValidity('Password tidak cocok');
            } else {
                confirmPassword.setCustomValidity('');
            }
        }
        
        password.addEventListener('input', validatePassword);
        confirmPassword.addEventListener('input', validatePassword);
    }
}

/**
 * Initialize smooth scrolling for anchor links
 */
function initSmoothScrolling() {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            if (href !== '#' && href.length > 1) {
                const target = document.querySelector(href);
                if (target) {
                    e.preventDefault();
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            }
        });
    });
}

/**
 * Initialize mobile menu toggle
 */
function initMobileMenu() {
    // Add mobile menu functionality if needed
    const navMenu = document.querySelector('.nav-menu');
    if (navMenu && window.innerWidth <= 768) {
        // Mobile menu can be expanded here
    }
}

/**
 * Initialize home panels tab switching
 */
function initHomePanels() {
    const tabs = document.querySelectorAll('.nav-tab');
    const panels = document.querySelectorAll('.home-panel');
    
    tabs.forEach(tab => {
        tab.addEventListener('click', function() {
            const panelId = this.getAttribute('data-panel');
            switchPanel(panelId);
        });
    });
    
    // Handle URL hash for direct panel access
    const hash = window.location.hash;
    if (hash) {
        const panelName = hash.replace('#', '');
        switchPanel(panelName);
    }
}

/**
 * Switch to specific panel
 */
function switchPanel(panelName) {
    const tabs = document.querySelectorAll('.nav-tab');
    const panels = document.querySelectorAll('.home-panel');
    
    // Remove active class from all tabs and panels
    tabs.forEach(t => t.classList.remove('active'));
    panels.forEach(p => p.classList.remove('active'));
    
    // Add active class to clicked tab and corresponding panel
    const tab = document.querySelector(`[data-panel="${panelName}"]`);
    const targetPanel = document.getElementById(`panel-${panelName}`);
    
    if (tab && targetPanel) {
        tab.classList.add('active');
        targetPanel.classList.add('active');
        
        // Smooth scroll to panel if needed
        setTimeout(() => {
            targetPanel.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }, 100);
    }
}

/**
 * Format currency
 */
function formatCurrency(amount) {
    return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0
    }).format(amount);
}

/**
 * Format date
 */
function formatDate(dateString) {
    const date = new Date(dateString);
    return new Intl.DateTimeFormat('id-ID', {
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    }).format(date);
}

/**
 * Format datetime
 */
function formatDateTime(dateString) {
    const date = new Date(dateString);
    return new Intl.DateTimeFormat('id-ID', {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    }).format(date);
}

/**
 * Show alert message
 */
function showAlert(message, type = 'info') {
    const alertDiv = document.createElement('div');
    alertDiv.className = `alert alert-${type}`;
    alertDiv.textContent = message;
    
    const container = document.querySelector('.auth-card') || document.querySelector('.container');
    if (container) {
        container.insertBefore(alertDiv, container.firstChild);
        
        // Auto remove after 5 seconds
        setTimeout(() => {
            alertDiv.remove();
        }, 5000);
    }
}

/**
 * Confirm action
 */
function confirmAction(message) {
    return confirm(message);
}

// Export functions for use in other scripts
if (typeof module !== 'undefined' && module.exports) {
    module.exports = {
        formatCurrency,
        formatDate,
        formatDateTime,
        showAlert,
        confirmAction
    };
}

