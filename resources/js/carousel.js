/**
 * =====================================================
 * IMIX CAROUSEL CONTROLLER (UI SAFE)
 * =====================================================
 * - Tidak generate HTML
 * - Tidak hapus overlay / title / button
 * - Hanya mengatur active slide
 * =====================================================
 */

document.addEventListener("DOMContentLoaded", () => {
    initHeroCarousel();
});

function initHeroCarousel() {
    const wrapper = document.getElementById("carousel-wrapper");
    if (!wrapper) return;

    const items = wrapper.querySelectorAll(".carousel-item");
    const dots = wrapper.querySelectorAll(".carousel-dot");
    const nextBtn = document.getElementById("nextBtn");
    const prevBtn = document.getElementById("prevBtn");

    if (items.length <= 1) return;

    let currentIndex = 0;
    let interval = null;

    function showSlide(index) {
        items.forEach((item, i) => {
            item.classList.toggle("active", i === index);
        });

        dots.forEach((dot, i) => {
            dot.classList.toggle("active", i === index);
        });

        currentIndex = index;
    }

    function nextSlide() {
        showSlide((currentIndex + 1) % items.length);
    }

    function prevSlide() {
        showSlide((currentIndex - 1 + items.length) % items.length);
    }

    // Buttons
    if (nextBtn) {
        nextBtn.addEventListener("click", () => {
            nextSlide();
            resetAutoSlide();
        });
    }

    if (prevBtn) {
        prevBtn.addEventListener("click", () => {
            prevSlide();
            resetAutoSlide();
        });
    }

    // Dots
    dots.forEach((dot, index) => {
        dot.addEventListener("click", () => {
            showSlide(index);
            resetAutoSlide();
        });
    });

    function startAutoSlide() {
        stopAutoSlide();
        interval = setInterval(nextSlide, 5000);
    }

    function stopAutoSlide() {
        if (interval) clearInterval(interval);
    }

    function resetAutoSlide() {
        stopAutoSlide();
        startAutoSlide();
    }

    wrapper.addEventListener("mouseenter", stopAutoSlide);
    wrapper.addEventListener("mouseleave", startAutoSlide);

    startAutoSlide();
}
