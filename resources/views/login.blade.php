<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk / Daftar - IMIX</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: sans-serif; }
        .hidden-form { display: none; }
        .fade-in { animation: fadeIn 0.4s ease-in-out; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen bg-[url('https://assets.nflxext.com/ffe/siteui/vlv3/f841d4c7-10e1-40af-bcae-07a3f8dc141a/f6d7434e-d6de-4185-a6d4-c77a2d08737b/ID-en-20220502-popsignuptwoweeks-perspective_alpha_website_medium.jpg')] bg-cover bg-center relative">

    <div class="absolute inset-0 bg-black/90"></div>

    <div class="relative z-10 w-full max-w-md p-8 bg-gray-900/95 backdrop-blur-sm border border-green-900 rounded-2xl shadow-[0_0_50px_rgba(22,163,74,0.15)]">
        
        <div class="text-center mb-6">
            <h1 class="text-4xl font-black text-white tracking-tighter cursor-pointer" onclick="window.location='/'">
                IMIX<span class="text-green-500">.ID</span>
            </h1>
            <p class="text-gray-400 text-sm mt-2">Portal Film Indonesia #1</p>
        </div>

        <div id="login-box" class="fade-in">
            <h2 class="text-xl font-bold text-white mb-4 border-l-4 border-green-500 pl-3">Silakan Masuk</h2>
            
            <form>
                <div class="mb-4">
                    <label class="block text-green-500 text-xs font-bold mb-1 uppercase">Email</label>
                    <input type="email" class="w-full bg-black border border-gray-700 text-white rounded-lg p-3 focus:outline-none focus:border-green-500 focus:ring-1 focus:ring-green-500 transition" placeholder="email@kamu.com">
                </div>
                <div class="mb-6">
                    <label class="block text-green-500 text-xs font-bold mb-1 uppercase">Password</label>
                    <input type="password" class="w-full bg-black border border-gray-700 text-white rounded-lg p-3 focus:outline-none focus:border-green-500 transition" placeholder="••••••••">
                </div>
                <button class="w-full bg-green-600 hover:bg-green-500 text-black font-bold py-3 rounded-lg transition transform active:scale-95 shadow-lg shadow-green-900/50">
                    MASUK SEKARANG
                </button>
            </form>

            <div class="mt-6 text-center pt-4 border-t border-gray-800">
                <p class="text-gray-500 text-sm">Belum punya akun?</p>
                <button onclick="switchMode('register')" class="text-white font-bold hover:text-green-400 transition mt-1 underline decoration-green-500">
                    Daftar Member Baru
                </button>
            </div>
        </div>

        <div id="register-box" class="hidden-form fade-in">
            <h2 class="text-xl font-bold text-white mb-4 border-l-4 border-green-500 pl-3">Buat Akun Baru</h2>
            
            <form>
                <div class="mb-3">
                    <label class="block text-green-500 text-xs font-bold mb-1 uppercase">Nama Lengkap</label>
                    <input type="text" class="w-full bg-black border border-gray-700 text-white rounded-lg p-3 focus:outline-none focus:border-green-500 transition" placeholder="Nama Kamu">
                </div>
                <div class="mb-3">
                    <label class="block text-green-500 text-xs font-bold mb-1 uppercase">Email</label>
                    <input type="email" class="w-full bg-black border border-gray-700 text-white rounded-lg p-3 focus:outline-none focus:border-green-500 transition" placeholder="email@kamu.com">
                </div>
                <div class="mb-3">
                    <label class="block text-green-500 text-xs font-bold mb-1 uppercase">Password</label>
                    <input type="password" class="w-full bg-black border border-gray-700 text-white rounded-lg p-3 focus:outline-none focus:border-green-500 transition" placeholder="Buat password">
                </div>
                <div class="mb-6">
                    <label class="block text-green-500 text-xs font-bold mb-1 uppercase">Konfirmasi Password</label>
                    <input type="password" class="w-full bg-black border border-gray-700 text-white rounded-lg p-3 focus:outline-none focus:border-green-500 transition" placeholder="Ulangi password">
                </div>
                <button class="w-full bg-white hover:bg-gray-200 text-black font-bold py-3 rounded-lg transition transform active:scale-95">
                    DAFTAR AKUN
                </button>
            </form>

            <div class="mt-6 text-center pt-4 border-t border-gray-800">
                <p class="text-gray-500 text-sm">Sudah punya akun?</p>
                <button onclick="switchMode('login')" class="text-green-500 font-bold hover:text-white transition mt-1 underline decoration-white">
                    Login Disini
                </button>
            </div>
        </div>

    </div>

    <script>
        function switchMode(mode) {
            const loginBox = document.getElementById('login-box');
            const registerBox = document.getElementById('register-box');

            if (mode === 'register') {
                loginBox.classList.add('hidden-form');
                registerBox.classList.remove('hidden-form');
            } else {
                registerBox.classList.add('hidden-form');
                loginBox.classList.remove('hidden-form');
            }
        }
    </script>

</body>
</html>