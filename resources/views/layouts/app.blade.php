<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Rifqi Ariq — Game Developer, Frontend Developer, and Graphic Designer Portfolio">

    <title>@yield('title', 'Rifqi Ariq — Portfolio')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:wght@300;400;500&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <x-intro />

    <nav class="navbar" role="navigation" aria-label="Main navigation">
        <a href="/" class="nav-link" style="font-size: 1.25rem; text-transform: none; letter-spacing: 0;">RA</a>
        <div class="nav-desktop" style="display: flex; gap: 2rem; align-items: center;">
            <a href="/" class="nav-link active">Home</a>
            <a href="/projects" class="nav-link">Projects</a>
            <a href="/skills" class="nav-link">Skills</a>
            <a href="/play" class="nav-link">Play</a>
            <a href="/github" class="nav-link">GitHub</a>
            <a href="/connect" class="nav-link">Connect</a>
        </div>
        <button class="hamburger" id="hamburgerBtn" aria-label="Toggle navigation menu" aria-expanded="false">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </nav>

    <div class="mobile-overlay" id="mobileOverlay" role="dialog" aria-modal="true" aria-label="Navigation menu">
        <div class="mobile-menu">
            <a href="/" class="mobile-link">Home</a>
            <a href="/projects" class="mobile-link">Projects</a>
            <a href="/skills" class="mobile-link">Skills</a>
            <a href="/play" class="mobile-link">Play</a>
            <a href="/github" class="mobile-link">GitHub</a>
            <a href="/connect" class="mobile-link">Connect</a>
        </div>
    </div>

    <main>
        @yield('content')
    </main>

    <footer style="border-top: 1px solid rgba(255, 255, 255, 0.08); padding: 2rem clamp(1.5rem, 5vw, 4rem); text-align: center;">
        <p style="color: #4A5568; font-size: 0.875rem;">
            &copy; {{ date('Y') }} Rifqi Ariq. Built with Laravel &amp; Liquid Glass.
        </p>
    </footer>

    @stack('scripts')
</body>
</html>
