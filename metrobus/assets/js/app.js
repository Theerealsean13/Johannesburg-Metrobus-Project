document.addEventListener('DOMContentLoaded', function() {
    const themeToggle = document.getElementById('theme-toggle');
if (themeToggle) {
    const savedTheme = localStorage.getItem('theme');
if (savedTheme === 'dark') {
    document.body.classList.add('dark-mode');
   }
    themeToggle.addEventListener('click', function() {
    document.body.classList.toggle('dark-mode');
    const isDark = document.body.classList.contains('dark-mode');
    localStorage.setItem('theme', isDark ? 'dark' : 'light');
  });
    }
  });
function showLoading(element) {
    element.innerHTML = '<div class="loading"></div>';
   }
function hideLoading(element, content) {
    element.innerHTML = content;
   }
function showAlert(message, type = 'info') {
    const alertDiv = document.createElement('div');
    alertDiv.className = `alert alert-${type}`;
    alertDiv.textContent = message;
    alertDiv.style.cssText = `
    position: fixed;
    top: 20px;
    right: 20px;
    padding: 1rem;
    background-color: ${type === 'success' ? '#28a745' : type === 'error' ? '#dc3545' : '#007bff'};
    color: white;
    border-radius: 4px;
    z-index: 10000;
    max-width: 300px;
    `;
    document.body.appendChild(alertDiv);
    setTimeout(() => {
    alertDiv.remove();
    }, 5000);
   }
function validateForm(form) {
    const inputs = form.querySelectorAll('input[required], select[required], textarea[required]');
    let isValid = true;
    inputs.forEach(input => {
if (!input.value.trim()) {
    input.style.borderColor = '#dc3545';
    isValid = false;
   } else {
    input.style.borderColor = '#28a745';
   }
    });
     return isValid;
   }
function ajaxRequest(url, method = 'GET', data = null) {
    return fetch(url, {
    method: method,
    headers: {
    'Content-Type': 'application/json', 
   },
    body: data ? JSON.stringify(data) : null,
    })
    .then(response => response.json())
    .catch(error => {
    console.error('AJAX Error:', error);
    throw error;
    });
   }
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
    e.preventDefault();
    const target = document.querySelector(this.getAttribute('href'));
if (target) {
    target.scrollIntoView({
    behavior: 'smooth'
   });
    }
   });
   });
document.addEventListener('DOMContentLoaded', function() {
    const mobileNav = document.getElementById('mobile-nav');
if (mobileNav) {
    mobileNav.querySelectorAll('a').forEach(link => {
    link.addEventListener('click', function() {
    mobileNav.classList.remove('active');
   });
    });
    }
    });
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
function setLocalStorage(key, value) {
    try {
    localStorage.setItem(key, JSON.stringify(value));
    } catch (e) {
    console.error('LocalStorage error:', e);
    }
   }
function getLocalStorage(key) {
    try {
    const item = localStorage.getItem(key);
    return item ? JSON.parse(item) : null;
    } catch (e) {
    console.error('LocalStorage error:', e);
    return null;
    }
   }
function showNotification(message, type = 'info') {
if ('Notification' in window && Notification.permission === 'granted') {
    new Notification('MetroBus', { body: message, icon: 'assets/icons/favicon.ico' });
    } else {
    showAlert(message, type);
    }
   }
if ('Notification' in window) {
    document.addEventListener('DOMContentLoaded', function() {
if (Notification.permission === 'default') {
    Notification.requestPermission();
   }
   });
}