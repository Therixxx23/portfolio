@extends('layouts.app')

@section('title', 'Profile — Admin')

@section('content')
<section class="section-container" style="padding-top: 8rem;">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:3rem;flex-wrap:wrap;gap:1rem;">
        <div>
            <h1 class="section-title" style="margin-bottom:0.25rem;">Profile Settings</h1>
            <p style="color:#8B9CBD;">Manage your profile photo.</p>
        </div>
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" class="btn-ghost" style="font-size:0.8rem;padding:0.5rem 1.25rem;">Sign Out</button>
        </form>
    </div>

    <div style="display:flex;gap:0.5rem;margin-bottom:3rem;flex-wrap:wrap;">
        <a href="{{ route('admin.dashboard') }}" class="btn-ghost" style="font-size:0.8rem;padding:0.5rem 1.25rem;text-decoration:none;">Dashboard</a>
        <a href="{{ route('admin.profile') }}" style="background:#00D4FF;color:#080C14;border:none;padding:0.5rem 1.25rem;border-radius:0.5rem;font-family:'DM Sans',sans-serif;font-size:0.8rem;font-weight:500;cursor:pointer;text-decoration:none;transition:all 0.3s ease;">Profile</a>
        <a href="{{ route('admin.experiences') }}" class="btn-ghost" style="font-size:0.8rem;padding:0.5rem 1.25rem;text-decoration:none;">Experience</a>
        <a href="{{ route('admin.educations') }}" class="btn-ghost" style="font-size:0.8rem;padding:0.5rem 1.25rem;text-decoration:none;">Education</a>
        <a href="{{ route('admin.projects') }}" class="btn-ghost" style="font-size:0.8rem;padding:0.5rem 1.25rem;text-decoration:none;">Projects</a>
        <a href="{{ route('admin.games') }}" class="btn-ghost" style="font-size:0.8rem;padding:0.5rem 1.25rem;text-decoration:none;">Games</a>
    </div>

    @if (session('success'))
        <div class="glass-card animate-on-scroll" style="padding:1rem 1.5rem;margin-bottom:2rem;border-left:3px solid #00FFB3;display:flex;align-items:center;gap:0.75rem;">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#00FFB3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
            <span style="color:#F0F4FF;font-size:0.9rem;">{{ session('success') }}</span>
        </div>
    @endif

    <div style="display:grid;grid-template-columns:1fr;gap:2rem;max-width:600px;">
        <div class="glass-card animate-on-scroll" style="padding:2rem;text-align:center;">
            <h3 style="font-family:'Syne',sans-serif;font-weight:600;font-size:1.1rem;color:#F0F4FF;margin-bottom:1.5rem;">Current Photo</h3>
            <div style="width:160px;height:160px;border-radius:50%;margin:0 auto 1.5rem;overflow:hidden;border:2px solid rgba(0,212,255,0.2);background:linear-gradient(135deg,#00D4FF20,#0066FF20);display:flex;align-items:center;justify-content:center;">
                @if (session('profile_photo'))
                    <img src="{{ Storage::url(session('profile_photo')) }}" alt="Profile Photo" style="width:100%;height:100%;object-fit:cover;">
                @else
                    <span style="font-family:'Syne',sans-serif;font-weight:800;font-size:3rem;color:#00D4FF40;">RA</span>
                @endif
            </div>
            <p style="color:#4A5568;font-size:0.8rem;font-family:'JetBrains Mono',monospace;">
                {{ session('profile_photo') ? basename(session('profile_photo')) : 'No photo uploaded' }}
            </p>
        </div>

        <div class="glass-card animate-on-scroll" style="padding:2rem;">
            <h3 style="font-family:'Syne',sans-serif;font-weight:600;font-size:1.1rem;color:#F0F4FF;margin-bottom:1.5rem;">Upload New Photo</h3>
            <form method="POST" action="{{ route('admin.profile.photo') }}" enctype="multipart/form-data">
                @csrf
                <div style="margin-bottom:1.25rem;">
                    <label for="photo" style="display:block;font-family:'DM Sans',sans-serif;font-size:0.85rem;color:#8B9CBD;margin-bottom:0.5rem;">Choose an image</label>
                    <input type="file" name="photo" id="photo" accept="image/png,image/jpeg,image/jpg,image/webp" class="form-input" style="padding:0.5rem;font-size:0.85rem;">
                    @error('photo')
                        <p style="color:#FF4466;font-size:0.75rem;margin-top:0.25rem;">{{ $message }}</p>
                    @enderror
                    <p style="color:#4A5568;font-size:0.75rem;margin-top:0.5rem;font-family:'JetBrains Mono',monospace;">Accepted: PNG, JPG, WebP &mdash; Max 2MB</p>
                </div>
                <button type="submit" class="btn-primary" style="font-size:0.85rem;">Upload Photo</button>
            </form>
        </div>
    </div>
</section>
@endsection
