<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>@yield('title', 'IMIX')</title>

  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body { font-family: 'Instrument Sans', sans-serif; }
    .glass {
      background: linear-gradient(180deg, rgba(0,0,0,0.35), rgba(0,0,0,0.65));
      backdrop-filter: blur(4px);
    }
  </style>
</head>

<body class="bg-black text-white antialiased flex flex-col min-h-screen">

  <header class="bg-[#0f0f0f] border-b border-neutral-800 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-6 py-3 flex items-center gap-6">
      
      <div class="flex items-center gap-4">
        <a href="/" class="bg-green-500 text-black font-black px-3 py-1 rounded text-lg tracking-tighter hover:bg-green-400 transition">IMIX</a>
        <button class="md:hidden p-2 text-white">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
        </button>
      </div>

      <div class="flex-1">
        <form action="/" method="GET" class="max-w-xl mx-auto relative flex items-center gap-2">
          <div class="relative w-full">
            <input 
              name="q"
              placeholder="Search movie, series, actor, sutradara..."
              class="w-full rounded-md px-4 py-2 pl-10 bg-neutral-900 border border-neutral-800 focus:border-green-500 focus:ring-1 focus:ring-green-500 focus:outline-none text-sm transition text-white"
            />
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 absolute left-3 top-3 text-neutral-500">
              <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
            </svg>
          </div>
          <button type="submit" class="bg-green-500 text-black font-bold px-4 py-2 rounded-md text-sm hover:bg-green-400 transition">
            Search
          </button>
        </form>
      </div>

      <div class="hidden md:flex items-center gap-6 text-sm font-medium text-neutral-300">
        <a href="#" class="hover:text-green-400 transition">Watchlist</a>
        <div class="relative group">
            <button class="flex items-center gap-2 hover:text-green-400 transition">
                Profile
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                </svg>
            </button>
        </div>
      </div>

    </div>
  </header>

  <main class="flex-grow">
    @yield('content')
  </main>

  <footer class="bg-[#0f0f0f] border-t border-neutral-800 py-12 mt-12">
    <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-4 gap-8">
        <div>
            <div class="bg-green-500 text-black font-black px-3 py-1 rounded w-fit text-lg tracking-tighter mb-4">IMIX</div>
            <p class="text-neutral-500 text-sm leading-relaxed">
                Platform katalog film & serial lokal. Temukan rekomendasi, simpan watchlist, dan ikuti update rilisan terbaru.
            </p>
            <div class="flex gap-6 mt-6">
                <!-- Twitter -->
                <a href="#" class="text-white hover:text-green-500 transition">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                    </svg>
                </a>
                <!-- Instagram -->
                <a href="#" class="text-white hover:text-green-500 transition">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772 4.902 4.902 0 011.772-1.153c.636-.247 1.363-.416 2.427-.465C9.673 2.013 10.03 2 12.48 2h-.165zm0 1.981h.166c-2.403 0-2.698.01-3.647.053-.86.04-1.326.185-1.638.307-.413.16-.708.35-.998.64-.29.29-.48.585-.64.998-.122.312-.267.778-.307 1.638-.043.949-.053 1.244-.053 3.647s.01 2.698.053 3.647c.04.86.185 1.326.307 1.638.16.413.35.708.64.998.29.29.585.48.998.64.312.122.778.267 1.638.307.949.043 1.244.053 3.647.053s2.698-.01 3.647-.053c.86-.04 1.326-.185 1.638-.307.413-.16.708-.35.998-.64.29-.29.48-.585.64-.998.122-.312.267-.778.307-1.638.043-.949.053-1.244.053-3.647s-.01-2.698-.053-3.647c-.04-.86-.185-1.326-.307-1.638-.16-.413-.35-.708-.64-.998-.29-.29-.585-.48-.998-.64-.312-.122-.778-.267-1.638-.307-.949-.043-1.244-.053-3.647-.053zM12.316 6.878a5.438 5.438 0 110 10.875 5.438 5.438 0 010-10.875zm0 1.982a3.456 3.456 0 100 6.911 3.456 3.456 0 000-6.911zm5.784-3.57a1.32 1.32 0 110 2.64 1.32 1.32 0 010-2.64z" clip-rule="evenodd" />
                    </svg>
                </a>
                <!-- Facebook -->
                <a href="#" class="text-white hover:text-green-500 transition">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
        </div>
        
        <div>
            <h4 class="font-bold text-white mb-4">Quick Links</h4>
            <ul class="space-y-2 text-sm text-neutral-400">
                <li><a href="#" class="hover:text-green-400 transition">Home</a></li>
                <li><a href="#" class="hover:text-green-400 transition">Browse</a></li>
                <li><a href="#" class="hover:text-green-400 transition">Top 10</a></li>
                <li><a href="#" class="hover:text-green-400 transition">New Releases</a></li>
            </ul>
        </div>

        <div>
            <h4 class="font-bold text-white mb-4">Support</h4>
            <ul class="space-y-2 text-sm text-neutral-400">
                <li><a href="#" class="hover:text-green-400 transition">Help Center</a></li>
                <li><a href="#" class="hover:text-green-400 transition">Privacy Policy</a></li>
                <li><a href="#" class="hover:text-green-400 transition">Terms of Service</a></li>
                <li><a href="#" class="hover:text-green-400 transition">Cookie Preferences</a></li>
            </ul>
        </div>

        <div>
            <h4 class="font-bold text-white mb-4">Contact Info</h4>
            <ul class="space-y-2 text-sm text-neutral-400">
                <li>Email: support@imix.com</li>
                <li>Phone: +62 123 4567 890</li>
            </ul>
        </div>
    </div>
    <div class="max-w-7xl mx-auto px-6 mt-12 pt-8 border-t border-neutral-800 flex flex-col md:flex-row justify-between items-center text-xs text-neutral-600">
        <p>&copy; 2025 IMIX. All rights reserved.</p>
        <p>Made with &hearts; for Indonesian Cinema</p>
    </div>
  </footer>

</body>
</html>
