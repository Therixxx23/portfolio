import './bootstrap';

document.addEventListener('DOMContentLoaded', function () {
    const observer = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    });

    document.querySelectorAll('.animate-on-scroll:not(.visible)').forEach(function (el) {
        observer.observe(el);
    });

    const navbar = document.querySelector('.navbar');
    if (navbar) {
        let lastScroll = 0;
        window.addEventListener('scroll', function () {
            const current = window.scrollY;
            navbar.style.transform = current > lastScroll && current > 100 ? 'translateY(-100%)' : 'translateY(0)';
            lastScroll = current;
        });
    }

    const navLinks = document.querySelectorAll('.nav-link');
    const mobileLinks = document.querySelectorAll('.mobile-link');
    const currentPath = window.location.pathname;

    function setActiveLink(links) {
        links.forEach(function (link) {
            link.classList.remove('active');
            var href = link.getAttribute('href');
            if (href === currentPath || (href !== '/' && currentPath.startsWith(href))) {
                link.classList.add('active');
            }
            if (currentPath === '/' && href === '/') {
                link.classList.add('active');
            }
        });
    }

    setActiveLink(navLinks);
    setActiveLink(mobileLinks);

    const hamburger = document.getElementById('hamburgerBtn');
    const overlay = document.getElementById('mobileOverlay');

    if (hamburger && overlay) {
        function openMenu() {
            hamburger.classList.add('open');
            hamburger.setAttribute('aria-expanded', 'true');
            overlay.classList.add('open');
            document.body.style.overflow = 'hidden';
        }

        function closeMenu() {
            hamburger.classList.remove('open');
            hamburger.setAttribute('aria-expanded', 'false');
            overlay.classList.remove('open');
            document.body.style.overflow = '';
        }

        hamburger.addEventListener('click', function () {
            var isOpen = overlay.classList.contains('open');
            if (isOpen) {
                closeMenu();
            } else {
                openMenu();
            }
        });

        overlay.addEventListener('click', function (e) {
            if (e.target === overlay) {
                closeMenu();
            }
        });

        mobileLinks.forEach(function (link) {
            link.addEventListener('click', closeMenu);
        });
    }
});
