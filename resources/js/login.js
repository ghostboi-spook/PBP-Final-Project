// ===== LOGIN PAGE FUNCTIONALITY =====

document.addEventListener('DOMContentLoaded', function() {
    // Initialize login functionality
    initializeLoginSwitcher();
    initializeFormSubmission();
    initializeLogoClick();
});

// ===== FORM SWITCHER =====

function initializeLoginSwitcher() {
    const loginBox = document.getElementById('login-box');
    const registerBox = document.getElementById('register-box');
    const switchToRegister = document.getElementById('switchToRegister');
    const switchToLogin = document.getElementById('switchToLogin');
    
    if (!loginBox || !registerBox) return;
    
    // Set initial state
    loginBox.style.display = 'block';
    registerBox.style.display = 'none';
    
    // Add event listeners to switch buttons
    if (switchToRegister) {
        switchToRegister.addEventListener('click', function(e) {
            e.preventDefault();
            switchMode('register');
        });
    }
    
    if (switchToLogin) {
        switchToLogin.addEventListener('click', function(e) {
            e.preventDefault();
            switchMode('login');
        });
    }
}

function switchMode(mode) {
    const loginBox = document.getElementById('login-box');
    const registerBox = document.getElementById('register-box');
    
    if (mode === 'register') {
        loginBox.style.display = 'none';
        registerBox.style.display = 'block';
        
        // Add fade-in animation
        registerBox.classList.remove('login-hidden-form');
        registerBox.classList.add('login-fade-in');
        
        // Remove fade-in from login
        loginBox.classList.remove('login-fade-in');
        loginBox.classList.add('login-hidden-form');
    } else {
        registerBox.style.display = 'none';
        loginBox.style.display = 'block';
        
        // Add fade-in animation
        loginBox.classList.remove('login-hidden-form');
        loginBox.classList.add('login-fade-in');
        
        // Remove fade-in from register
        registerBox.classList.remove('login-fade-in');
        registerBox.classList.add('login-hidden-form');
    }
}

// ===== FORM SUBMISSION =====

function initializeFormSubmission() {
    const loginForm = document.getElementById('loginForm');
    const registerForm = document.getElementById('registerForm');
    
    if (loginForm) {
        loginForm.addEventListener('submit', handleLoginSubmit);
    }
    
    if (registerForm) {
        registerForm.addEventListener('submit', handleRegisterSubmit);
    }
}

function handleLoginSubmit(e) {
    e.preventDefault();
    
    const form = e.target;
    const email = document.getElementById('loginEmail').value;
    const password = document.getElementById('loginPassword').value;
    
    // Basic validation
    if (!email || !password) {
        showLoginError('Harap isi semua kolom');
        return;
    }
    
    // Email validation
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        showLoginError('Harap masukkan email yang valid');
        return;
    }
    
    // Password validation
    if (password.length < 6) {
        showLoginError('Password minimal 6 karakter');
        return;
    }
    
    // Simulate login process
    simulateLogin(email);
}

function handleRegisterSubmit(e) {
    e.preventDefault();
    
    const form = e.target;
    const name = document.getElementById('registerName').value;
    const email = document.getElementById('registerEmail').value;
    const password = document.getElementById('registerPassword').value;
    const confirmPassword = document.getElementById('registerConfirmPassword').value;
    
    // Basic validation
    if (!name || !email || !password || !confirmPassword) {
        showRegisterError('Harap isi semua kolom');
        return;
    }
    
    // Email validation
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        showRegisterError('Harap masukkan email yang valid');
        return;
    }
    
    // Name validation
    if (name.length < 3) {
        showRegisterError('Nama minimal 3 karakter');
        return;
    }
    
    // Password validation
    if (password.length < 6) {
        showRegisterError('Password minimal 6 karakter');
        return;
    }
    
    // Confirm password
    if (password !== confirmPassword) {
        showRegisterError('Password tidak cocok');
        return;
    }
    
    // Simulate registration process
    simulateRegistration(name, email);
}

// ===== SIMULATION FUNCTIONS =====

function simulateLogin(email) {
    // Show loading state
    const submitBtn = document.querySelector('#loginForm button[type="submit"]');
    const originalText = submitBtn.textContent;
    submitBtn.textContent = 'Sedang masuk...';
    submitBtn.disabled = true;
    
    // Simulate API call
    setTimeout(() => {
        // Reset button
        submitBtn.textContent = originalText;
        submitBtn.disabled = false;
        
        // Show success message
        showLoginSuccess('Login berhasil! Mengalihkan...');
        
        // Redirect to homepage after 1.5 seconds
        setTimeout(() => {
            window.location.href = 'index.html';
        }, 1500);
    }, 1500);
}

function simulateRegistration(name, email) {
    // Show loading state
    const submitBtn = document.querySelector('#registerForm button[type="submit"]');
    const originalText = submitBtn.textContent;
    submitBtn.textContent = 'Membuat akun...';
    submitBtn.disabled = true;
    
    // Simulate API call
    setTimeout(() => {
        // Reset button
        submitBtn.textContent = originalText;
        submitBtn.disabled = false;
        
        // Show success message
        showRegisterSuccess(`Akun ${name} berhasil dibuat! Beralih ke login...`);
        
        // Switch to login form after 2 seconds
        setTimeout(() => {
            switchMode('login');
            
            // Pre-fill the email
            const loginEmailInput = document.getElementById('loginEmail');
            if (loginEmailInput) {
                loginEmailInput.value = email;
                loginEmailInput.focus();
            }
        }, 2000);
    }, 1500);
}

// ===== NOTIFICATION FUNCTIONS =====

function showLoginError(message) {
    showNotification(message, 'error', 'login-box');
}

function showRegisterError(message) {
    showNotification(message, 'error', 'register-box');
}

function showLoginSuccess(message) {
    showNotification(message, 'success', 'login-box');
}

function showRegisterSuccess(message) {
    showNotification(message, 'success', 'register-box');
}

function showNotification(message, type, containerId) {
    // Remove any existing notifications
    const existingNotification = document.querySelector(`#${containerId} .login-notification`);
    if (existingNotification) {
        existingNotification.remove();
    }
    
    // Create notification element
    const notification = document.createElement('div');
    notification.className = `login-notification p-3 mb-4 rounded-lg text-sm ${
        type === 'error' ? 'bg-red-900/30 text-red-300 border border-red-700/50' :
        'bg-green-900/30 text-green-300 border border-green-700/50'
    }`;
    notification.textContent = message;
    
    // Add to form
    const container = document.getElementById(containerId);
    if (container) {
        const form = container.querySelector('form');
        if (form) {
            form.insertBefore(notification, form.firstChild);
        }
    }
    
    // Auto-remove after 5 seconds
    setTimeout(() => {
        if (notification.parentNode) {
            notification.remove();
        }
    }, 5000);
}

// ===== LOGO CLICK =====

function initializeLogoClick() {
    const loginLogo = document.getElementById('loginLogo');
    if (loginLogo) {
        loginLogo.addEventListener('click', () => {
            window.location.href = 'index.html';
        });
    }
}

// ===== EXPORT FUNCTIONS =====

window.Login = {
    switchMode,
    simulateLogin,
    simulateRegistration,
    showLoginError,
    showRegisterError
};