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

    // Mobile menu functionality for guest layout
    const mobileMenuBtn = document.getElementById("mobile-menu-btn");
    const mobileMenuElement = document.getElementById("mobile-menu");

    if (mobileMenuBtn && mobileMenuElement) {
        mobileMenuBtn.addEventListener("click", function () {
            mobileMenuElement.classList.toggle("hidden");

            // Update icon
            const icon = this.querySelector("svg");
            if (mobileMenuElement.classList.contains("hidden")) {
                icon.innerHTML =
                    '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>';
            } else {
                icon.innerHTML =
                    '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>';
            }
        });
    }
});

// Toast notification function
function showToast(message, type = "info") {
    const toastContainer = document.getElementById("toast-container");
    if (!toastContainer) return;

    const toast = document.createElement("div");
    toast.className = `toast flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow-lg transition-all duration-300 transform translate-x-full opacity-0`;

    let iconColor = "text-blue-500";
    let icon = `<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>`;

    if (type === "success") {
        iconColor = "text-green-500";
        icon = `<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>`;
    } else if (type === "error") {
        iconColor = "text-red-500";
        icon = `<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>`;
    } else if (type === "warning") {
        iconColor = "text-yellow-500";
        icon = `<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>`;
    }

    toast.innerHTML = `
        <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 ${iconColor} bg-opacity-20 rounded-lg">
            ${icon}
        </div>
        <div class="ml-3 text-sm font-medium text-gray-900">${message}</div>
        <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex h-8 w-8" onclick="this.parentElement.remove()">
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    `;

    toastContainer.appendChild(toast);

    // Animate in
    setTimeout(() => {
        toast.classList.remove("translate-x-full", "opacity-0");
        toast.classList.add("translate-x-0", "opacity-100");
    }, 100);

    // Auto remove after 5 seconds
    setTimeout(() => {
        toast.classList.add("translate-x-full", "opacity-0");
        setTimeout(() => {
            if (toast.parentElement) {
                toast.remove();
            }
        }, 300);
    }, 5000);
}

// Loading state helper
function setLoading(element, isLoading = true) {
    if (isLoading) {
        element.classList.add("loading");
        element.disabled = true;
        const originalText = element.textContent;
        element.dataset.originalText = originalText;
        element.innerHTML = `
            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            Loading...
        `;
    } else {
        element.classList.remove("loading");
        element.disabled = false;
        element.textContent = element.dataset.originalText || "Submit";
    }
}

// Utility function for form validation
function validateForm(formElement) {
    const inputs = formElement.querySelectorAll(
        "input[required], select[required], textarea[required]"
    );
    let isValid = true;

    inputs.forEach((input) => {
        const errorElement =
            input.parentElement.querySelector(".error-message");

        if (!input.value.trim()) {
            isValid = false;
            input.classList.add("border-red-500");
            if (errorElement) {
                errorElement.textContent = "Field ini wajib diisi";
                errorElement.classList.remove("hidden");
            }
        } else {
            input.classList.remove("border-red-500");
            if (errorElement) {
                errorElement.classList.add("hidden");
            }
        }

        // Email validation
        if (input.type === "email" && input.value) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(input.value)) {
                isValid = false;
                input.classList.add("border-red-500");
                if (errorElement) {
                    errorElement.textContent = "Format email tidak valid";
                    errorElement.classList.remove("hidden");
                }
            }
        }

        // Phone validation
        if (input.type === "tel" && input.value) {
            const phoneRegex = /^(\+62|62|0)8[1-9][0-9]{6,9}$/;
            if (!phoneRegex.test(input.value)) {
                isValid = false;
                input.classList.add("border-red-500");
                if (errorElement) {
                    errorElement.textContent =
                        "Format nomor telepon tidak valid";
                    errorElement.classList.remove("hidden");
                }
            }
        }
    });

    return isValid;
}

// Make functions globally available
window.showToast = showToast;
window.setLoading = setLoading;
window.validateForm = validateForm;
