<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Tara Basro - IMIX</title>
  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  @vite([
      'resources/css/global.css',
      'resources/css/components.css',
      'resources/css/layout.css',
      'resources/js/common.js'])

  <style>
    /* Custom styles for actor page */
    body { font-family: 'Instrument Sans', sans-serif; }
    .glass {
      background: linear-gradient(180deg, rgba(0,0,0,0.35), rgba(0,0,0,0.65));
      backdrop-filter: blur(4px);
    }
  </style>
</head>

<body class="bg-black text-white antialiased flex flex-col min-h-screen">

  <!-- Header -->
  <header id="main-header"></header>

  <main class="flex-grow">
    <div class="max-w-7xl mx-auto px-6 py-12">
    <div class="flex flex-col md:flex-row gap-12">
        
        <!-- Sidebar / Photo -->
        <div class="w-full md:w-80 flex-none">
            <div class="rounded-xl overflow-hidden shadow-2xl border-2 border-neutral-800 mb-6">
                <!-- Menggunakan gambar lokal yang sudah digenerate -->
                <img src="{{ asset('storage/tara_basro.png') }}" alt="Tara Basro" class="w-full h-auto object-cover">
            </div>
            
            <h3 class="text-xl font-bold text-white mb-4">Informasi Pribadi</h3>
            
            <div class="space-y-4">
                <div>
                    <h4 class="text-sm font-bold text-neutral-400">Dikenal Sebagai</h4>
                    <p class="text-white">Aktris</p>
                </div>
                <div>
                    <h4 class="text-sm font-bold text-neutral-400">Jenis Kelamin</h4>
                    <p class="text-white">Perempuan</p>
                </div>
                <div>
                    <h4 class="text-sm font-bold text-neutral-400">Tanggal Lahir</h4>
                    <p class="text-white">11 Juni 1990 (34 tahun)</p>
                </div>
                <div>
                    <h4 class="text-sm font-bold text-neutral-400">Tempat Lahir</h4>
                    <p class="text-white">Jakarta, Indonesia</p>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1">
            <h1 class="text-5xl font-black text-white mb-6 tracking-tight">Tara Basro</h1>
            
            <div class="mb-10">
                <h3 class="text-green-400 font-bold mb-3 uppercase text-sm tracking-wider">Biografi</h3>
                <div class="text-neutral-300 leading-relaxed space-y-4">
                    <p>
                        Andi Mutiara Pertiwi Basro (lahir 11 Juni 1990), atau yang lebih dikenal sebagai Tara Basro, adalah seorang aktris dan model Indonesia. Ia dikenal luas berkat perannya dalam film <em>A Copy of My Mind</em> (2015), <em>Pengabdi Setan</em> (2017), dan <em>Perempuan Tanah Jahanam</em> (2019).
                    </p>
                    <p>
                        Ia memenangkan Piala Citra untuk Pemeran Utama Wanita Terbaik pada tahun 2015 atas penampilannya dalam film <em>A Copy of My Mind</em>. Ia sering berkolaborasi dengan sutradara Joko Anwar.
                    </p>
                </div>
            </div>

            <div>
                <h3 class="text-green-400 font-bold mb-6 uppercase text-sm tracking-wider">Known For</h3>
                
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
                    <!-- Movie Card 1 -->
                    <div class="bg-neutral-900 rounded-lg overflow-hidden border border-neutral-800 hover:border-green-400 transition group cursor-pointer">
                        <div class="aspect-[2/3] bg-neutral-800 relative">
                             <img src="{{ asset('storage/pengabdi.jpg') }}" alt="Pengabdi Setan" class="w-full h-full object-cover">
                        </div>
                        <div class="p-3">
                            <h4 class="font-bold text-white text-sm truncate group-hover:text-green-400 transition">Pengabdi Setan</h4>
                            <p class="text-xs text-neutral-500">Rini</p>
                        </div>
                    </div>

                    <!-- Movie Card 2 -->
                    <div class="bg-neutral-900 rounded-lg overflow-hidden border border-neutral-800 hover:border-green-400 transition group cursor-pointer">
                        <div class="aspect-[2/3] bg-neutral-800 relative">
                             <img src="{{ asset('storage/ptj.jpg') }}" alt="Perempuan Tanah Jahanam" class="w-full h-full object-cover">
                        </div>
                        <div class="p-3">
                            <h4 class="font-bold text-white text-sm truncate group-hover:text-green-400 transition">Perempuan Tanah Jahanam</h4>
                            <p class="text-xs text-neutral-500">Maya</p>
                        </div>
                    </div>

                    <!-- Movie Card 3 -->
                    <div class="bg-neutral-900 rounded-lg overflow-hidden border border-neutral-800 hover:border-green-400 transition group cursor-pointer">
                        <div class="aspect-[2/3] bg-neutral-800 relative">
                             <img src="{{ asset('storage/gundala.jpg') }}" alt="Gundala" class="w-full h-full object-cover">
                        </div>
                        <div class="p-3">
                            <h4 class="font-bold text-white text-sm truncate group-hover:text-green-400 transition">Gundala</h4>
                            <p class="text-xs text-neutral-500">Wulan / Merpati</p>
                        </div>
                    </div>

                    <!-- Movie Card 4 -->
                    <div class="bg-neutral-900 rounded-lg overflow-hidden border border-neutral-800 hover:border-green-400 transition group cursor-pointer">
                        <div class="aspect-[2/3] bg-neutral-800 relative">
                             <img src="{{ asset('storage/copyofmymind.jpg') }}" alt="A Copy of My Mind" class="w-full h-full object-cover">
                        </div>
                        <div class="p-3">
                            <h4 class="font-bold text-white text-sm truncate group-hover:text-green-400 transition">A Copy of My Mind</h4>
                            <p class="text-xs text-neutral-500">Sari</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
  </main>

  <!-- Footer -->
  <footer id="main-footer"></footer>

  <!-- Watchlist Alert Modal -->
  <div id="watchlist-alert-modal"></div>

  
</body>
</html>