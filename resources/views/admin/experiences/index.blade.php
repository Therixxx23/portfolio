@extends('layouts.app')

@section('title', 'Manage Experience')

@section('content')
<section class="section-container" style="padding-top: 8rem;">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:2rem;flex-wrap:wrap;gap:1rem;">
        <div>
            <h1 class="section-title" style="margin-bottom:0.25rem;">Manage Experience</h1>
            <p style="color:#8B9CBD;">Manage your work experience timeline.</p>
        </div>
        <a href="{{ route('admin.experiences.create') }}" class="btn-primary" style="text-decoration:none;font-size:0.8rem;padding:0.6rem 1.25rem;">+ Add Experience</a>
    </div>

    <div class="glass-card" style="padding:1.25rem;margin-bottom:2.5rem;">
        <div style="display:flex;flex-wrap:wrap;gap:0.75rem;justify-content:center;">
            <a href="{{ route('admin.dashboard') }}" class="nav-link" style="padding:0.6rem 1.25rem;border-radius:0.5rem;text-decoration:none;font-size:0.85rem;font-weight:400;color:#8B9CBD;border:1px solid transparent;transition:all 0.2s;" onmouseover="this.style.borderColor='rgba(255,255,255,0.15)';this.style.color='#F0F4FF'" onmouseout="this.style.borderColor='transparent';this.style.color='#8B9CBD'">Dashboard</a>
            <a href="{{ route('admin.profile') }}" class="nav-link" style="padding:0.6rem 1.25rem;border-radius:0.5rem;text-decoration:none;font-size:0.85rem;font-weight:400;color:#8B9CBD;border:1px solid transparent;transition:all 0.2s;" onmouseover="this.style.borderColor='rgba(255,255,255,0.15)';this.style.color='#F0F4FF'" onmouseout="this.style.borderColor='transparent';this.style.color='#8B9CBD'">Profile</a>
            <a href="{{ route('admin.experiences') }}" class="nav-link" style="background:rgba(0,212,255,0.1);border:1px solid rgba(0,212,255,0.3);color:#00D4FF;padding:0.6rem 1.25rem;border-radius:0.5rem;text-decoration:none;font-size:0.85rem;font-weight:500;">Experience</a>
            <a href="{{ route('admin.educations') }}" class="nav-link" style="padding:0.6rem 1.25rem;border-radius:0.5rem;text-decoration:none;font-size:0.85rem;font-weight:400;color:#8B9CBD;border:1px solid transparent;transition:all 0.2s;" onmouseover="this.style.borderColor='rgba(255,255,255,0.15)';this.style.color='#F0F4FF'" onmouseout="this.style.borderColor='transparent';this.style.color='#8B9CBD'">Education</a>
            <a href="{{ route('admin.projects') }}" class="nav-link" style="padding:0.6rem 1.25rem;border-radius:0.5rem;text-decoration:none;font-size:0.85rem;font-weight:400;color:#8B9CBD;border:1px solid transparent;transition:all 0.2s;" onmouseover="this.style.borderColor='rgba(255,255,255,0.15)';this.style.color='#F0F4FF'" onmouseout="this.style.borderColor='transparent';this.style.color='#8B9CBD'">Projects</a>
            <a href="{{ route('admin.games') }}" class="nav-link" style="padding:0.6rem 1.25rem;border-radius:0.5rem;text-decoration:none;font-size:0.85rem;font-weight:400;color:#8B9CBD;border:1px solid transparent;transition:all 0.2s;" onmouseover="this.style.borderColor='rgba(255,255,255,0.15)';this.style.color='#F0F4FF'" onmouseout="this.style.borderColor='transparent';this.style.color='#8B9CBD'">Games</a>
        </div>
    </div>

    @if (session('success'))
        <div style="padding:0.75rem 1rem;background:rgba(0,255,179,0.1);border:1px solid rgba(0,255,179,0.3);border-radius:0.75rem;margin-bottom:1.5rem;">
            <p style="color:#00FFB3;font-size:0.85rem;margin:0;">{{ session('success') }}</p>
        </div>
    @endif

    @if ($experiences->count() > 0)
        <div style="display:grid;gap:1rem;">
            @foreach ($experiences as $experience)
                <div class="glass-card" style="display:flex;flex-wrap:wrap;gap:1.5rem;align-items:center;justify-content:space-between;padding:1.5rem;">
                    <div style="flex:1;min-width:200px;">
                        <h3 style="font-family:'Syne',sans-serif;font-weight:600;font-size:1.05rem;color:#F0F4FF;margin-bottom:0.25rem;">{{ $experience->company }}</h3>
                        <p style="color:#00D4FF;font-size:0.85rem;font-weight:500;margin-bottom:0.15rem;">{{ $experience->role }}</p>
                        <p style="color:#4A5568;font-size:0.8rem;font-family:'JetBrains Mono',monospace;">{{ $experience->period }}</p>
                        @if ($experience->description)
                            <p style="color:#8B9CBD;font-size:0.85rem;margin-top:0.5rem;max-width:500px;">{{ $experience->description }}</p>
                        @endif
                    </div>
                    <div style="display:flex;gap:0.5rem;flex-shrink:0;">
                        <a href="{{ route('admin.experiences.edit', $experience) }}" class="btn-ghost" style="font-size:0.75rem;padding:0.4rem 1rem;text-decoration:none;">Edit</a>
                        <form method="POST" action="{{ route('admin.experiences.delete', $experience) }}" style="display:inline;" onsubmit="return confirm('Delete this experience?');">
                            @csrf
                            <button type="submit" style="background:transparent;color:#FF4466;border:1px solid rgba(255,68,102,0.3);padding:0.4rem 1rem;border-radius:0.5rem;font-family:'DM Sans',sans-serif;font-size:0.75rem;cursor:pointer;transition:all 0.2s;" onmouseover="this.style.background='rgba(255,68,102,0.1)'" onmouseout="this.style.background='transparent'">Delete</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="glass-card" style="padding:2.5rem;text-align:center;">
            <p style="color:#4A5568;font-family:'JetBrains Mono',monospace;font-size:0.875rem;margin-bottom:0.5rem;">No experiences yet.</p>
            <p style="color:#4A5568;font-size:0.8rem;">Click "Add Experience" to create your first entry.</p>
        </div>
    @endif
</section>
@endsection
