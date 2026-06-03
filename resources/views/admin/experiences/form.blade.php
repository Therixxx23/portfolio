@extends('layouts.app')

@section('title', isset($experience) ? 'Edit Experience' : 'Add Experience')

@section('content')
<section class="section-container" style="padding-top: 8rem;">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:2rem;flex-wrap:wrap;gap:1rem;">
        <div>
            <h1 class="section-title" style="margin-bottom:0.25rem;">{{ isset($experience) ? 'Edit Experience' : 'Add Experience' }}</h1>
            <p style="color:#8B9CBD;">{{ isset($experience) ? 'Update this work experience entry.' : 'Add a new work experience to your timeline.' }}</p>
        </div>
    </div>

    <div class="glass-card" style="padding:1.25rem;margin-bottom:2.5rem;">
        <div style="display:flex;flex-wrap:wrap;gap:0.75rem;justify-content:center;">
            <a href="{{ route('admin.dashboard') }}" class="nav-link" style="padding:0.6rem 1.25rem;border-radius:0.5rem;text-decoration:none;font-size:0.85rem;font-weight:400;color:#8B9CBD;border:1px solid transparent;transition:all 0.2s;" onmouseover="this.style.borderColor='rgba(255,255,255,0.15)';this.style.color='#F0F4FF'" onmouseout="this.style.borderColor='transparent';this.style.color='#8B9CBD'">Dashboard</a>
            <a href="{{ route('admin.profile') }}" class="nav-link" style="padding:0.6rem 1.25rem;border-radius:0.5rem;text-decoration:none;font-size:0.85rem;font-weight:400;color:#8B9CBD;border:1px solid transparent;transition:all 0.2s;" onmouseover="this.style.borderColor='rgba(255,255,255,0.15)';this.style.color='#F0F4FF'" onmouseout="this.style.borderColor='transparent';this.style.color='#8B9CBD'">Profile</a>
            <a href="{{ route('admin.experiences') }}" class="nav-link" style="background:rgba(0,212,255,0.1);border:1px solid rgba(0,212,255,0.3);color:#00D4FF;padding:0.6rem 1.25rem;border-radius:0.5rem;text-decoration:none;font-size:0.85rem;font-weight:500;">Experience</a>
            <a href="{{ route('admin.educations') }}" class="nav-link" style="padding:0.6rem 1.25rem;border-radius:0.5rem;text-decoration:none;font-size:0.85rem;font-weight:400;color:#8B9CBD;border:1px solid transparent;transition:all 0.2s;" onmouseover="this.style.borderColor='rgba(255,255,255,0.15)';this.style.color='#F0F4FF'" onmouseout="this.style.borderColor='transparent';this.style.color='#8B9CBD'">Education</a>
            <a href="{{ route('admin.projects') }}" class="nav-link" style="padding:0.6rem 1.25rem;border-radius:0.5rem;text-decoration:none;font-size:0.85rem;font-weight:400;color:#8B9CBD;border:1px solid transparent;transition:all 0.2s;" onmouseover="this.style.borderColor='rgba(255,255,255,0.15)';this.style.color='#F0F4FF'" onmouseout="this.style.borderColor='transparent';this.style.color='#8B9CBD'">Projects</a>
            <a href="{{ route('admin.games') }}" class="nav-link" style="padding:0.6rem 1.25rem;border-radius:0.5rem;text-decoration:none;font-size:0.85rem;font-weight:400;color:#8B9CBD;border:1px solid transparent;transition:all 0.2s;" onmouseover="this.style.borderColor='rgba(255,255,255,0.15)';this.style.color='#F0F4FF'" onmouseout="this.style.borderColor='transparent';this.style.color='#8B9CBD'">Games</a>
        </div>
    </div>

    <div class="glass-card" style="padding:2rem;max-width:640px;">
        <form method="POST" action="{{ route('admin.experiences.save', $experience ?? '') }}">
            @csrf

            <div style="margin-bottom:1.25rem;">
                <label for="company" style="display:block;font-size:0.8rem;color:#8B9CBD;margin-bottom:0.4rem;">Company</label>
                <input type="text" id="company" name="company" class="form-input" placeholder="e.g. Acme Corp" value="{{ old('company', $experience->company ?? '') }}" required>
                @error('company') <p style="color:#FF4466;font-size:0.75rem;margin-top:0.3rem;">{{ $message }}</p> @enderror
            </div>

            <div style="margin-bottom:1.25rem;">
                <label for="role" style="display:block;font-size:0.8rem;color:#8B9CBD;margin-bottom:0.4rem;">Role</label>
                <input type="text" id="role" name="role" class="form-input" placeholder="e.g. Game Developer" value="{{ old('role', $experience->role ?? '') }}" required>
                @error('role') <p style="color:#FF4466;font-size:0.75rem;margin-top:0.3rem;">{{ $message }}</p> @enderror
            </div>

            <div style="margin-bottom:1.25rem;">
                <label for="period" style="display:block;font-size:0.8rem;color:#8B9CBD;margin-bottom:0.4rem;">Period</label>
                <input type="text" id="period" name="period" class="form-input" placeholder="e.g. 2020 – 2021" value="{{ old('period', $experience->period ?? '') }}" required>
                @error('period') <p style="color:#FF4466;font-size:0.75rem;margin-top:0.3rem;">{{ $message }}</p> @enderror
            </div>

            <div style="margin-bottom:1.5rem;">
                <label for="description" style="display:block;font-size:0.8rem;color:#8B9CBD;margin-bottom:0.4rem;">Description <span style="color:#4A5568;">(optional)</span></label>
                <textarea id="description" name="description" class="form-input" placeholder="Brief description of your responsibilities and achievements...">{{ old('description', $experience->description ?? '') }}</textarea>
                @error('description') <p style="color:#FF4466;font-size:0.75rem;margin-top:0.3rem;">{{ $message }}</p> @enderror
            </div>

            <div style="display:flex;gap:0.75rem;flex-wrap:wrap;">
                <button type="submit" class="btn-primary" style="cursor:pointer;">{{ isset($experience) ? 'Update Experience' : 'Save Experience' }}</button>
                <a href="{{ route('admin.experiences') }}" class="btn-ghost" style="text-decoration:none;">Cancel</a>
            </div>
        </form>
    </div>
</section>
@endsection
