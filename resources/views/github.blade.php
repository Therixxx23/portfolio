@extends('layouts.app')

@section('title', 'GitHub — Rifqi Ariq')

@section('content')
<section class="section-container" style="padding-top: 8rem;">
    <h1 class="section-title animate-on-scroll" style="margin-bottom: 1rem;">GitHub Activity</h1>
    <p class="animate-on-scroll" style="color: #8B9CBD; margin-bottom: 3rem; max-width: 600px; transition-delay: 0.1s;">
        My open-source contributions and coding activity.
    </p>

    @if ($error)
        <div class="animate-on-scroll glass-accent" style="padding:1.5rem;border-radius:1rem;text-align:center;margin-bottom:2rem;">
            <p style="font-family:'JetBrains Mono',monospace;font-size:0.8rem;color:#FF4466;">
                {{ $error }}
            </p>
        </div>
    @endif

    @if ($user && isset($user['avatar_url']))
        <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 2rem;">
            <img src="{{ $user['avatar_url'] }}" alt="{{ $user['login'] }}"
                 style="width: 64px; height: 64px; border-radius: 50%; border: 2px solid rgba(0,212,255,0.3);">
            <div>
                <h2 style="font-family:'Syne',sans-serif;font-weight:700;color:#F0F4FF;font-size:1.25rem;">
                    {{ $user['name'] ?? $user['login'] }}
                </h2>
                @if ($user && isset($user['bio']))
                    <p style="color:#8B9CBD;font-size:0.875rem;">{{ $user['bio'] }}</p>
                @endif
            </div>
        </div>
    @endif

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(160px, 1fr)); gap: 1rem; margin-bottom: 3rem;">
        <div class="stat-card animate-on-scroll">
            <span class="stat-value">{{ number_format($stats['total_commits']) }}</span>
            <span class="stat-label">Recent Commits</span>
        </div>
        <div class="stat-card animate-on-scroll" style="transition-delay:0.05s;">
            <span class="stat-value">{{ $stats['public_repos'] }}</span>
            <span class="stat-label">Public Repos</span>
        </div>
        <div class="stat-card animate-on-scroll" style="transition-delay:0.1s;">
            <span class="stat-value">{{ $stats['streak'] }}</span>
            <span class="stat-label">Day Streak</span>
        </div>
        <div class="stat-card animate-on-scroll" style="transition-delay:0.15s;">
            <span class="stat-value">{{ number_format($stats['total_stars']) }}</span>
            <span class="stat-label">Total Stars</span>
        </div>
    </div>

    <div class="animate-on-scroll glass-card" style="padding: 1.5rem; margin-bottom: 2rem;">
        <h3 style="font-family:'Syne',sans-serif;font-weight:600;color:#F0F4FF;margin-bottom:1rem;font-size:1rem;">Contribution Graph</h3>
        <div id="contributionGraph" style="min-height: 112px;">
            @if ($contributions)
                @php
                    $total = $contributions['totalContributions'];
                    $weeks = $contributions['weeks'];
                    $levels = ['rgba(0,212,255,0.05)', 'rgba(0,212,255,0.15)', 'rgba(0,212,255,0.35)', 'rgba(0,212,255,0.6)', 'rgba(0,212,255,1)'];
                @endphp
                <div style="margin-bottom:0.75rem;">
                    <span style="font-size:0.8rem;color:#4A5568;">{{ number_format($total) }} contributions in the last year</span>
                </div>
                <div style="display:grid;grid-template-columns:repeat({{ count($weeks) }},1fr);gap:2px;overflow-x:auto;">
                    @foreach ($weeks as $week)
                        <div style="display:grid;grid-template-rows:repeat(7,1fr);gap:2px;">
                            @foreach ($week['contributionDays'] as $day)
                                @php
                                    $idx = $day['contributionCount'] === 0 ? 0 : min((int)ceil($day['contributionCount'] / 5), 4);
                                @endphp
                                <div style="aspect-ratio:1;background:{{ $levels[$idx] }};border-radius:2px;" title="{{ $day['date'] }}: {{ $day['contributionCount'] }} contributions"></div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
                <div style="display:flex;justify-content:flex-end;align-items:center;gap:0.25rem;margin-top:0.75rem;">
                    <span style="font-size:0.7rem;color:#4A5568;">Less</span>
                    @foreach ($levels as $c)
                        <div style="width:12px;height:12px;border-radius:2px;background:{{ $c }};"></div>
                    @endforeach
                    <span style="font-size:0.7rem;color:#4A5568;">More</span>
                </div>
            @else
                <div style="color:#4A5568;font-size:0.875rem;text-align:center;padding:2rem;font-family:'JetBrains Mono',monospace;">
                    @if (!env('GITHUB_TOKEN'))
                        Set <code style="color:#00D4FF;">GITHUB_TOKEN</code> in .env to see contribution data.
                    @else
                        Unable to load contribution data.
                    @endif
                </div>
            @endif
        </div>
    </div>

    @if (!empty($repos))
        <h3 class="animate-on-scroll" style="font-family:'Syne',sans-serif;font-weight:600;color:#F0F4FF;margin-bottom:1.5rem;font-size:1rem;">Recent Repositories</h3>
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(340px,1fr));gap:1rem;">
            @foreach (array_slice($repos, 0, 6) as $repo)
                <a href="{{ $repo['html_url'] ?? '#' }}" target="_blank" rel="noopener" class="repo-card animate-on-scroll">
                    <div style="display:flex;align-items:flex-start;justify-content:space-between;gap:1rem;">
                        <div>
                            <h4 style="font-family:'Syne',sans-serif;font-weight:600;color:#F0F4FF;font-size:0.95rem;margin-bottom:0.35rem;">{{ $repo['name'] ?? 'Untitled' }}</h4>
                            @if ($repo['description'] ?? null)
                                <p style="font-size:0.8rem;color:#8B9CBD;margin-bottom:0.75rem;">{{ $repo['description'] }}</p>
                            @endif
                        </div>
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#8B9CBD" stroke-width="2" style="flex-shrink:0;margin-top:0.25rem;"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                    </div>
                    <div style="display:flex;gap:1rem;font-size:0.75rem;color:#4A5568;font-family:'JetBrains Mono',monospace;">
                        <span>Stars: {{ $repo['stargazers_count'] ?? 0 }}</span>
                        <span>Forks: {{ $repo['forks_count'] ?? 0 }}</span>
                        @if ($repo['language'] ?? null)
                            <span>Lang: {{ $repo['language'] }}</span>
                        @endif
                    </div>
                </a>
            @endforeach
        </div>
    @endif
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
    font-size: 1.75rem;
    color: #00D4FF;
    margin-bottom: 0.25rem;
}
.stat-label {
    font-family: 'DM Sans', sans-serif;
    font-size: 0.75rem;
    color: #8B9CBD;
    letter-spacing: 0.05em;
    text-transform: uppercase;
}
.repo-card {
    display: block;
    padding: 1.25rem;
    background: rgba(255, 255, 255, 0.04);
    border: 1px solid rgba(255, 255, 255, 0.08);
    border-radius: 0.75rem;
    text-decoration: none;
    transition: all 0.3s ease;
}
.repo-card:hover {
    background: rgba(255, 255, 255, 0.07);
    border-color: rgba(0, 212, 255, 0.2);
    transform: translateY(-2px);
}
</style>
@endsection
