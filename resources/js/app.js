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
    const currentPath = window.location.pathname;
    navLinks.forEach(function (link) {
        link.classList.remove('active');
        var href = link.getAttribute('href');
        if (href === currentPath || (href !== '/' && currentPath.startsWith(href))) {
            link.classList.add('active');
        }
        if (currentPath === '/' && href === '/') {
            link.classList.add('active');
        }
    });
});
