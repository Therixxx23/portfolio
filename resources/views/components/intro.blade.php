<div class="intro-overlay" id="introOverlay" role="presentation" aria-hidden="true">
    <div class="intro-blob" style="background: linear-gradient(135deg, #00D4FF, #0066FF);"></div>
    <div class="intro-initial">RA</div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const overlay = document.getElementById('introOverlay');

    function exitIntro() {
        overlay.classList.add('exit');
        setTimeout(function () {
            overlay.style.display = 'none';
        }, 800);
    }

    var hasSeenIntro = sessionStorage.getItem('introShown');
    if (hasSeenIntro) {
        overlay.style.display = 'none';
    } else {
        setTimeout(exitIntro, 2400);
        sessionStorage.setItem('introShown', 'true');
    }
});
</script>
@endpush
