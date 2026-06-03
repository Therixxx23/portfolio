@extends('layouts.app')

@section('title', 'Manage Games')

@section('content')
<section class="section-container" style="padding-top: 8rem;">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:2rem;flex-wrap:wrap;gap:1rem;">
        <div>
            <h1 class="section-title" style="margin-bottom:0.25rem;">Manage Games</h1>
            <p style="color:#8B9CBD;">Manage your Unity WebGL game entries.</p>
        </div>
        <a href="{{ route('admin.games.create') }}" class="btn-primary">+ Add Game</a>
    </div>

    <div class="glass-card" style="padding:1.5rem;margin-bottom:2rem;">
        <div style="display:flex;gap:0.5rem;flex-wrap:wrap;">
            <a href="{{ route('admin.dashboard') }}" class="btn-ghost" style="font-size:0.8rem;padding:0.5rem 1rem;">Dashboard</a>
            <a href="{{ route('admin.educations') }}" class="btn-ghost" style="font-size:0.8rem;padding:0.5rem 1rem;">Education</a>
            <a href="{{ route('admin.projects') }}" class="btn-ghost" style="font-size:0.8rem;padding:0.5rem 1rem;">Projects</a>
            <a href="{{ route('admin.games') }}" class="btn-primary" style="font-size:0.8rem;padding:0.5rem 1rem;">Games</a>
        </div>
    </div>

    @if (session('success'))
        <div style="padding:0.75rem 1rem;background:rgba(0,255,179,0.1);border:1px solid rgba(0,255,179,0.3);border-radius:0.5rem;margin-bottom:1.5rem;">
            <p style="color:#00FFB3;font-size:0.875rem;">{{ session('success') }}</p>
        </div>
    @endif

    @if ($games->count() > 0)
        <div style="overflow-x:auto;">
            <table style="width:100%;border-collapse:collapse;font-size:0.875rem;">
                <thead>
                    <tr style="color:#8B9CBD;text-transform:uppercase;letter-spacing:0.05em;font-size:0.75rem;border-bottom:1px solid rgba(255,255,255,0.08);">
                        <th style="padding:0.75rem 1rem;text-align:left;">Title</th>
                        <th style="padding:0.75rem 1rem;text-align:left;">Slug</th>
                        <th style="padding:0.75rem 1rem;text-align:left;">Category</th>
                        <th style="padding:0.75rem 1rem;text-align:left;">Status</th>
                        <th style="padding:0.75rem 1rem;text-align:left;">Thumbnail</th>
                        <th style="padding:0.75rem 1rem;text-align:right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($games as $game)
                        <tr style="border-bottom:1px solid rgba(255,255,255,0.04);transition:background 0.2s;" onmouseover="this.style.background='rgba(255,255,255,0.02)'" onmouseout="this.style.background='transparent'">
                            <td style="padding:1rem;color:#F0F4FF;font-weight:500;">{{ $game->title }}</td>
                            <td style="padding:1rem;color:#8B9CBD;font-family:'JetBrains Mono',monospace;font-size:0.8rem;">{{ $game->slug }}</td>
                            <td style="padding:1rem;color:#8B9CBD;text-transform:capitalize;">{{ $game->category }}</td>
                            <td style="padding:1rem;">
                                @if ($game->status === 'published')
                                    <span style="font-size:0.75rem;background:rgba(0,255,179,0.1);color:#00FFB3;padding:0.2rem 0.6rem;border-radius:0.25rem;">Published</span>
                                @else
                                    <span style="font-size:0.75rem;background:rgba(255,255,255,0.06);color:#8B9CBD;padding:0.2rem 0.6rem;border-radius:0.25rem;">Draft</span>
                                @endif
                            </td>
                            <td style="padding:1rem;">
                                @if ($game->thumbnail)
                                    <img src="{{ Storage::url($game->thumbnail) }}" alt="{{ $game->title }}" style="width:60px;height:40px;object-fit:cover;border-radius:0.375rem;border:1px solid rgba(255,255,255,0.08);">
                                @else
                                    <span style="color:#4A5568;font-size:0.8rem;">—</span>
                                @endif
                            </td>
                            <td style="padding:1rem;text-align:right;">
                                <div style="display:flex;gap:0.5rem;justify-content:flex-end;">
                                    <a href="{{ route('admin.games.edit', $game) }}" class="btn-ghost" style="font-size:0.75rem;padding:0.4rem 0.85rem;">Edit</a>
                                    <form method="POST" action="{{ route('admin.games.delete', $game) }}" onsubmit="return confirm('Delete this game entry?')" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn-ghost" style="font-size:0.75rem;padding:0.4rem 0.85rem;color:#FF4466;border-color:rgba(255,68,102,0.3);">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="glass-card" style="padding:3rem;text-align:center;">
            <p style="color:#4A5568;font-family:'JetBrains Mono',monospace;font-size:0.875rem;">No games yet.</p>
            <p style="color:#4A5568;font-size:0.8rem;margin-top:0.25rem;">Click "Add Game" to get started.</p>
        </div>
    @endif
</section>
@endsection
