<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk / Daftar - IMIX</title>
    <!-- CSS Files -->
    <link rel="stylesheet" href="styles/global.css">
    <link rel="stylesheet" href="styles/components.css">
    <link rel="stylesheet" href="styles/layout.css">
    <link rel="stylesheet" href="styles/login.css">
    <script src="js/login.js"></script>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    @vite([
      'resources/css/global.css',
      'resources/css/components.css',
      'resources/css/layout.css',
      'resources/css/login.css',
      'resources/js/login.js'])
</head>
<body class="login-background min-h-screen">

    <!-- Login Content -->
    <main class="flex items-center justify-center min-h-[calc(100vh-80px)] px-4 py-8">
        <div class="login-container w-full max-w-md">
            
            <div class="login-header">
                <h1 class="login-title cursor-pointer" id="loginLogo">
                    IMIX<span class="text-green-500">.ID</span>
                </h1>
                <p class="login-subtitle">Portal Film Indonesia #1</p>
            </div>

            <div class="login-form-container">
                <!-- Login Form -->
                <div id="login-box" class="login-fade-in">
                    <h2 class="login-form-title">Silakan Masuk</h2>
                    
                    <form id="loginForm" class="login-form">
                        <div class="login-form-group">
                            <label class="login-label">Email</label>
                            <input type="email" 
                                   id="loginEmail"
                                   class="login-input" 
                                   placeholder="email@kamu.com"
                                   required>
                        </div>
                        <div class="login-form-group">
                            <label class="login-label">Password</label>
                            <input type="password" 
                                   id="loginPassword"
                                   class="login-input" 
                                   placeholder="••••••••"
                                   required>
                        </div>
                        <button type="submit" class="login-submit-btn">
                            MASUK SEKARANG
                        </button>
                    </form>

                    <div class="login-switch-container">
                        <p class="login-switch-text">Belum punya akun?</p>
                        <button id="switchToRegister" class="login-switch-btn">
                            Daftar Member Baru
                        </button>
                    </div>
                </div>

                <!-- Register Form (hidden by default) -->
                <div id="register-box" class="login-hidden-form" style="display: none;">
                    <h2 class="login-form-title">Buat Akun Baru</h2>
                    
                    <form id="registerForm" class="login-form">
                        <div class="login-form-group">
                            <label class="login-label">Nama Lengkap</label>
                            <input type="text" 
                                   id="registerName"
                                   class="login-input" 
                                   placeholder="Nama Kamu"
                                   required>
                        </div>
                        <div class="login-form-group">
                            <label class="login-label">Email</label>
                            <input type="email" 
                                   id="registerEmail"
                                   class="login-input" 
                                   placeholder="email@kamu.com"
                                   required>
                        </div>
                        <div class="login-form-group">
                            <label class="login-label">Password</label>
                            <input type="password" 
                                   id="registerPassword"
                                   class="login-input" 
                                   placeholder="Buat password"
                                   required>
                        </div>
                        <div class="login-form-group">
                            <label class="login-label">Konfirmasi Password</label>
                            <input type="password" 
                                   id="registerConfirmPassword"
                                   class="login-input" 
                                   placeholder="Ulangi password"
                                   required>
                        </div>
                        <button type="submit" class="login-submit-btn bg-white hover:bg-gray-200 text-black">
                            DAFTAR AKUN
                        </button>
                    </form>

                    <div class="login-switch-container">
                        <p class="login-switch-text">Sudah punya akun?</p>
                        <button id="switchToLogin" class="login-switch-btn text-green-500 hover:text-white">
                            Login Disini
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>

</body>
</html>