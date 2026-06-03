<section id="about" class="section-container">
    <h2 class="section-title animate-on-scroll">About Me</h2>

    <div style="display: grid; grid-template-columns: 1fr; gap: 3rem; align-items: start;">
        <div>
            <div class="animate-on-scroll glass-card" style="padding: 1.5rem; max-width: 320px; margin-bottom: 2rem;">
                <div style="width: 100%; aspect-ratio: 1; border-radius: 0.75rem; background: linear-gradient(135deg, #00D4FF20, #0066FF20); display: flex; align-items: center; justify-content: center; overflow: hidden; border: 1px solid rgba(0, 212, 255, 0.15);">
                    @if (session('profile_photo'))
                        <img src="{{ Storage::url(session('profile_photo')) }}" alt="Profile Photo" style="width:100%;height:100%;object-fit:cover;">
                    @else
                        <div style="font-family: 'Syne', sans-serif; font-weight: 800; font-size: 3rem; color: #00D4FF40;">RA</div>
                    @endif
                </div>
            </div>

            <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                <div class="animate-on-scroll glass-card" style="padding: 1.5rem;">
                    <h3 style="font-family: 'Syne', sans-serif; font-weight: 600; font-size: 1.25rem; color: #F0F4FF; margin-bottom: 1rem;">Experience</h3>
                    <div style="position: relative; padding-left: 1.5rem;">
                        <div style="position: absolute; left: 0; top: 0; bottom: 0; width: 1px; background: rgba(255, 255, 255, 0.08);"></div>
                        @forelse ($experiences as $exp)
                            <div style="position: relative; padding-bottom: 1.5rem; {{ !$loop->last ? 'margin-bottom: 1.5rem;' : '' }}">
                                <div style="position: absolute; left: -1.5rem; top: 0.25rem; width: 10px; height: 10px; border-radius: 50%; background: #00D4FF; transform: translateX(-50%); border: 2px solid #080C14;"></div>
                                <p style="font-family: 'JetBrains Mono', monospace; font-size: 0.75rem; color: #00D4FF; margin-bottom: 0.25rem;">{{ $exp->period }}</p>
                                <h4 style="font-family: 'Syne', sans-serif; font-weight: 600; color: #F0F4FF;">{{ $exp->role }}</h4>
                                <p style="color: #4A5568; font-size: 0.875rem; margin-bottom: 0.5rem;">{{ $exp->company }}</p>
                                <p style="font-size: 0.875rem; color: #8B9CBD;">{{ $exp->description }}</p>
                            </div>
                        @empty
                            <p style="color: #4A5568; font-family: 'JetBrains Mono', monospace; font-size: 0.875rem;">No experience data yet.</p>
                        @endforelse
                    </div>
                </div>

                <div class="animate-on-scroll glass-card" style="padding: 1.5rem;">
                    <h3 style="font-family: 'Syne', sans-serif; font-weight: 600; font-size: 1.25rem; color: #F0F4FF; margin-bottom: 1rem;">Education</h3>
                    @forelse ($educations as $edu)
                        <div style="padding-left: 1.5rem; position: relative; {{ !$loop->last ? 'margin-bottom: 1.5rem;' : '' }}">
                            <div style="position: absolute; left: 0; top: 0.25rem; width: 10px; height: 10px; border-radius: 50%; background: rgba(0, 212, 255, 0.4); transform: translateX(-50%);"></div>
                            <p style="font-family: 'JetBrains Mono', monospace; font-size: 0.75rem; color: #00D4FF; margin-bottom: 0.25rem;">{{ $edu->period }}</p>
                            <h4 style="font-family: 'Syne', sans-serif; font-weight: 600; color: #F0F4FF;">{{ $edu->institution }}</h4>
                            <p style="color: #8B9CBD; font-size: 0.875rem;">{{ $edu->major }}</p>
                        </div>
                    @empty
                        <p style="color: #4A5568; font-family: 'JetBrains Mono', monospace; font-size: 0.875rem;">No education data yet.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</section>
