@extends('layouts.app')

@section('title', 'Skills — Rifqi Ariq')

@section('content')
<section class="section-container" style="padding-top: 8rem;">
    <h1 class="section-title animate-on-scroll" style="margin-bottom: 1rem;">Skills & Tools</h1>
    <p class="animate-on-scroll" style="color: #8B9CBD; margin-bottom: 4rem; max-width: 600px; transition-delay: 0.1s;">
        Technologies and tools I work with across game development, frontend engineering, and design.
    </p>

    @php
        $skillCategories = [
            'frontend' => [
                'label' => 'Frontend',
                'items' => [
                    ['name' => 'Laravel', 'icon' => 'laravel', 'color' => '#FF2D20'],
                    ['name' => 'HTML5', 'icon' => 'html5', 'color' => '#E34F26'],
                    ['name' => 'CSS3', 'icon' => 'css3', 'color' => '#1572B6'],
                    ['name' => 'JavaScript', 'icon' => 'javascript', 'color' => '#F7DF1E'],
                    ['name' => 'PHP', 'icon' => 'php', 'color' => '#777BB4'],
                    ['name' => 'Tailwind CSS', 'icon' => 'tailwindcss', 'color' => '#06B6D4'],
                ]
            ],
            'gamedev' => [
                'label' => 'Game Dev',
                'items' => [
                    ['name' => 'Unity', 'icon' => 'unity', 'color' => '#FFFFFF'],
                    ['name' => 'C#', 'icon' => 'csharp', 'color' => '#239120'],
                ]
            ],
            'design' => [
                'label' => 'Design',
                'items' => [
                    ['name' => 'Canva', 'icon' => 'canva', 'color' => '#00C4CC'],
                    ['name' => 'Figma', 'icon' => 'figma', 'color' => '#F24E1E'],
                ]
            ]
        ];
    @endphp

    @foreach ($skillCategories as $key => $category)
        <div style="margin-bottom: 4rem;">
            <h2 class="animate-on-scroll" style="font-family: 'Syne', sans-serif; font-weight: 600; font-size: 1.25rem; color: #F0F4FF; margin-bottom: 1.5rem;">
                {{ $category['label'] }}
            </h2>
            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(120px, 1fr)); gap: 1rem;">
                @foreach ($category['items'] as $skill)
                    <div class="animate-on-scroll tech-badge" style="transition-delay: {{ $loop->index * 0.05 }}s;">
                        <div style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                            <img
                                src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/{{ $skill['icon'] }}/{{ $skill['icon'] }}-original.svg"
                                alt="{{ $skill['name'] }}"
                                style="width: 36px; height: 36px; object-fit: contain; filter: drop-shadow(0 0 8px rgba(255,255,255,0.1)); transition: filter 0.3s ease;"
                                loading="lazy"
                                onerror="this.parentElement.innerHTML='<span style=\'font-size:1.5rem;font-weight:700;color:{{ $skill['color'] }}\'>{{ substr($skill['name'], 0, 2) }}</span>'"
                            >
                        </div>
                        <span style="font-family: 'JetBrains Mono', monospace; font-size: 0.75rem; color: #8B9CBD; letter-spacing: 0.05em; text-align: center;">{{ $skill['name'] }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach
</section>

<style>
.tech-badge {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.5rem;
    padding: 1.25rem;
    background: rgba(255, 255, 255, 0.04);
    border: 1px solid rgba(255, 255, 255, 0.08);
    border-radius: 0.75rem;
    transition: all 0.3s ease;
    cursor: default;
}
.tech-badge:hover {
    background: rgba(255, 255, 255, 0.07);
    border-color: rgba(0, 212, 255, 0.25);
    transform: translateY(-4px);
    box-shadow: 0 12px 32px rgba(0, 0, 0, 0.3), 0 0 0 1px rgba(255, 255, 255, 0.08);
}
.tech-badge:hover img {
    filter: drop-shadow(0 0 12px #00D4FF26);
}
</style>
@endsection
