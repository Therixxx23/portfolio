@extends('layouts.app')

@section('title', isset($game) ? 'Edit Game' : 'Add Game')

@section('content')
<section class="section-container" style="padding-top: 8rem;">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:2rem;flex-wrap:wrap;gap:1rem;">
        <div>
            <h1 class="section-title" style="margin-bottom:0.25rem;">{{ isset($game) ? 'Edit Game' : 'Add Game' }}</h1>
            <p style="color:#8B9CBD;">{{ isset($game) ? 'Update the game details below.' : 'Fill in the details to add a new game.' }}</p>
        </div>
    </div>

    <div class="glass-card" style="padding:1.5rem;margin-bottom:2rem;">
        <div style="display:flex;gap:0.5rem;flex-wrap:wrap;">
            <a href="{{ route('admin.dashboard') }}" class="btn-ghost" style="font-size:0.8rem;padding:0.5rem 1rem;">Dashboard</a>
            <a href="{{ route('admin.educations') }}" class="btn-ghost" style="font-size:0.8rem;padding:0.5rem 1rem;">Education</a>
            <a href="{{ route('admin.projects') }}" class="btn-ghost" style="font-size:0.8rem;padding:0.5rem 1rem;">Projects</a>
            <a href="{{ route('admin.games') }}" class="btn-primary" style="font-size:0.8rem;padding:0.5rem 1rem;">Games</a>
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
        <form method="POST" action="{{ route('admin.games.save', $game ?? '') }}" enctype="multipart/form-data">
            @csrf
            <div style="margin-bottom:1.25rem;">
                <label for="title" style="display:block;font-size:0.8rem;color:#8B9CBD;margin-bottom:0.4rem;">Title <span style="color:#FF4466;">*</span></label>
                <input type="text" id="title" name="title" class="form-input" value="{{ old('title', $game->title ?? '') }}" required>
            </div>

            <div style="margin-bottom:1.25rem;">
                <label for="slug" style="display:block;font-size:0.8rem;color:#8B9CBD;margin-bottom:0.4rem;">Slug</label>
                <input type="text" id="slug" name="slug" class="form-input" value="{{ old('slug', $game->slug ?? '') }}" placeholder="Auto-generated from title if empty">
                <p style="color:#4A5568;font-size:0.75rem;margin-top:0.3rem;">URL-friendly name. Leave empty to auto-generate from title.</p>
            </div>

            <div style="margin-bottom:1.25rem;">
                <label for="description" style="display:block;font-size:0.8rem;color:#8B9CBD;margin-bottom:0.4rem;">Description</label>
                <textarea id="description" name="description" class="form-input" rows="3">{{ old('description', $game->description ?? '') }}</textarea>
            </div>

            <div style="margin-bottom:1.25rem;">
                <label for="category" style="display:block;font-size:0.8rem;color:#8B9CBD;margin-bottom:0.4rem;">Category <span style="color:#FF4466;">*</span></label>
                <select id="category" name="category" class="form-input" required>
                    <option value="unity" {{ (old('category', $game->category ?? '') == 'unity') ? 'selected' : '' }}>Unity</option>
                    <option value="web" {{ (old('category', $game->category ?? '') == 'web') ? 'selected' : '' }}>Web</option>
                    <option value="godot" {{ (old('category', $game->category ?? '') == 'godot') ? 'selected' : '' }}>Godot</option>
                    <option value="other" {{ (old('category', $game->category ?? '') == 'other') ? 'selected' : '' }}>Other</option>
                </select>
            </div>

            <div style="margin-bottom:1.25rem;">
                <label for="status" style="display:block;font-size:0.8rem;color:#8B9CBD;margin-bottom:0.4rem;">Status</label>
                <select id="status" name="status" class="form-input">
                    <option value="published" {{ (old('status', $game->status ?? '') == 'published') ? 'selected' : '' }}>Published</option>
                    <option value="draft" {{ (old('status', $game->status ?? '') == 'draft') ? 'selected' : '' }}>Draft</option>
                </select>
            </div>

            <div style="margin-bottom:1.25rem;">
                <label for="thumbnail" style="display:block;font-size:0.8rem;color:#8B9CBD;margin-bottom:0.4rem;">Thumbnail Image</label>
                @if (isset($game) && $game->thumbnail)
                    <div style="margin-bottom:0.75rem;">
                        <img src="{{ Storage::url($game->thumbnail) }}" alt="Current thumbnail" style="max-width:200px;max-height:120px;border-radius:0.5rem;border:1px solid rgba(255,255,255,0.08);">
                    </div>
                @endif
                <input type="file" id="thumbnail" name="thumbnail" class="form-input" style="padding:0.5rem;" accept="image/*">
            </div>

            <div style="margin-bottom:1.5rem;">
                <label for="build_zip" style="display:block;font-size:0.8rem;color:#8B9CBD;margin-bottom:0.4rem;">Unity WebGL Build (ZIP)</label>
                @if (isset($game))
                    <p style="color:#8B9CBD;font-size:0.8rem;margin-bottom:0.5rem;">Current path: <span style="font-family:'JetBrains Mono',monospace;color:#4A5568;">{{ $game->path }}</span></p>
                @endif
                <input type="file" id="build_zip" name="build_zip" class="form-input" style="padding:0.5rem;" accept=".zip">
                <p style="color:#4A5568;font-size:0.75rem;margin-top:0.3rem;">Upload a ZIP file containing your Unity WebGL build. Must include <span style="font-family:'JetBrains Mono',monospace;">index.html</span> at the root. Max 50MB.</p>
            </div>

            <div style="display:flex;gap:0.75rem;">
                <button type="submit" class="btn-primary" style="cursor:pointer;">Save</button>
                <a href="{{ route('admin.games') }}" class="btn-ghost">Cancel</a>
            </div>
        </form>
    </div>
</section>
@endsection
