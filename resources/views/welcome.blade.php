<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>IMIX</title>

  <script src="https://cdn.tailwindcss.com"></script>

  <style>
    .glass {
      background: linear-gradient(180deg, rgba(0,0,0,0.35), rgba(0,0,0,0.65));
      backdrop-filter: blur(4px);
    }
    .play-btn::before {
      content: '';
      display: inline-block;
      vertical-align: middle;
      margin-left: 4px;
    }
    .top10-badge {
      background: linear-gradient(135deg, #f59e0b, #d97706);
      color: white;
      font-weight: bold;
      border-radius: 50%;
      width: 30px;
      height: 30px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 0.8rem;
    }
  </style>
</head>

<body class="bg-black text-white antialiased">

  <header class="bg-[#0f0f0f] border-b border-neutral-800 sticky top-0 z-10">
    <div class="max-w-7xl mx-auto px-6 py-3 flex items-center gap-6">
      
      <div class="flex items-center gap-4">
        <div class="bg-green-400 text-black font-bold px-3 py-1 rounded">IMIX</div>
        <button class="md:hidden p-2 text-white">☰</button>
      </div>

      <div class="flex-1">
        <div class="max-w-xl mx-auto">
          <input 
            placeholder="Search"
            class="w-full rounded-md px-4 py-2 bg-neutral-900 border border-neutral-800 focus:border-green-400 focus:outline-none"
          />
        </div>
      </div>

      <div class="hidden md:flex items-center gap-4 text-sm text-neutral-300">
        <a class="hover:text-green-400 cursor-pointer">Profile</a>
        <a class="hover:text-green-400 cursor-pointer">Watchlist</a>
      </div>

    </div>
  </header>

  <main class="max-w-7xl mx-auto px-6 py-8">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-12">
      <div class="lg:col-span-2 rounded-lg overflow-hidden">
        <img 
          src="{{ asset('storage/pengabdi.jpg') }}" 
          alt="pengabdi" 
          class="w-full h-full object-cover max-h-[500px]"
        >
      </div>

      <div class="lg:col-span-1">
        <h2 class="text-green-400 text-xl font-bold mb-6">Lainnya</h2>

        <div class="space-y-4">
          
          <div class="flex gap-4 items-center bg-neutral-900 p-4 rounded-lg border border-neutral-800 hover:bg-neutral-800 transition cursor-pointer">
            <div class="w-20 h-28 rounded overflow-hidden flex-none">
              <img src="" alt="thumb" class="w-full h-full object-cover" />
            </div>
            <div class="flex-1 text-center">
              <h3 class="font-semibold">The Hunger Games: Sunrise on the Reaping</h3>
            </div>
          </div>

          <div class="flex gap-4 items-center bg-neutral-900 p-4 rounded-lg border border-neutral-800 hover:bg-neutral-800 transition cursor-pointer">
            <div class="w-20 h-28 rounded overflow-hidden flex-none">
              <img src="" alt="thumb" class="w-full h-full object-cover" />
            </div>
            <div class="flex-1 text-center">
              <h3 class="font-semibold">Wicked Hidden Gems</h3>
            </div>
          </div>

          <div class="flex gap-4 items-center bg-neutral-900 p-4 rounded-lg border border-neutral-800 hover:bg-neutral-800 transition cursor-pointer">
            <div class="w-20 h-28 rounded overflow-hidden flex-none">
              <img src="https://via.placeholder.com/80x112/1f2937/ffffff?text=ST" alt="thumb" class="w-full h-full object-cover" />
            </div>
            <div class="flex-1 text-center">
              <h3 class="font-semibold">Stranger Things Cast Q&A</h3>
            </div>
          </div>

        </div>
      </div>
    </div>

    <div class="mb-12">
      <h2 class="text-2xl font-bold mb-6 text-green-400 text-center">Top 10 Film Indonesia</h2>
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
        <div class="bg-neutral-900 rounded-lg overflow-hidden border border-neutral-800 hover:border-green-400 transition group cursor-pointer">
          <div class="h-48 bg-neutral-800 relative">
            <div class="w-full h-full bg-gradient-to-br from-amber-500 to-amber-700 flex items-center justify-center">
              <span class="text-white font-bold text-center px-2">PENGABDI SETAN</span>
            </div>
          </div>
          <div class="p-4 text-center">
            <h3 class="font-semibold mb-1">Pengabdi Setan</h3>
            <p class="text-sm text-neutral-400">2017 • Horor</p>
          </div>
        </div>
        
        <div class="bg-neutral-900 rounded-lg overflow-hidden border border-neutral-800 hover:border-green-400 transition group cursor-pointer">
          <div class="h-48 bg-neutral-800 relative">
            <div class="w-full h-full bg-gradient-to-br from-amber-500 to-amber-700 flex items-center justify-center">
              <span class="text-white font-bold text-center px-2">DILAN 1990</span>
            </div>
          </div>
          <div class="p-4 text-center">
            <h3 class="font-semibold mb-1">Dilan 1990</h3>
            <p class="text-sm text-neutral-400">2018 • Romantis</p>
          </div>
        </div>
        
        <div class="bg-neutral-900 rounded-lg overflow-hidden border border-neutral-800 hover:border-green-400 transition group cursor-pointer">
          <div class="h-48 bg-neutral-800 relative">
            <div class="w-full h-full bg-gradient-to-br from-amber-500 to-amber-700 flex items-center justify-center">
              <span class="text-white font-bold text-center px-2">LAYANGAN PUTUS</span>
            </div>
          </div>
          <div class="p-4 text-center">
            <h3 class="font-semibold mb-1">Layangan Putus</h3>
            <p class="text-sm text-neutral-400">2021 • Drama</p>
          </div>
        </div>
        
        <div class="bg-neutral-900 rounded-lg overflow-hidden border border-neutral-800 hover:border-green-400 transition group cursor-pointer">
          <div class="h-48 bg-neutral-800 relative">
            <div class="w-full h-full bg-gradient-to-br from-amber-500 to-amber-700 flex items-center justify-center">
              <span class="text-white font-bold text-center px-2">KKN DI DESA PENARI</span>
            </div>
          </div>
          <div class="p-4 text-center">
            <h3 class="font-semibold mb-1">KKN di Desa Penari</h3>
            <p class="text-sm text-neutral-400">2022 • Horor</p>
          </div>
        </div>
        
        <div class="bg-neutral-900 rounded-lg overflow-hidden border border-neutral-800 hover:border-green-400 transition group cursor-pointer">
          <div class="h-48 bg-neutral-800 relative">
            <div class="w-full h-full bg-gradient-to-br from-amber-500 to-amber-700 flex items-center justify-center">
              <span class="text-white font-bold text-center px-2">ADA APA DENGAN CINTA</span>
            </div>
          </div>
          <div class="p-4 text-center">
            <h3 class="font-semibold mb-1">Ada Apa Dengan Cinta</h3>
            <p class="text-sm text-neutral-400">2002 • Romantis</p>
          </div>
        </div>
        
        <div class="bg-neutral-900 rounded-lg overflow-hidden border border-neutral-800 hover:border-green-400 transition group cursor-pointer">
          <div class="h-48 bg-neutral-800 relative">
            <div class="w-full h-full bg-gradient-to-br from-amber-500 to-amber-700 flex items-center justify-center">
              <span class="text-white font-bold text-center px-2">LORO KIDUL</span>
            </div>
          </div>
          <div class="p-4 text-center">
            <h3 class="font-semibold mb-1">Kisah Tanah Jawa: Loro Kidul</h3>
            <p class="text-sm text-neutral-400">2024 • Horor</p>
          </div>
        </div>
 
        <div class="bg-neutral-900 rounded-lg overflow-hidden border border-neutral-800 hover:border-green-400 transition group cursor-pointer">
          <div class="h-48 bg-neutral-800 relative">
            <div class="w-full h-full bg-gradient-to-br from-amber-500 to-amber-700 flex items-center justify-center">
              <span class="text-white font-bold text-center px-2">MIRACLE IN CELL NO.7</span>
            </div>
          </div>
          <div class="p-4 text-center">
            <h3 class="font-semibold mb-1">Miracle in Cell No.7</h3>
            <p class="text-sm text-neutral-400">2022 • Drama</p>
          </div>
        </div>

        <div class="bg-neutral-900 rounded-lg overflow-hidden border border-neutral-800 hover:border-green-400 transition group cursor-pointer">
          <div class="h-48 bg-neutral-800 relative">
            <div class="w-full h-full bg-gradient-to-br from-amber-500 to-amber-700 flex items-center justify-center">
              <span class="text-white font-bold text-center px-2">MARIPOSA</span>
            </div>
          </div>
          <div class="p-4 text-center">
            <h3 class="font-semibold mb-1">Mariposa</h3>
            <p class="text-sm text-neutral-400">2020 • Romantis</p>
          </div>
        </div>

        <div class="bg-neutral-900 rounded-lg overflow-hidden border border-neutral-800 hover:border-green-400 transition group cursor-pointer">
          <div class="h-48 bg-neutral-800 relative">
            <div class="w-full h-full bg-gradient-to-br from-amber-500 to-amber-700 flex items-center justify-center">
              <span class="text-white font-bold text-center px-2">SEWU DINO</span>
            </div>
          </div>
          <div class="p-4 text-center">
            <h3 class="font-semibold mb-1">Sewu Dino</h3>
            <p class="text-sm text-neutral-400">2023 • Horor</p>
          </div>
        </div>

        <div class="bg-neutral-900 rounded-lg overflow-hidden border border-neutral-800 hover:border-green-400 transition group cursor-pointer">
          <div class="h-48 bg-neutral-800 relative">
            <div class="w-full h-full bg-gradient-to-br from-amber-500 to-amber-700 flex items-center justify-center">
              <span class="text-white font-bold text-center px-2">AYAT-AYAT CINTA</span>
            </div>
          </div>
          <div class="p-4 text-center">
            <h3 class="font-semibold mb-1">Ayat-Ayat Cinta</h3>
            <p class="text-sm text-neutral-400">2008 • Drama</p>
          </div>
        </div>
      </div>
    </div>

    <div class="mb-12">
      <h2 class="text-2xl font-bold mb-6 text-green-400 text-center">Feature Today</h2>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-neutral-900 rounded-lg overflow-hidden border border-neutral-800 hover:border-green-400 transition cursor-pointer">
          <div class="h-48 bg-gradient-to-br from-blue-500 to-purple-700 flex items-center justify-center">
            <span class="text-white font-bold text-xl">FILM TERBARU</span>
          </div>
          <div class="p-4 text-center">
            <h3 class="font-semibold mb-2">Dilan 1991</h3>
            <p class="text-sm text-neutral-400">Kisah cinta Dilan dan Milea berlanjut di tahun 1991</p>
          </div>
        </div>
        <div class="bg-neutral-900 rounded-lg overflow-hidden border border-neutral-800 hover:border-green-400 transition cursor-pointer">
          <div class="h-48 bg-gradient-to-br from-blue-500 to-purple-700 flex items-center justify-center">
            <span class="text-white font-bold text-xl">SERIES TERBARU</span>
          </div>
          <div class="p-4 text-center">
            <h3 class="font-semibold mb-2">Tira</h3>
            <p class="text-sm text-neutral-400">Serial drama keluarga yang penuh dengan intrik</p>
          </div>
        </div>
        <div class="bg-neutral-900 rounded-lg overflow-hidden border border-neutral-800 hover:border-green-400 transition cursor-pointer">
          <div class="h-48 bg-gradient-to-br from-blue-500 to-purple-700 flex items-center justify-center">
            <span class="text-white font-bold text-xl">ANIMASI TERBARU</span>
          </div>
          <div class="p-4 text-center">
            <h3 class="font-semibold mb-2">Adit Sopo Jarwo</h3>
            <p class="text-sm text-neutral-400">Petualangan seru Adit, Sopo dan Jarwo</p>
          </div>
        </div>
      </div>
    </div>

  </main>

</body>
</html>