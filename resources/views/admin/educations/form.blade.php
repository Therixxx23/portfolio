@extends('layouts.app')

@section('title', isset($education) ? 'Edit Education' : 'Add Education')

@section('content')
<section class="section-container" style="padding-top: 8rem;">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:2rem;flex-wrap:wrap;gap:1rem;">
        <div>
            <h1 class="section-title" style="margin-bottom:0.25rem;">{{ isset($education) ? 'Edit Education' : 'Add Education' }}</h1>
            <p style="color:#8B9CBD;">{{ isset($education) ? 'Update the education entry below.' : 'Fill in the details to add a new education entry.' }}</p>
        </div>
    </div>

    <div class="glass-card" style="padding:1.5rem;margin-bottom:2rem;">
        <div style="display:flex;gap:0.5rem;flex-wrap:wrap;">
            <a href="{{ route('admin.dashboard') }}" class="btn-ghost" style="font-size:0.8rem;padding:0.5rem 1rem;">Dashboard</a>
            <a href="{{ route('admin.profile') }}" class="btn-ghost" style="font-size:0.8rem;padding:0.5rem 1rem;">Profile</a>
            <a href="{{ route('admin.experiences') }}" class="btn-ghost" style="font-size:0.8rem;padding:0.5rem 1rem;">Experience</a>
            <a href="{{ route('admin.educations') }}" class="btn-primary" style="font-size:0.8rem;padding:0.5rem 1rem;">Education</a>
            <a href="{{ route('admin.projects') }}" class="btn-ghost" style="font-size:0.8rem;padding:0.5rem 1rem;">Projects</a>
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
        <form method="POST" action="{{ route('admin.educations.save', $education ?? '') }}">
            @csrf
            <div style="margin-bottom:1.25rem;">
                <label for="institution" style="display:block;font-size:0.8rem;color:#8B9CBD;margin-bottom:0.4rem;">Institution</label>
                <input type="text" id="institution" name="institution" class="form-input" value="{{ old('institution', $education->institution ?? '') }}" required>
            </div>
            <div style="margin-bottom:1.25rem;">
                <label for="major" style="display:block;font-size:0.8rem;color:#8B9CBD;margin-bottom:0.4rem;">Major</label>
                <input type="text" id="major" name="major" class="form-input" value="{{ old('major', $education->major ?? '') }}" required>
            </div>
            <div style="margin-bottom:1.5rem;">
                <label for="period" style="display:block;font-size:0.8rem;color:#8B9CBD;margin-bottom:0.4rem;">Period</label>
                <input type="text" id="period" name="period" class="form-input" value="{{ old('period', $education->period ?? '') }}" required placeholder="e.g. 2018 – 2022">
            </div>
            <div style="display:flex;gap:0.75rem;">
                <button type="submit" class="btn-primary">Save</button>
                <a href="{{ route('admin.educations') }}" class="btn-ghost">Cancel</a>
            </div>
        </form>
    </div>
</section>
@endsection
