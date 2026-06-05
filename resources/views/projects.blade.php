@extends('layouts.app')

@section('title', 'Projects — Rifqi Ariq')

@section('content')
<section class="section-container" style="padding-top: 8rem;">
    <h1 class="section-title animate-on-scroll" style="margin-bottom: 1rem;">Projects</h1>
    <p class="animate-on-scroll" style="color: #8B9CBD; margin-bottom: 2rem; max-width: 600px; transition-delay: 0.1s;">
        Selected works spanning game development, web applications, and design.
    </p>

    <div class="animate-on-scroll" style="display: flex; gap: 0.75rem; margin-bottom: 3rem; flex-wrap: wrap; transition-delay: 0.15s;">
        <button class="filter-btn active" data-filter="all" style="background: #00D4FF; color: #080C14; border: none; padding: 0.5rem 1.25rem; border-radius: 2rem; font-family: 'DM Sans', sans-serif; font-size: 0.875rem; font-weight: 500; cursor: pointer; transition: all 0.3s ease;">All</button>
        <button class="filter-btn" data-filter="unity" style="background: rgba(255,255,255,0.04); color: #8B9CBD; border: 1px solid rgba(255,255,255,0.08); padding: 0.5rem 1.25rem; border-radius: 2rem; font-family: 'DM Sans', sans-serif; font-size: 0.875rem; cursor: pointer; transition: all 0.3s ease;">Unity Game</button>
        <button class="filter-btn" data-filter="web" style="background: rgba(255,255,255,0.04); color: #8B9CBD; border: 1px solid rgba(255,255,255,0.08); padding: 0.5rem 1.25rem; border-radius: 2rem; font-family: 'DM Sans', sans-serif; font-size: 0.875rem; cursor: pointer; transition: all 0.3s ease;">Web</button>
        <button class="filter-btn" data-filter="design" style="background: rgba(255,255,255,0.04); color: #8B9CBD; border: 1px solid rgba(255,255,255,0.08); padding: 0.5rem 1.25rem; border-radius: 2rem; font-family: 'DM Sans', sans-serif; font-size: 0.875rem; cursor: pointer; transition: all 0.3s ease;">Design</button>
    </div>

    <div id="projectGrid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(340px, 1fr)); gap: 1.5rem;">
        @forelse ($projects as $project)
            <div class="project-card" data-category="{{ $project->category }}" onclick="openModal('modal-{{ $project->id }}')" style="cursor:pointer;">
                <div class="project-card-image">
                    @if ($project->category === 'design' && $project->image_gallery)
                        <div style="display:grid;grid-template-columns:1fr 1fr;grid-template-rows:1fr 1fr;height:100%;gap:2px;">
                            @foreach (array_slice($project->image_gallery, 0, 4) as $i => $img)
                                <div style="overflow:hidden;{{ $i === 0 ? 'grid-row:span 2;' : '' }}">
                                    <img src="{{ Storage::url($img) }}" alt="" style="width:100%;height:100%;object-fit:cover;">
                                </div>
                            @endforeach
                        </div>
                    @elseif ($project->thumbnail)
                        <img src="{{ Storage::url($project->thumbnail) }}" alt="{{ $project->title }}" style="width:100%;height:100%;object-fit:cover;">
                    @else
                        <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;background:linear-gradient(135deg,#00D4FF10,#0066FF10);">
                            <span style="font-family:'Syne',sans-serif;font-weight:800;font-size:2rem;color:#00D4FF30;">{{ substr($project->title, 0, 2) }}</span>
                        </div>
                    @endif
                </div>
                <div style="padding: 1.5rem;">
                    <h3 style="font-family:'Syne',sans-serif;font-weight:600;font-size:1.25rem;color:#F0F4FF;margin-bottom:0.5rem;">{{ $project->title }}</h3>
                    <p style="font-size:0.875rem;color:#8B9CBD;margin-bottom:1rem;">{{ $project->description }}</p>
                    @if ($project->tech_stack)
                        <div style="display:flex;flex-wrap:wrap;gap:0.5rem;margin-bottom:1rem;">
                            @foreach ($project->tech_stack as $tag)
                                <span style="font-family:'JetBrains Mono',monospace;font-size:0.7rem;padding:0.25rem 0.6rem;background:rgba(255,255,255,0.04);border:1px solid rgba(255,255,255,0.08);border-radius:0.25rem;color:#8B9CBD;">{{ $tag }}</span>
                            @endforeach
                        </div>
                    @endif
                    <div style="display:flex;gap:0.75rem;">
                        @if ($project->category === 'design')
                            @if ($project->external_link)
                                <a href="{{ $project->external_link }}" target="_blank" class="btn-primary" style="font-size:0.8rem;padding:0.5rem 1rem;">{{ $project->link_label ?? 'View' }}</a>
                            @endif
                            <span class="btn-ghost" style="font-size:0.8rem;padding:0.5rem 1rem;cursor:pointer;" onclick="event.stopPropagation();openModal('modal-{{ $project->id }}')">Gallery</span>
                        @else
                            @if ($project->demo_url)
                                <a href="{{ $project->demo_url }}" class="btn-primary" style="font-size:0.8rem;padding:0.5rem 1rem;">Demo</a>
                            @endif
                            @if ($project->repo_url)
                                <a href="{{ $project->repo_url }}" class="btn-ghost" style="font-size:0.8rem;padding:0.5rem 1rem;">Repo</a>
                            @endif
                        @endif
                    </div>
                </div>
            </div>

            @if ($project->category === 'design')
            <div id="modal-{{ $project->id }}" class="modal-overlay" onclick="closeModal('modal-{{ $project->id }}')" style="display:none;position:fixed;inset:0;z-index:200;background:rgba(8,12,20,0.9);backdrop-filter:blur(16px);padding:2rem;overflow-y:auto;">
                <div onclick="event.stopPropagation()" style="max-width:800px;margin:auto;margin-top:5vh;">
                    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:1.5rem;">
                        <h2 style="font-family:'Syne',sans-serif;font-weight:600;color:#F0F4FF;">{{ $project->title }}</h2>
                        <button onclick="closeModal('modal-{{ $project->id }}')" style="background:none;border:none;color:#8B9CBD;font-size:1.5rem;cursor:pointer;padding:0.5rem;">&times;</button>
                    </div>
                    @if ($project->image_gallery)
                        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(300px,1fr));gap:1rem;margin-bottom:1.5rem;">
                            @foreach ($project->image_gallery as $img)
                                <img src="{{ Storage::url($img) }}" alt="" style="width:100%;border-radius:0.5rem;border:1px solid rgba(255,255,255,0.08);">
                            @endforeach
                        </div>
                    @endif
                    <p style="color:#8B9CBD;margin-bottom:1.5rem;">{{ $project->description }}</p>
                    @if ($project->external_link)
                        <a href="{{ $project->external_link }}" target="_blank" class="btn-primary" style="display:inline-flex;font-size:0.875rem;padding:0.75rem 1.5rem;">{{ $project->link_label ?? 'View on Instagram' }}</a>
                    @endif
                </div>
            </div>
            @endif
        @empty
            <div class="glass-card" style="padding:3rem;text-align:center;grid-column:1/-1;">
                <p style="color:#4A5568;font-family:'JetBrains Mono',monospace;">No projects yet.</p>
            </div>
        @endforelse
    </div>
</section>

<style>
.project-card {
    background: rgba(255, 255, 255, 0.04);
    border: 1px solid rgba(255, 255, 255, 0.08);
    border-radius: 1rem;
    overflow: hidden;
    transition: all 0.4s cubic-bezier(0.23, 1, 0.32, 1);
}
.project-card:hover {
    transform: translateY(-6px);
    border-color: rgba(0, 212, 255, 0.2);
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.4), 0 0 40px rgba(0, 212, 255, 0.05);
}
.project-card-image {
    width: 100%;
    aspect-ratio: 16/9;
    object-fit: cover;
    filter: brightness(0.8) saturate(0.9);
    transition: filter 0.4s ease;
}
.project-card:hover .project-card-image {
    filter: brightness(0.9) saturate(1.1);
}
</style>

@push('scripts')
<script>
function openModal(id) {
    document.getElementById(id).style.display = 'block';
    document.body.style.overflow = 'hidden';
}
function closeModal(id) {
    document.getElementById(id).style.display = 'none';
    document.body.style.overflow = '';
}
document.addEventListener('DOMContentLoaded', function () {
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            document.querySelectorAll('.modal-overlay').forEach(function (m) {
                m.style.display = 'none';
            });
            document.body.style.overflow = '';
        }
    });

    const buttons = document.querySelectorAll('.filter-btn');
    const cards = document.querySelectorAll('.project-card');

    buttons.forEach(function (btn) {
        btn.addEventListener('click', function () {
            buttons.forEach(function (b) {
                b.style.background = 'rgba(255,255,255,0.04)';
                b.style.color = '#8B9CBD';
                b.style.borderColor = 'rgba(255,255,255,0.08)';
            });
            this.style.background = '#00D4FF';
            this.style.color = '#080C14';
            this.style.borderColor = '#00D4FF';

            var filter = this.getAttribute('data-filter');
            cards.forEach(function (card) {
                var cat = card.getAttribute('data-category');
                if (filter === 'all' || cat === filter) {
                    card.style.display = '';
                    card.style.opacity = '0';
                    setTimeout(function () { card.style.opacity = '1'; }, 50);
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });
});
</script>
@endpush
@endsection
