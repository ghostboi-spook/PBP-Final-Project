<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IMIX - Daftar</title>
    <!-- CSS Files -->
    <link rel="stylesheet" href="styles/global.css">
    <link rel="stylesheet" href="styles/components.css">
    <link rel="stylesheet" href="styles/layout.css">
    <link rel="stylesheet" href="styles/login.css">
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/global.css', 'resources/css/components.css', 'resources/css/layout.css', 'resources/css/login.css'])
</head>

<body class="login-background min-h-screen">

    <!-- Register Content -->
    <main class="flex items-center justify-center min-h-screen px-4 py-8">
        <div class="login-container w-full max-w-md">

            <div class="login-header">
                <h1 class="login-title cursor-pointer">
                    IMIX<span class="text-green-500">.ID</span>
                </h1>
                <p class="login-subtitle">Daftar Member Baru</p>
            </div>

            <div class="login-form-container">
                <!-- Register Form -->
                <div class="login-fade-in">
                    <h2 class="login-form-title">Buat Akun Baru</h2>

                    @if ($errors->any())
                        <div class="mb-4 p-3 bg-red-500/20 border border-red-500 rounded text-red-300 text-sm">
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                    <form action="{{ route('register') }}" method="POST" class="login-form">
                        @csrf

                        <div class="login-form-group">
                            <label class="login-label">Nama Lengkap</label>
                            <input type="text" name="name"
                                class="login-input @error('name') border-red-500 @enderror" placeholder="Nama Kamu"
                                value="{{ old('name') }}" required>
                            @error('name')
                                <span class="text-red-400 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="login-form-group">
                            <label class="login-label">Email</label>
                            <input type="email" name="email"
                                class="login-input @error('email') border-red-500 @enderror"
                                placeholder="email@kamu.com" value="{{ old('email') }}" required>
                            @error('email')
                                <span class="text-red-400 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="login-form-group">
                            <label class="login-label">Password</label>
                            <input type="password" name="password"
                                class="login-input @error('password') border-red-500 @enderror"
                                placeholder="Buat password (minimal 6 karakter)" required>
                            @error('password')
                                <span class="text-red-400 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="login-form-group">
                            <label class="login-label">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" class="login-input"
                                placeholder="Ulangi password" required>
                        </div>

                        <button type="submit" class="login-submit-btn">
                            DAFTAR AKUN
                        </button>
                    </form>

                    <div class="login-switch-container">
                        <p class="login-switch-text">Sudah punya akun?</p>
                        <a href="{{ route('login') }}"
                            class="login-switch-btn text-green-500 hover:text-white transition">
                            Login Disini
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>

</body>

</html>
