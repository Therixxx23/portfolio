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

    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:1rem;margin-bottom:3rem;">
        <div class="stat-card">
            <span class="stat-value">{{ $projectCount ?? 0 }}</span>
            <span class="stat-label">Projects</span>
        </div>
        <div class="stat-card">
            <span class="stat-value">{{ $gameCount ?? 0 }}</span>
            <span class="stat-label">Games</span>
        </div>
    </div>

    <div class="glass-card animate-on-scroll" style="padding:2rem;text-align:center;">
        <div style="font-size:2rem;margin-bottom:1rem;">
            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#00D4FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/></svg>
        </div>
        <p style="color:#4A5568;font-family:'JetBrains Mono',monospace;font-size:0.875rem;margin-bottom:0.5rem;">Project & Game management coming soon.</p>
        <p style="color:#4A5568;font-size:0.8rem;">CRUD forms will be added in the next iteration.</p>
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
