@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<section class="section-container" style="padding-top: 8rem;">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:3rem;flex-wrap:wrap;gap:1rem;">
        <div>
            <h1 class="section-title" style="margin-bottom:0.25rem;">Admin Dashboard</h1>
            <p style="color:#8B9CBD;">Welcome back, {{ session('admin_username') }}.</p>
        </div>
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" class="btn-ghost" style="font-size:0.8rem;padding:0.5rem 1.25rem;">Sign Out</button>
        </form>
    </div>

    <div class="glass-card" style="padding:1.25rem;margin-bottom:2.5rem;">
        <div style="display:flex;flex-wrap:wrap;gap:0.75rem;justify-content:center;">
            <a href="{{ route('admin.dashboard') }}" class="nav-link" style="background:rgba(0,212,255,0.1);border:1px solid rgba(0,212,255,0.3);color:#00D4FF;padding:0.6rem 1.25rem;border-radius:0.5rem;text-decoration:none;font-size:0.85rem;font-weight:500;">Dashboard</a>
            <a href="{{ route('admin.profile') }}" class="nav-link" style="padding:0.6rem 1.25rem;border-radius:0.5rem;text-decoration:none;font-size:0.85rem;font-weight:400;color:#8B9CBD;border:1px solid transparent;transition:all 0.2s;" onmouseover="this.style.borderColor='rgba(255,255,255,0.15)';this.style.color='#F0F4FF'" onmouseout="this.style.borderColor='transparent';this.style.color='#8B9CBD'">Profile</a>
            <a href="{{ route('admin.experiences') }}" class="nav-link" style="padding:0.6rem 1.25rem;border-radius:0.5rem;text-decoration:none;font-size:0.85rem;font-weight:400;color:#8B9CBD;border:1px solid transparent;transition:all 0.2s;" onmouseover="this.style.borderColor='rgba(255,255,255,0.15)';this.style.color='#F0F4FF'" onmouseout="this.style.borderColor='transparent';this.style.color='#8B9CBD'">Experience</a>
            <a href="{{ route('admin.educations') }}" class="nav-link" style="padding:0.6rem 1.25rem;border-radius:0.5rem;text-decoration:none;font-size:0.85rem;font-weight:400;color:#8B9CBD;border:1px solid transparent;transition:all 0.2s;" onmouseover="this.style.borderColor='rgba(255,255,255,0.15)';this.style.color='#F0F4FF'" onmouseout="this.style.borderColor='transparent';this.style.color='#8B9CBD'">Education</a>
            <a href="{{ route('admin.projects') }}" class="nav-link" style="padding:0.6rem 1.25rem;border-radius:0.5rem;text-decoration:none;font-size:0.85rem;font-weight:400;color:#8B9CBD;border:1px solid transparent;transition:all 0.2s;" onmouseover="this.style.borderColor='rgba(255,255,255,0.15)';this.style.color='#F0F4FF'" onmouseout="this.style.borderColor='transparent';this.style.color='#8B9CBD'">Projects</a>
            <a href="{{ route('admin.games') }}" class="nav-link" style="padding:0.6rem 1.25rem;border-radius:0.5rem;text-decoration:none;font-size:0.85rem;font-weight:400;color:#8B9CBD;border:1px solid transparent;transition:all 0.2s;" onmouseover="this.style.borderColor='rgba(255,255,255,0.15)';this.style.color='#F0F4FF'" onmouseout="this.style.borderColor='transparent';this.style.color='#8B9CBD'">Games</a>
        </div>
    </div>

    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:1rem;margin-bottom:3rem;">
        <div class="stat-card">
            <span class="stat-value">{{ $projectCount ?? 0 }}</span>
            <span class="stat-label">Projects</span>
        </div>
        <div class="stat-card">
            <span class="stat-value">{{ $gameCount ?? 0 }}</span>
            <span class="stat-label">Games</span>
        </div>
        <div class="stat-card">
            <span class="stat-value">{{ $experienceCount ?? 0 }}</span>
            <span class="stat-label">Experiences</span>
        </div>
        <div class="stat-card">
            <span class="stat-value">{{ $educationCount ?? 0 }}</span>
            <span class="stat-label">Educations</span>
        </div>
    </div>
</section>

<style>
.stat-card {
    background: rgba(255, 255, 255, 0.04);
    border: 1px solid rgba(255, 255, 255, 0.08);
    border-radius: 1rem;
    padding: 1.5rem;
    text-align: center;
    transition: all 0.3s ease;
}
.stat-card:hover {
    background: rgba(255, 255, 255, 0.07);
    border-color: rgba(0, 212, 255, 0.2);
    transform: translateY(-2px);
}
.stat-value {
    display: block;
    font-family: 'Syne', sans-serif;
    font-weight: 800;
    font-size: 2rem;
    color: #00D4FF;
    margin-bottom: 0.25rem;
}
.stat-label {
    font-family: 'DM Sans', sans-serif;
    font-size: 0.8rem;
    color: #8B9CBD;
    letter-spacing: 0.05em;
    text-transform: uppercase;
}
</style>
@endsection
