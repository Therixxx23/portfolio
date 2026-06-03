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
                <label for="title" style="display:block;font-size:0.8rem;color:#8B9CBD;margin-bottom:0.4rem;">Title</label>
                <input type="text" id="title" name="title" class="form-input" value="{{ old('title', $game->title ?? '') }}" required>
                <p style="color:#4A5568;font-size:0.75rem;margin-top:0.3rem;">The game path will be auto-generated from the title.</p>
            </div>
            <div style="margin-bottom:1.25rem;">
                <label for="description" style="display:block;font-size:0.8rem;color:#8B9CBD;margin-bottom:0.4rem;">Description</label>
                <textarea id="description" name="description" class="form-input">{{ old('description', $game->description ?? '') }}</textarea>
            </div>
            <div style="margin-bottom:1.25rem;">
                <label for="category" style="display:block;font-size:0.8rem;color:#8B9CBD;margin-bottom:0.4rem;">Category</label>
                <input type="text" id="category" name="category" class="form-input" value="{{ old('category', $game->category ?? 'unity') }}" required>
            </div>
            <div style="margin-bottom:1.5rem;">
                <label for="thumbnail" style="display:block;font-size:0.8rem;color:#8B9CBD;margin-bottom:0.4rem;">Thumbnail</label>
                @if (isset($game) && $game->thumbnail)
                    <div style="margin-bottom:0.75rem;">
                        <img src="{{ Storage::url($game->thumbnail) }}" alt="Current thumbnail" style="max-width:200px;max-height:120px;border-radius:0.5rem;border:1px solid rgba(255,255,255,0.08);">
                    </div>
                @endif
                <input type="file" id="thumbnail" name="thumbnail" class="form-input" style="padding:0.5rem;" accept="image/*">
            </div>
            <div style="display:flex;gap:0.75rem;">
                <button type="submit" class="btn-primary">Save</button>
                <a href="{{ route('admin.games') }}" class="btn-ghost">Cancel</a>
            </div>
        </form>
    </div>
</section>
@endsection
