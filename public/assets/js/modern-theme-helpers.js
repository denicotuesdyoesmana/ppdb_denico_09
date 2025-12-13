/**
 * Modern Theme Helper Functions
 * Utilities for interactive elements dan theme management
 */

// Theme Color Palette
const themeColors = {
    primary: '#06b6d4',
    primaryLight: '#22d3ee',
    primaryDark: '#0891b2',
    accent: '#ec4899',
    accentLight: '#f472b6',
    success: '#10b981',
    danger: '#ef4444',
    warning: '#f59e0b',
    info: '#0ea5e9',
    dark: '#0f172a',
    light: '#f8fafc',
    gray: '#64748b',
};

/**
 * Initialize modern theme animations
 */
function initializeModernTheme() {
    // Add fade-in animation to cards
    const cards = document.querySelectorAll('.card-modern, .stat-modern');
    cards.forEach((card, index) => {
        card.style.animationDelay = `${index * 0.1}s`;
    });

    // Add hover effects to interactive elements
    const hoverElements = document.querySelectorAll('.hover-lift, .hover-glow-cyan, .hover-glow-pink');
    hoverElements.forEach(element => {
        element.addEventListener('mouseenter', function() {
            this.style.transition = 'all 0.3s cubic-bezier(0.4, 0, 0.2, 1)';
        });
    });

    // Smooth scroll behavior
    document.documentElement.style.scrollBehavior = 'smooth';
}

/**
 * Create a modern notification toast
 * @param {string} message - Notification message
 * @param {string} type - 'success', 'danger', 'warning', 'info'
 * @param {number} duration - Display duration in ms (default: 3000)
 */
function showModernToast(message, type = 'info', duration = 3000) {
    const toastContainer = document.getElementById('toast-container') || createToastContainer();
    
    const toast = document.createElement('div');
    toast.className = `alert-modern alert-${type}-modern`;
    toast.style.marginBottom = '12px';
    toast.style.minWidth = '300px';
    
    const icon = getToastIcon(type);
    toast.innerHTML = `
        <i class="${icon}"></i>
        <div>${message}</div>
    `;
    
    toastContainer.appendChild(toast);
    
    // Auto remove after duration
    setTimeout(() => {
        toast.style.transition = 'opacity 0.3s ease';
        toast.style.opacity = '0';
        setTimeout(() => toast.remove(), 300);
    }, duration);
}

/**
 * Get appropriate icon for toast type
 */
function getToastIcon(type) {
    const icons = {
        success: 'fas fa-check-circle',
        danger: 'fas fa-exclamation-circle',
        warning: 'fas fa-exclamation-triangle',
        info: 'fas fa-info-circle'
    };
    return icons[type] || icons.info;
}

/**
 * Create toast container if doesn't exist
 */
function createToastContainer() {
    const container = document.createElement('div');
    container.id = 'toast-container';
    container.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 9999;
        max-width: 400px;
    `;
    document.body.appendChild(container);
    return container;
}

/**
 * Get contrasting text color based on background
 * @param {string} hexColor - Hex color code
 * @returns {string} 'white' or 'black'
 */
function getContrastColor(hexColor) {
    const r = parseInt(hexColor.substr(1, 2), 16);
    const g = parseInt(hexColor.substr(3, 2), 16);
    const b = parseInt(hexColor.substr(5, 2), 16);
    const brightness = (r * 299 + g * 587 + b * 114) / 1000;
    return brightness > 128 ? '#000000' : '#ffffff';
}

/**
 * Add ripple effect to buttons
 */
function addRippleEffect() {
    const buttons = document.querySelectorAll('.btn-modern, .btn-primary, .btn-modern-accent');
    
    buttons.forEach(button => {
        button.addEventListener('click', function(e) {
            const ripple = document.createElement('span');
            const rect = this.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            const x = e.clientX - rect.left - size / 2;
            const y = e.clientY - rect.top - size / 2;
            
            ripple.style.cssText = `
                position: absolute;
                width: ${size}px;
                height: ${size}px;
                border-radius: 50%;
                background: rgba(255, 255, 255, 0.6);
                transform: translate(${x}px, ${y}px);
                pointer-events: none;
                animation: ripple 0.6s ease-out;
            `;
            
            this.style.position = 'relative';
            this.style.overflow = 'hidden';
            this.appendChild(ripple);
            
            setTimeout(() => ripple.remove(), 600);
        });
    });
}

/**
 * Add ripple animation keyframes
 */
function addRippleAnimation() {
    if (document.getElementById('ripple-animation')) return;
    
    const style = document.createElement('style');
    style.id = 'ripple-animation';
    style.innerHTML = `
        @keyframes ripple {
            to {
                transform: translate(var(--x), var(--y)) scale(4);
                opacity: 0;
            }
        }
    `;
    document.head.appendChild(style);
}

/**
 * Initialize smooth scrolling for anchor links
 */
function initializeSmoothScroll() {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
}

/**
 * Add loading state to buttons
 * @param {HTMLElement} button - Button element
 * @param {boolean} loading - Is loading
 */
function setButtonLoading(button, loading = true) {
    if (loading) {
        button.disabled = true;
        button.innerHTML = '<i class="fas fa-spinner spinner-modern"></i> Loading...';
    } else {
        button.disabled = false;
        button.innerHTML = button.getAttribute('data-original-text') || 'Submit';
    }
}

/**
 * Initialize button loading states
 */
function initializeButtonLoading() {
    const buttons = document.querySelectorAll('button[type="submit"]');
    buttons.forEach(button => {
        button.setAttribute('data-original-text', button.innerHTML);
        
        button.closest('form')?.addEventListener('submit', function() {
            setButtonLoading(button, true);
        });
    });
}

/**
 * Format number dengan separator
 * @param {number} num - Number to format
 * @returns {string} Formatted number
 */
function formatNumber(num) {
    return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
}

/**
 * Format currency (Indonesian)
 * @param {number} amount - Amount to format
 * @returns {string} Formatted currency
 */
function formatCurrency(amount) {
    return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0
    }).format(amount);
}

/**
 * Create a modern modal
 * @param {string} title - Modal title
 * @param {string} content - Modal content
 * @param {Object} options - Additional options
 */
function showModernModal(title, content, options = {}) {
    const modal = document.createElement('div');
    modal.className = 'modal-modern modal fade';
    modal.innerHTML = `
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">${title}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    ${content}
                </div>
                ${options.footer ? `<div class="modal-footer">${options.footer}</div>` : ''}
            </div>
        </div>
    `;
    
    document.body.appendChild(modal);
    
    const bootstrapModal = new bootstrap.Modal(modal);
    bootstrapModal.show();
    
    modal.addEventListener('hidden.bs.modal', () => modal.remove());
    
    return bootstrapModal;
}

/**
 * Debounce function untuk optimisasi
 * @param {Function} func - Function to debounce
 * @param {number} wait - Wait time in ms
 */
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

/**
 * Throttle function
 * @param {Function} func - Function to throttle
 * @param {number} limit - Limit time in ms
 */
function throttle(func, limit) {
    let inThrottle;
    return function(...args) {
        if (!inThrottle) {
            func.apply(this, args);
            inThrottle = true;
            setTimeout(() => inThrottle = false, limit);
        }
    };
}

/**
 * Initialize all modern theme features
 */
function initAllModernFeatures() {
    initializeModernTheme();
    addRippleEffect();
    addRippleAnimation();
    initializeSmoothScroll();
    initializeButtonLoading();
}

/**
 * DOM Ready
 */
document.addEventListener('DOMContentLoaded', function() {
    initAllModernFeatures();
});

/**
 * Export for use in other modules
 */
if (typeof module !== 'undefined' && module.exports) {
    module.exports = {
        showModernToast,
        formatNumber,
        formatCurrency,
        showModernModal,
        debounce,
        throttle,
        themeColors
    };
}
