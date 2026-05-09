/**
 * SamPHP Framework — Core JavaScript Utilities
 *
 * Provides: Toast notifications, Modal system, AJAX helpers,
 *           Form handling, Date/Currency formatting, UI helpers.
 */

const BASE_URL = document.querySelector('meta[name="base-url"]')?.content || '';

// =============================================
// Toast Notification System
// =============================================
function showToast(message, type = 'success') {
    const existing = document.querySelector('.toast');
    if (existing) existing.remove();

    const toast = document.createElement('div');
    toast.className = `toast toast-${type}`;
    const icons = { success: 'check-circle', error: 'alert-circle', warning: 'alert-triangle', info: 'info' };
    toast.innerHTML = `<i data-lucide="${icons[type] || 'info'}" style="width:18px;"></i><span>${message}</span>`;
    document.body.appendChild(toast);
    if (window.lucide) lucide.createIcons();
    setTimeout(() => toast.classList.add('show'), 10);
    setTimeout(() => { toast.classList.remove('show'); setTimeout(() => toast.remove(), 300); }, 3500);
}

// =============================================
// Modal System
// =============================================
function openModal(id) {
    const modal = document.getElementById(id);
    if (modal) { modal.classList.add('show'); document.body.style.overflow = 'hidden'; }
}
function closeModal(id) {
    const modal = document.getElementById(id);
    if (modal) { modal.classList.remove('show'); document.body.style.overflow = ''; }
}

// =============================================
// AJAX Helper
// =============================================
async function apiRequest(url, method = 'GET', data = null) {
    const options = {
        method,
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    };
    if (data && method === 'POST') {
        if (data instanceof FormData) {
            options.body = data;
        } else {
            options.headers['Content-Type'] = 'application/x-www-form-urlencoded';
            options.body = new URLSearchParams(data).toString();
        }
    }
    try {
        const response = await fetch(url, options);
        const result = await response.json();
        if (response.status === 401 && result.redirect) {
            window.location.href = result.redirect;
            return null;
        }
        return result;
    } catch (e) {
        showToast('Network error. Please try again.', 'error');
        return null;
    }
}

// =============================================
// Form Submit Helper
// =============================================
function handleFormSubmit(formId, url, successCallback) {
    const form = document.getElementById(formId);
    if (!form) return;
    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        const btn = form.querySelector('button[type="submit"]');
        const originalText = btn?.innerHTML;
        if (btn) { btn.disabled = true; btn.innerHTML = '<span class="spinner"></span> Saving...'; }

        const formData = new FormData(form);
        const result = await apiRequest(url, 'POST', formData);

        if (btn) { btn.disabled = false; btn.innerHTML = originalText; }

        if (result?.status === 'success') {
            showToast(result.message || 'Success!', 'success');
            if (successCallback) successCallback(result);
        } else if (result) {
            showToast(result.message || 'Something went wrong', 'error');
        }
    });
}

// =============================================
// Delete Confirmation Helper
// =============================================
async function confirmDelete(url, itemName, callback) {
    if (confirm(`Are you sure you want to delete "${itemName}"? This action cannot be undone.`)) {
        const result = await apiRequest(url, 'POST');
        if (result?.status === 'success') {
            showToast(result.message || 'Deleted!', 'success');
            if (callback) callback();
        } else if (result) {
            showToast(result.message || 'Failed to delete', 'error');
        }
    }
}

// =============================================
// Formatting Utilities
// =============================================

/**
 * Format a number as currency.
 * Override the locale and currency symbol for your region.
 */
function formatCurrency(amount, locale = 'en-US', currency = 'USD') {
    return new Intl.NumberFormat(locale, {
        style: 'currency',
        currency: currency,
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    }).format(parseFloat(amount));
}

function formatDate(dateStr) {
    if (!dateStr) return '-';
    const d = new Date(dateStr);
    return d.toLocaleDateString('en-US', { day: '2-digit', month: 'short', year: 'numeric' });
}

function timeAgo(dateStr) {
    const now = new Date();
    const d = new Date(dateStr);
    const diff = Math.floor((now - d) / 1000);
    if (diff < 60) return 'Just now';
    if (diff < 3600) return Math.floor(diff / 60) + 'm ago';
    if (diff < 86400) return Math.floor(diff / 3600) + 'h ago';
    return Math.floor(diff / 86400) + 'd ago';
}

// =============================================
// DOM Ready — Core Initialization
// =============================================
document.addEventListener('DOMContentLoaded', () => {
    // Sidebar Toggle
    const sidebarToggle = document.getElementById('sidebar-toggle');
    const appContainer = document.querySelector('.app-container');
    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', () => appContainer.classList.toggle('sidebar-open'));
    }

    // Close modals on overlay click
    document.querySelectorAll('.modal-overlay').forEach(overlay => {
        overlay.addEventListener('click', (e) => {
            if (e.target === overlay) overlay.classList.remove('show');
            document.body.style.overflow = '';
        });
    });

    // Dropdowns
    document.querySelectorAll('.dropdown-trigger').forEach(trigger => {
        trigger.addEventListener('click', (e) => {
            e.stopPropagation();
            const menu = trigger.querySelector('.dropdown-menu');
            if (menu) menu.classList.toggle('show');
        });
    });
    window.addEventListener('click', () => {
        document.querySelectorAll('.dropdown-menu').forEach(m => m.classList.remove('show'));
    });

    // Initialize Lucide Icons
    if (window.lucide) lucide.createIcons();
});
