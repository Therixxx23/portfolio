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

            {{-- Common Fields (shown for all categories) --}}
            <div style="margin-bottom:1.25rem;">
                <label for="title" style="display:block;font-size:0.8rem;color:#8B9CBD;margin-bottom:0.4rem;">Title <span style="color:#FF4466;">*</span></label>
                <input type="text" id="title" name="title" class="form-input" value="{{ old('title', $project->title ?? '') }}" required>
            </div>

            <div style="margin-bottom:1.25rem;">
                <label for="description" style="display:block;font-size:0.8rem;color:#8B9CBD;margin-bottom:0.4rem;">Description</label>
                <textarea id="description" name="description" class="form-input" rows="4">{{ old('description', $project->description ?? '') }}</textarea>
            </div>

            <div style="margin-bottom:1.5rem;">
                <label for="category" style="display:block;font-size:0.8rem;color:#8B9CBD;margin-bottom:0.4rem;">Category <span style="color:#FF4466;">*</span></label>
                <select id="category" name="category" class="form-input" required onchange="toggleFields(this.value)">
                    <option value="unity" {{ (old('category', $project->category ?? '') == 'unity') ? 'selected' : '' }}>Unity Game</option>
                    <option value="web" {{ (old('category', $project->category ?? '') == 'web') ? 'selected' : '' }}>Web</option>
                    <option value="design" {{ (old('category', $project->category ?? '') == 'design') ? 'selected' : '' }}>Design</option>
                </select>
            </div>

            {{-- Unity Game Fields --}}
            <div class="game-fields" style="margin-bottom:1.25rem;">
                <div style="margin-bottom:1.25rem;">
                    <label for="external_link" style="display:block;font-size:0.8rem;color:#8B9CBD;margin-bottom:0.4rem;">External Link (itch.io / Demo URL)</label>
                    <input type="url" id="external_link" name="external_link" class="form-input" value="{{ old('external_link', $project->external_link ?? '') }}" placeholder="https://itch.io/...">
                </div>
                <div style="margin-bottom:1.25rem;">
                    <label for="link_label" style="display:block;font-size:0.8rem;color:#8B9CBD;margin-bottom:0.4rem;">Link Label</label>
                    <input type="text" id="link_label" name="link_label" class="form-input" value="{{ old('link_label', $project->link_label ?? '') }}" placeholder="Play on itch.io">
                </div>
            </div>

            {{-- Web Fields --}}
            <div class="web-fields" style="margin-bottom:1.25rem;">
                <div style="margin-bottom:1.25rem;">
                    <label for="demo_url" style="display:block;font-size:0.8rem;color:#8B9CBD;margin-bottom:0.4rem;">Demo URL</label>
                    <input type="url" id="demo_url" name="demo_url" class="form-input" value="{{ old('demo_url', $project->demo_url ?? '') }}" placeholder="https://">
                </div>
                <div style="margin-bottom:1.25rem;">
                    <label for="repo_url" style="display:block;font-size:0.8rem;color:#8B9CBD;margin-bottom:0.4rem;">Repo URL (GitHub)</label>
                    <input type="url" id="repo_url" name="repo_url" class="form-input" value="{{ old('repo_url', $project->repo_url ?? '') }}" placeholder="https://github.com/...">
                </div>
                <div style="margin-bottom:1.25rem;">
                    <label for="tech_stack" style="display:block;font-size:0.8rem;color:#8B9CBD;margin-bottom:0.4rem;">Tech Stack Tags</label>
                    <input type="text" id="tech_stack" name="tech_stack" class="form-input" value="{{ old('tech_stack', is_array($project->tech_stack ?? null) ? implode(', ', $project->tech_stack) : ($project->tech_stack ?? '') ) }}" placeholder="Laravel, Tailwind, JavaScript">
                    <p style="color:#4A5568;font-size:0.75rem;margin-top:0.3rem;">Comma-separated, e.g. Laravel, Tailwind, JavaScript</p>
                </div>
            </div>

            {{-- Design Fields --}}
            <div class="design-fields" style="margin-bottom:1.25rem;">
                <div style="margin-bottom:1.25rem;">
                    <label for="client_brand" style="display:block;font-size:0.8rem;color:#8B9CBD;margin-bottom:0.4rem;">Client / Brand Name</label>
                    <input type="text" id="client_brand" name="client_brand" class="form-input" value="{{ old('client_brand', $project->client_brand ?? '') }}" placeholder="e.g. Bandeng Presto Cianjur">
                </div>
                <div style="margin-bottom:1.25rem;">
                    <label for="instagram_link" style="display:block;font-size:0.8rem;color:#8B9CBD;margin-bottom:0.4rem;">Instagram Link</label>
                    <input type="url" id="instagram_link" name="instagram_link" class="form-input" value="{{ old('instagram_link', $project->instagram_link ?? '') }}" placeholder="https://instagram.com/p/...">
                    <p style="color:#4A5568;font-size:0.75rem;margin-top:0.3rem;">Optional link to the Instagram post.</p>
                </div>
                <div style="margin-bottom:1.25rem;">
                    <label style="display:block;font-size:0.8rem;color:#8B9CBD;margin-bottom:0.4rem;">Image Gallery (max 6 images)</label>
                    @if (isset($project) && is_array($project->image_gallery) && count($project->image_gallery) > 0)
                        <div style="display:flex;gap:0.5rem;flex-wrap:wrap;margin-bottom:0.75rem;">
                            @foreach ($project->image_gallery as $img)
                                <img src="{{ Storage::url($img) }}" alt="" style="width:80px;height:60px;object-fit:cover;border-radius:0.375rem;border:1px solid rgba(255,255,255,0.08);">
                            @endforeach
                        </div>
                    @endif
                    <input type="file" id="image_gallery" name="image_gallery[]" class="form-input" style="padding:0.5rem;" accept="image/*" multiple>
                    <p style="color:#4A5568;font-size:0.75rem;margin-top:0.3rem;">Upload up to 6 images for the design portfolio collage.</p>
                </div>
            </div>

            {{-- Thumbnail + Status (shown for all categories) --}}
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
                <label for="status" style="display:block;font-size:0.8rem;color:#8B9CBD;margin-bottom:0.4rem;">Status</label>
                <select id="status" name="status" class="form-input">
                    <option value="published" {{ (old('status', $project->status ?? 'published') == 'published') ? 'selected' : '' }}>Published</option>
                    <option value="draft" {{ (old('status', $project->status ?? 'published') == 'draft') ? 'selected' : '' }}>Draft</option>
                </select>
            </div>

            <div style="display:flex;gap:0.75rem;">
                <button type="submit" class="btn-primary">Save</button>
                <a href="{{ route('admin.projects') }}" class="btn-ghost">Cancel</a>
            </div>
        </form>
    </div>
</section>
@endsection

@push('scripts')
<script>
function toggleFields(category) {
    document.querySelectorAll('.game-fields, .web-fields, .design-fields').forEach(function(el) {
        el.style.display = 'none';
    });
    if (category === 'unity') {
        document.querySelector('.game-fields').style.display = 'block';
    } else if (category === 'web') {
        document.querySelector('.web-fields').style.display = 'block';
    } else if (category === 'design') {
        document.querySelector('.design-fields').style.display = 'block';
    }
}
document.addEventListener('DOMContentLoaded', function() {
    var cat = document.getElementById('category');
    if (cat) toggleFields(cat.value);
});
</script>
@endpush
