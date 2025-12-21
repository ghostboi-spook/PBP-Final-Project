<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IMIX - Masuk / Daftar</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/global.css', 'resources/css/components.css', 'resources/css/layout.css', 'resources/css/login.css', 'resources/js/login.js'])
</head>

<body class="login-background min-h-screen">

    <main class="flex items-center justify-center min-h-[calc(100vh-80px)] px-4 py-8">
        <div class="login-container w-full max-w-md">

            <div class="login-header">
                <h1 class="login-title cursor-pointer" id="loginLogo">
                    IMIX<span class="text-green-500">.ID</span>
                </h1>
                <p class="login-subtitle">Portal Film Indonesia #1</p>
            </div>

            <div class="login-form-container">
                <div class="login-fade-in">
                    <h2 class="login-form-title">Silakan Masuk</h2>

                    @if ($errors->any())
                        <div class="mb-4 p-3 bg-red-500/20 border border-red-500 rounded text-red-300 text-sm">
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                    <form action="{{ route('login') }}" method="POST" class="login-form">
                        @csrf
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
                                class="login-input @error('password') border-red-500 @enderror" placeholder="••••••••"
                                required>
                            @error('password')
                                <span class="text-red-400 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="login-submit-btn">
                            MASUK SEKARANG
                        </button>
                    </form>

                    <div class="login-switch-container">
                        <p class="login-switch-text">Belum punya akun?</p>
                        <a href="{{ route('register') }}"
                            class="login-switch-btn text-green-500 hover:text-white transition">
                            Daftar Member Baru
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>

</body>

</html>
