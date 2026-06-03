@extends('layouts.app')

@section('title', 'Play — Rifqi Ariq')

@section('content')
<section class="section-container" style="padding-top: 8rem;">
    <h1 class="section-title animate-on-scroll" style="margin-bottom: 1rem;">Game Room</h1>
    <p class="animate-on-scroll" style="color: #8B9CBD; margin-bottom: 3rem; max-width: 600px; transition-delay: 0.1s;">
        Unity WebGL games I've built. Click to play directly in your browser.
    </p>

    @if (count($games) === 0)
        <div class="glass-card animate-on-scroll" style="padding: 3rem; text-align: center;">
            <p style="color: #4A5568; font-family: 'JetBrains Mono', monospace;">No games uploaded yet.</p>
        </div>
    @else
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 1.5rem;">
            @foreach ($games as $game)
                <a href="{{ route('play.show', $game) }}" class="game-card animate-on-scroll" style="text-decoration:none;display:flex;flex-direction:column;">
                    <div class="game-card-thumb">
                        @if ($game->thumbnail)
                            <img src="{{ Storage::url($game->thumbnail) }}" alt="{{ $game->title }}" loading="lazy" style="width:100%;height:100%;object-fit:cover;">
                        @else
                            <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;background:linear-gradient(135deg,#00D4FF15,#0066FF15);flex-direction:column;gap:1rem;">
                                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#00D4FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><line x1="6" y1="11" x2="10" y2="11"/><line x1="8" y1="9" x2="8" y2="13"/><line x1="15" y1="12" x2="15.01" y2="12"/><line x1="18" y1="10" x2="18.01" y2="10"/><path d="M17.32 5H6.68a4 4 0 0 0-3.978 3.59c-.006.052-.01.101-.017.152C2.604 9.416 2 14.456 2 16a3 3 0 0 0 3 3c1 0 1.5-.5 2-1l1.414-1.414A2 2 0 0 1 9.828 16h4.344a2 2 0 0 1 1.414.586L17 18c.5.5 1 1 2 1a3 3 0 0 0 3-3c0-1.545-.604-6.584-.685-7.258-.007-.05-.011-.1-.017-.151A4 4 0 0 0 17.32 5z"/></svg>
                                <span style="font-family:'Syne',sans-serif;font-weight:600;color:#F0F4FF;">{{ $game->title }}</span>
                            </div>
                        @endif
                    </div>
                    <div class="game-card-info" style="flex:1;display:flex;flex-direction:column;">
                        <h3 style="font-family:'Syne',sans-serif;font-weight:600;font-size:1.05rem;color:#F0F4FF;margin-bottom:0.35rem;">{{ $game->title }}</h3>
                        <p style="font-size:0.85rem;color:#8B9CBD;margin-bottom:1rem;flex:1;">{{ $game->description }}</p>
                        <div style="display:flex;align-items:center;gap:0.5rem;">
                            <span style="font-size:0.7rem;background:rgba(0,212,255,0.1);color:#00D4FF;padding:0.2rem 0.6rem;border-radius:0.25rem;font-family:'JetBrains Mono',monospace;text-transform:uppercase;">{{ $game->category }}</span>
                            <span class="btn-primary" style="font-size:0.8rem;padding:0.5rem 1rem;margin-left:auto;justify-content:center;">Play Now</span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    @endif
</section>

<style>
.game-card {
    background: rgba(255, 255, 255, 0.04);
    border: 1px solid rgba(255, 255, 255, 0.08);
    border-radius: 1rem;
    overflow: hidden;
    cursor: pointer;
    transition: all 0.4s cubic-bezier(0.23, 1, 0.32, 1);
}
.game-card:hover {
    transform: translateY(-6px);
    border-color: rgba(0, 212, 255, 0.2);
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.4);
}
.game-card-thumb {
    width: 100%;
    aspect-ratio: 16/9;
    overflow: hidden;
    transition: filter 0.4s ease;
}
.game-card:hover .game-card-thumb {
    filter: brightness(1.1);
}
.game-card-info {
    padding: 1.25rem;
}
</style>
@endsection
