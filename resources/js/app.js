import "./bootstrap";

// Smooth scrolling for navigation links
document.addEventListener("DOMContentLoaded", function () {
    // Smooth scroll for anchor links
    const links = document.querySelectorAll('a[href^="#"]');

    links.forEach((link) => {
        link.addEventListener("click", function (e) {
            e.preventDefault();

            const targetId = this.getAttribute("href");
            const targetElement = document.querySelector(targetId);

            if (targetElement) {
                const navHeight = 64; // Height of fixed navbar
                const targetPosition = targetElement.offsetTop - navHeight;

                window.scrollTo({
                    top: targetPosition,
                    behavior: "smooth",
                });
            }
        });
    });

    // Navbar background change on scroll
    const navbar = document.querySelector("nav");

    window.addEventListener("scroll", function () {
        if (window.scrollY > 50) {
            navbar.classList.add("bg-white/95", "shadow-lg");
        } else {
            navbar.classList.remove("shadow-lg");
        }
    });

    // Animate elements on scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: "0px 0px -50px 0px",
    };

    const observer = new IntersectionObserver(function (entries) {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add("animate-fade-in");
            }
        });
    }, observerOptions);

    // Observe all feature cards and other elements
    const observeElements = document.querySelectorAll(".group, .grid > div");
    observeElements.forEach((el) => observer.observe(el));

    // Mobile menu toggle
    const mobileMenuButton = document.querySelector(".md\\:hidden button");
    const mobileMenu = document.createElement("div");
    mobileMenu.className =
        "md:hidden bg-white border-t border-gray-100 px-4 py-4 space-y-4 hidden";
    mobileMenu.innerHTML = `
        <a href="#home" class="block text-gray-700 hover:text-blue-600 transition-colors duration-200 font-medium">Home</a>
        <a href="#features" class="block text-gray-700 hover:text-blue-600 transition-colors duration-200 font-medium">Fitur</a>
        <a href="#about" class="block text-gray-700 hover:text-blue-600 transition-colors duration-200 font-medium">Tentang</a>
        <a href="#contact" class="block text-gray-700 hover:text-blue-600 transition-colors duration-200 font-medium">Kontak</a>
        <div class="pt-4 border-t border-gray-100">
            <a href="/login" class="block text-gray-700 hover:text-blue-600 transition-colors duration-200 font-medium mb-3">Masuk</a>
            <a href="/register" class="block bg-gradient-to-r from-blue-500 to-cyan-500 text-white px-6 py-2 rounded-lg hover:from-blue-600 hover:to-cyan-600 transition-all duration-200 font-medium text-center">Daftar</a>
        </div>
    `;

    if (mobileMenuButton && navbar) {
        navbar.appendChild(mobileMenu);

        mobileMenuButton.addEventListener("click", function () {
            mobileMenu.classList.toggle("hidden");

            // Change hamburger icon to X when menu is open
            const icon = this.querySelector("svg");
            if (mobileMenu.classList.contains("hidden")) {
                icon.innerHTML =
                    '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>';
            } else {
                icon.innerHTML =
                    '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>';
            }
        });

        // Close mobile menu when clicking on links
        mobileMenu.querySelectorAll('a[href^="#"]').forEach((link) => {
            link.addEventListener("click", function () {
                mobileMenu.classList.add("hidden");
                const icon = mobileMenuButton.querySelector("svg");
                icon.innerHTML =
                    '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>';
            });
        });
    }

    // Counter animation for stats
    function animateCounter(element, target, duration = 2000) {
        let start = 0;
        const increment = target / (duration / 16);

        function updateCounter() {
            start += increment;
            if (start < target) {
                element.textContent = Math.floor(start).toLocaleString();
                requestAnimationFrame(updateCounter);
            } else {
                element.textContent = target.toLocaleString();
            }
        }

        updateCounter();
    }

    // Animate counters when they come into view
    const statsObserver = new IntersectionObserver(function (entries) {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                const counterElements =
                    entry.target.querySelectorAll(".text-3xl");
                counterElements.forEach((counter) => {
                    const text = counter.textContent.trim();
                    if (text.includes("50K+")) {
                        counter.textContent = "0";
                        animateCounter(counter, 50000);
                        counter.innerHTML = counter.textContent + "+";
                    } else if (text.includes("15+")) {
                        counter.textContent = "0";
                        animateCounter(counter, 15);
                        counter.innerHTML = counter.textContent + "+";
                    } else if (text.includes("4.8★")) {
                        counter.textContent = "0.0★";
                        let start = 0;
                        const target = 4.8;
                        const increment = target / 120;

                        function updateRating() {
                            start += increment;
                            if (start < target) {
                                counter.textContent = start.toFixed(1) + "★";
                                requestAnimationFrame(updateRating);
                            } else {
                                counter.textContent = "4.8★";
                            }
                        }
                        updateRating();
                    }
                });
                statsObserver.unobserve(entry.target);
            }
        });
    });

    const statsSection = document.querySelector(".grid.grid-cols-2.gap-6");
    if (statsSection) {
        statsObserver.observe(statsSection.parentElement);
    }

    // Carousel functionality
    function initCarousel() {
        const carousel = document.getElementById("preview-carousel");
        const slides = document.querySelectorAll(".carousel-slide");
        const indicators = document.querySelectorAll(".carousel-indicator");

        if (!carousel || slides.length === 0) return;

        let currentSlide = 0;
        const totalSlides = slides.length;

        // Function to show specific slide
        function showSlide(index) {
            // Hide all slides
            slides.forEach((slide, i) => {
                slide.classList.remove("active");
                slide.style.opacity = "0";
            });

            // Update indicators
            indicators.forEach((indicator, i) => {
                indicator.classList.remove("active");
                if (i === index) {
                    indicator.classList.add("bg-blue-500");
                    indicator.classList.remove("bg-white/50");
                } else {
                    indicator.classList.remove("bg-blue-500");
                    indicator.classList.add("bg-white/50");
                }
            });

            // Show current slide with fade effect
            setTimeout(() => {
                slides[index].classList.add("active");
                slides[index].style.opacity = "1";
            }, 100);

            currentSlide = index;
        }

        // Next slide function
        function nextSlide() {
            const next = (currentSlide + 1) % totalSlides;
            showSlide(next);
        }

        // Previous slide function
        function prevSlide() {
            const prev = (currentSlide - 1 + totalSlides) % totalSlides;
            showSlide(prev);
        }

        // Event listeners for indicators
        indicators.forEach((indicator, index) => {
            indicator.addEventListener("click", () => {
                showSlide(index);
            });
        });

        // Auto-play carousel (optional)
        let autoPlayInterval;

        function startAutoPlay() {
            autoPlayInterval = setInterval(nextSlide, 4000); // Change slide every 4 seconds
        }

        function stopAutoPlay() {
            if (autoPlayInterval) {
                clearInterval(autoPlayInterval);
            }
        }

        // Start auto-play
        startAutoPlay();

        // Pause auto-play on hover
        carousel.addEventListener("mouseenter", stopAutoPlay);
        carousel.addEventListener("mouseleave", startAutoPlay);

        // Pause auto-play when user interacts with indicators
        indicators.forEach((element) => {
            if (element) {
                element.addEventListener("click", () => {
                    stopAutoPlay();
                    setTimeout(startAutoPlay, 5000); // Resume after 5 seconds
                });
            }
        });

        // Touch/swipe support for mobile
        let touchStartX = 0;
        let touchEndX = 0;

        carousel.addEventListener("touchstart", (e) => {
            touchStartX = e.changedTouches[0].screenX;
        });

        carousel.addEventListener("touchend", (e) => {
            touchEndX = e.changedTouches[0].screenX;
            handleSwipe();
        });

        function handleSwipe() {
            const swipeThreshold = 50;
            const swipeDistance = touchEndX - touchStartX;

            if (Math.abs(swipeDistance) > swipeThreshold) {
                if (swipeDistance > 0) {
                    prevSlide();
                } else {
                    nextSlide();
                }
                stopAutoPlay();
                setTimeout(startAutoPlay, 5000);
            }
        }

        // Keyboard navigation
        document.addEventListener("keydown", (e) => {
            if (carousel.matches(":hover")) {
                if (e.key === "ArrowLeft") {
                    prevSlide();
                    stopAutoPlay();
                    setTimeout(startAutoPlay, 5000);
                } else if (e.key === "ArrowRight") {
                    nextSlide();
                    stopAutoPlay();
                    setTimeout(startAutoPlay, 5000);
                }
            }
        });
    }

    // Initialize carousel
    initCarousel();
});
