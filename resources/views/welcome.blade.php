<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>IMIX - Movie Platform</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    @vite([
      'resources/css/global.css',
      'resources/css/components.css',
      'resources/css/layout.css',
      'resources/css/carousel.css',
      'resources/js/common.js',
      'resources/js/carousel.js'])
</head>
<body class="bg-black text-white">
    <!-- Header -->
    <header id="main-header"></header>

    <main class="max-w-7xl mx-auto px-6 py-8">
        <!-- Hero Carousel -->
        <section id="hero-carousel" class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-12">
            <!-- Carousel content from 3.html -->
            <div class="lg:col-span-2 relative w-full h-[500px] rounded-lg overflow-hidden" id="carousel-wrapper">
                <!-- Carousel items will be loaded here -->
            </div>
            
            <!-- Sidebar Recommendations -->
            <div class="lg:col-span-1">
                <h2 class="text-green-400 text-xl font-bold mb-6">Lainnya</h2>
                <div id="recommendations" class="space-y-4">
                    <!-- Recommendations will be loaded here -->
                </div>
            </div>
        </section>

        <!-- Celebrities Carousel -->
        <section id="celebrities-carousel" class="mb-12">
            <!-- Celebrities content will be loaded here -->
        </section>

        <!-- Top 10 Movies -->
        <section id="top-movies" class="max-w-7xl mx-auto mt-10">
            <h2 class="text-2xl font-bold text-white mb-6">Top 10 Movies</h2>
            <div id="movies-grid" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
                <!-- Movies will be loaded here -->
            </div>
        </section>

        <!-- Featured Today -->
        <section id="featured-today" class="mb-12 mt-12">
            <!-- Featured content will be loaded here -->
        </section>
    </main>

    <!-- Footer -->
    <footer id="main-footer"></footer>

    <!-- Watchlist Alert Modal -->
    <div id="watchlist-alert-modal"></div>

</body>
</html>