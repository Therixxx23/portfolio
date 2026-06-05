@extends('layouts.app')

@section('title', $game->title . ' — Play')

@section('content')
<section style="position:fixed;inset:0;z-index:50;background:#080C14;display:flex;flex-direction:column;">
    <div style="display:flex;align-items:center;gap:1rem;padding:0.75rem 1.25rem;background:rgba(8,12,20,0.95);border-bottom:1px solid rgba(255,255,255,0.08);flex-shrink:0;z-index:10;">
        <a href="{{ route('play.index') }}" style="display:flex;align-items:center;gap:0.5rem;color:#8B9CBD;text-decoration:none;font-size:0.85rem;font-family:'DM Sans',sans-serif;transition:color 0.2s;" onmouseover="this.style.color='#F0F4FF'" onmouseout="this.style.color='#8B9CBD'">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
            Back
        </a>
        <span style="width:1px;height:20px;background:rgba(255,255,255,0.08);"></span>
        <span style="font-family:'Syne',sans-serif;font-weight:600;font-size:0.95rem;color:#F0F4FF;">{{ $game->title }}</span>
        <span style="width:1px;height:20px;background:rgba(255,255,255,0.08);"></span>
        <span style="color:#4A5568;font-size:0.75rem;font-family:'JetBrains Mono',monospace;">{{ $game->category }}</span>
        <div style="margin-left:auto;display:flex;gap:0.5rem;">
            <button id="fullscreenBtn" style="background:rgba(255,255,255,0.06);border:1px solid rgba(255,255,255,0.1);color:#8B9CBD;width:36px;height:36px;border-radius:0.5rem;cursor:pointer;display:flex;align-items:center;justify-content:center;transition:all 0.2s;" onmouseover="this.style.color='#F0F4FF';this.style.borderColor='rgba(255,255,255,0.2)'" onmouseout="this.style.color='#8B9CBD';this.style.borderColor='rgba(255,255,255,0.1)'" title="Fullscreen">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M8 3H5a2 2 0 0 0-2 2v3m18 0V5a2 2 0 0 0-2-2h-3m0 18h3a2 2 0 0 0 2-2v-3M3 16v3a2 2 0 0 0 2 2h3"/></svg>
            </button>
        </div>
    </div>

    <div id="gameContainer" style="flex:1;position:relative;overflow:hidden;">
        <div id="gameLoader" style="position:absolute;inset:0;display:flex;flex-direction:column;align-items:center;justify-content:center;background:#080C14;z-index:5;">
            <div class="liquid-blob" style="width:80px;height:80px;background:linear-gradient(135deg,#00D4FF,#0066FF);margin-bottom:1.5rem;position:relative;"></div>
            <p style="color:#8B9CBD;font-family:'JetBrains Mono',monospace;font-size:0.875rem;" id="loaderText">Loading {{ $game->title }}...</p>
        </div>
        <iframe id="gameIframe" src="{{ $game->iframe_url ?? $game->path }}" style="display:none;width:100%;height:100%;border:none;" sandbox="allow-scripts allow-same-origin allow-popups allow-pointer-lock" allowfullscreen></iframe>
    </div>
</section>

<style>
.liquid-blob {
    animation: liquidMorph 8s ease-in-out infinite;
    filter: blur(40px);
    opacity: 0.15;
    position: absolute;
    pointer-events: none;
    border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%;
}
@keyframes liquidMorph {
    0%   { border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%; }
    25%  { border-radius: 30% 60% 70% 40% / 50% 60% 30% 60%; }
    50%  { border-radius: 50% 60% 30% 60% / 30% 40% 70% 50%; }
    75%  { border-radius: 40% 70% 60% 30% / 60% 50% 40% 70%; }
    100% { border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%; }
}
</style>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const iframe = document.getElementById('gameIframe');
    const loader = document.getElementById('gameLoader');
    const fullscreenBtn = document.getElementById('fullscreenBtn');
    const container = document.getElementById('gameContainer');

    function onIframeLoaded() {
        loader.style.display = 'none';
        iframe.style.display = 'block';
    }

    if (iframe.complete || iframe.contentDocument?.readyState === 'complete') {
        onIframeLoaded();
    } else {
        iframe.addEventListener('load', onIframeLoaded);
        iframe.addEventListener('error', onIframeLoaded);
    }

    setTimeout(function () {
        if (loader.style.display !== 'none') {
            loader.style.display = 'none';
            iframe.style.display = 'block';
        }
    }, 15000);

    fullscreenBtn.addEventListener('click', function () {
        if (!document.fullscreenElement) {
            if (container.requestFullscreen) {
                container.requestFullscreen();
            } else if (container.webkitRequestFullscreen) {
                container.webkitRequestFullscreen();
            } else if (container.msRequestFullscreen) {
                container.msRequestFullscreen();
            }
        } else {
            if (document.exitFullscreen) {
                document.exitFullscreen();
            }
        }
    });
});
</script>
@endpush
@endsection
