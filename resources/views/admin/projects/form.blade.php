@extends('layouts.app')

@section('title', isset($project) ? 'Edit Project' : 'Add Project')

@section('content')
<section class="section-container" style="padding-top: 8rem;">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:2rem;flex-wrap:wrap;gap:1rem;">
        <div>
            <h1 class="section-title" style="margin-bottom:0.25rem;">{{ isset($project) ? 'Edit Project' : 'Add Project' }}</h1>
            <p style="color:#8B9CBD;">{{ isset($project) ? 'Update the project details below.' : 'Fill in the details to add a new project.' }}</p>
        </div>
    </div>

    <div class="glass-card" style="padding:1.5rem;margin-bottom:2rem;">
        <div style="display:flex;gap:0.5rem;flex-wrap:wrap;">
            <a href="{{ route('admin.dashboard') }}" class="btn-ghost" style="font-size:0.8rem;padding:0.5rem 1rem;">Dashboard</a>
            <a href="{{ route('admin.educations') }}" class="btn-ghost" style="font-size:0.8rem;padding:0.5rem 1rem;">Education</a>
            <a href="{{ route('admin.projects') }}" class="btn-primary" style="font-size:0.8rem;padding:0.5rem 1rem;">Projects</a>
            <a href="{{ route('admin.games') }}" class="btn-ghost" style="font-size:0.8rem;padding:0.5rem 1rem;">Games</a>
        </div>
    </div>

    @if ($errors->any())
        <div style="padding:0.75rem 1rem;background:rgba(255,68,102,0.1);border:1px solid rgba(255,68,102,0.3);border-radius:0.5rem;margin-bottom:1.5rem;">
            <ul style="margin:0;padding-left:1.25rem;color:#FF4466;font-size:0.8rem;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="glass-card" style="padding:2rem;max-width:640px;">
        <form method="POST" action="{{ route('admin.projects.save', $project ?? '') }}" enctype="multipart/form-data">
            @csrf
            <div style="margin-bottom:1.25rem;">
                <label for="title" style="display:block;font-size:0.8rem;color:#8B9CBD;margin-bottom:0.4rem;">Title <span style="color:#FF4466;">*</span></label>
                <input type="text" id="title" name="title" class="form-input" value="{{ old('title', $project->title ?? '') }}" required>
            </div>
            <div style="margin-bottom:1.25rem;">
                <label for="description" style="display:block;font-size:0.8rem;color:#8B9CBD;margin-bottom:0.4rem;">Description</label>
                <textarea id="description" name="description" class="form-input">{{ old('description', $project->description ?? '') }}</textarea>
            </div>
            <div style="margin-bottom:1.25rem;">
                <label for="category" style="display:block;font-size:0.8rem;color:#8B9CBD;margin-bottom:0.4rem;">Category <span style="color:#FF4466;">*</span></label>
                <select id="category" name="category" class="form-input" required>
                    <option value="unity" {{ (old('category', $project->category ?? '') == 'unity') ? 'selected' : '' }}>Unity Game</option>
                    <option value="web" {{ (old('category', $project->category ?? '') == 'web') ? 'selected' : '' }}>Web</option>
                    <option value="design" {{ (old('category', $project->category ?? '') == 'design') ? 'selected' : '' }}>Design</option>
                </select>
            </div>
            <div style="margin-bottom:1.25rem;">
                <label for="tech_stack" style="display:block;font-size:0.8rem;color:#8B9CBD;margin-bottom:0.4rem;">Tech Stack</label>
                <input type="text" id="tech_stack" name="tech_stack" class="form-input" value="{{ old('tech_stack', is_array($project->tech_stack ?? null) ? implode(', ', $project->tech_stack) : ($project->tech_stack ?? '') ) }}" placeholder="Laravel, Tailwind, JavaScript">
                <p style="color:#4A5568;font-size:0.75rem;margin-top:0.3rem;">Comma-separated, e.g. Laravel, Tailwind, JavaScript</p>
            </div>
            <div style="margin-bottom:1.25rem;">
                <label for="demo_url" style="display:block;font-size:0.8rem;color:#8B9CBD;margin-bottom:0.4rem;">Demo URL</label>
                <input type="url" id="demo_url" name="demo_url" class="form-input" value="{{ old('demo_url', $project->demo_url ?? '') }}" placeholder="https://">
            </div>
            <div style="margin-bottom:1.25rem;">
                <label for="repo_url" style="display:block;font-size:0.8rem;color:#8B9CBD;margin-bottom:0.4rem;">Repository URL</label>
                <input type="url" id="repo_url" name="repo_url" class="form-input" value="{{ old('repo_url', $project->repo_url ?? '') }}" placeholder="https://">
            </div>
            <div style="margin-bottom:1.25rem;">
                <label for="external_link" style="display:block;font-size:0.8rem;color:#8B9CBD;margin-bottom:0.4rem;">External Link</label>
                <input type="url" id="external_link" name="external_link" class="form-input" value="{{ old('external_link', $project->external_link ?? '') }}" placeholder="https://instagram.com/p/...">
                <p style="color:#4A5568;font-size:0.75rem;margin-top:0.3rem;">Instagram post link or any external URL for design projects.</p>
            </div>
            <div style="margin-bottom:1.25rem;">
                <label for="link_label" style="display:block;font-size:0.8rem;color:#8B9CBD;margin-bottom:0.4rem;">Link Label</label>
                <input type="text" id="link_label" name="link_label" class="form-input" value="{{ old('link_label', $project->link_label ?? '') }}" placeholder="View on Instagram">
            </div>
            <div style="margin-bottom:1.25rem;">
                <label for="thumbnail" style="display:block;font-size:0.8rem;color:#8B9CBD;margin-bottom:0.4rem;">Thumbnail</label>
                @if (isset($project) && $project->thumbnail)
                    <div style="margin-bottom:0.75rem;">
                        <img src="{{ Storage::url($project->thumbnail) }}" alt="Current thumbnail" style="max-width:200px;max-height:120px;border-radius:0.5rem;border:1px solid rgba(255,255,255,0.08);">
                    </div>
                @endif
                <input type="file" id="thumbnail" name="thumbnail" class="form-input" style="padding:0.5rem;" accept="image/*">
            </div>
            <div style="margin-bottom:1.5rem;">
                <label for="image_gallery" style="display:block;font-size:0.8rem;color:#8B9CBD;margin-bottom:0.4rem;">Image Gallery (for Design projects)</label>
                @if (isset($project) && $project->image_gallery)
                    <div style="display:flex;gap:0.5rem;flex-wrap:wrap;margin-bottom:0.75rem;">
                        @foreach ($project->image_gallery as $img)
                            <img src="{{ Storage::url($img) }}" alt="" style="width:80px;height:60px;object-fit:cover;border-radius:0.375rem;border:1px solid rgba(255,255,255,0.08);">
                        @endforeach
                    </div>
                @endif
                <input type="file" id="image_gallery" name="image_gallery[]" class="form-input" style="padding:0.5rem;" accept="image/*" multiple>
                <p style="color:#4A5568;font-size:0.75rem;margin-top:0.3rem;">Upload multiple images for a collage/gallery. Works best with Design category.</p>
            </div>
            <div style="display:flex;gap:0.75rem;">
                <button type="submit" class="btn-primary">Save</button>
                <a href="{{ route('admin.projects') }}" class="btn-ghost">Cancel</a>
            </div>
        </form>
    </div>
</section>
@endsection
