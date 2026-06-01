@extends('layouts.app')

@section('title', 'Connect — Rifqi Ariq')

@section('content')
<section class="section-container" style="padding-top: 8rem;">
    <div class="liquid-blob liquid-blob-1" style="background: linear-gradient(135deg, #00D4FF, #0066FF); top: 10%; right: -10%;"></div>
    <div class="liquid-blob liquid-blob-2" style="background: linear-gradient(135deg, #0066FF, #00FFB3); bottom: 20%; left: -10%;"></div>

    <div style="position: relative; z-index: 1;">
        <h1 class="section-title animate-on-scroll" style="margin-bottom: 1rem;">Let's Connect</h1>
        <p class="animate-on-scroll" style="color: #8B9CBD; margin-bottom: 3rem; max-width: 600px; transition-delay: 0.1s;">
            Have a project in mind or just want to say hi? Reach out through any of the channels below.
        </p>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 3rem; align-items: start;">
            <div class="animate-on-scroll" style="transition-delay: 0.15s;">
                <h3 style="font-family:'Syne',sans-serif;font-weight:600;color:#F0F4FF;margin-bottom:1.5rem;font-size:1.25rem;">Send a Message</h3>
                <form id="contactForm" style="display:flex;flex-direction:column;gap:1rem;">
                    <div>
                        <label for="name" style="display:block;font-size:0.8rem;color:#8B9CBD;margin-bottom:0.4rem;font-family:'DM Sans',sans-serif;">Name</label>
                        <input type="text" id="name" name="name" class="form-input" placeholder="Your name" required>
                    </div>
                    <div>
                        <label for="email" style="display:block;font-size:0.8rem;color:#8B9CBD;margin-bottom:0.4rem;font-family:'DM Sans',sans-serif;">Email</label>
                        <input type="email" id="email" name="email" class="form-input" placeholder="your@email.com" required>
                    </div>
                    <div>
                        <label for="message" style="display:block;font-size:0.8rem;color:#8B9CBD;margin-bottom:0.4rem;font-family:'DM Sans',sans-serif;">Message</label>
                        <textarea id="message" name="message" class="form-input" placeholder="Your message..." required></textarea>
                    </div>
                    <button type="submit" class="btn-primary" style="justify-content:center;width:100%;" id="submitBtn">
                        Send Message
                    </button>
                    <p id="formFeedback" style="display:none;font-size:0.875rem;text-align:center;padding:0.75rem;border-radius:0.5rem;"></p>
                </form>
            </div>

            <div class="animate-on-scroll" style="display:flex;flex-direction:column;gap:1.25rem;transition-delay:0.2s;">
                <h3 style="font-family:'Syne',sans-serif;font-weight:600;color:#F0F4FF;margin-bottom:0.5rem;font-size:1.25rem;">Social Links</h3>

                @php
                    $socials = [
                        ['name' => 'Instagram', 'url' => 'https://instagram.com/_rifqiariq', 'icon' => 'M7.8 2h8.4C19.4 2 22 4.6 22 7.8v8.4a5.8 5.8 0 0 1-5.8 5.8H7.8C4.6 22 2 19.4 2 16.2V7.8A5.8 5.8 0 0 1 7.8 2m-.2 5A3.3 3.3 0 0 0 4.5 10.3c0 1.7 1.3 3 3 3s3-1.3 3-3c0-.5-.1-.9-.3-1.3', 'color' => '#E1306C'],
                        ['name' => 'GitHub', 'url' => 'https://github.com/rifqiariq', 'icon' => 'M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22', 'color' => '#FFFFFF'],
                        ['name' => 'LinkedIn', 'url' => 'https://linkedin.com/in/rifqiariq', 'icon' => 'M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6zM2 9h4v12H2zM4 6a2 2 0 1 0 0-4 2 2 0 0 0 0 4z', 'color' => '#0077B5'],
                        ['name' => 'Email', 'url' => 'mailto:rifqiariq@example.com', 'icon' => 'M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z', 'color' => '#00D4FF'],
                    ];
                @endphp

                @foreach ($socials as $social)
                    <a href="{{ $social['url'] }}" target="_blank" rel="noopener" class="social-link" style="--social-color: {{ $social['color'] }};">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="{{ $social['icon'] }}"/>
                        </svg>
                        <span>{{ $social['name'] }}</span>
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-left:auto;opacity:0.4;"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</section>

<style>
.social-link {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem 1.25rem;
    background: rgba(255, 255, 255, 0.04);
    border: 1px solid rgba(255, 255, 255, 0.08);
    border-radius: 0.75rem;
    text-decoration: none;
    color: #F0F4FF;
    font-family: 'DM Sans', sans-serif;
    transition: all 0.3s ease;
}
.social-link:hover {
    background: rgba(255, 255, 255, 0.07);
    border-color: var(--social-color);
    box-shadow: 0 0 20px color-mix(in srgb, var(--social-color) 20%, transparent);
    transform: translateX(4px);
}
</style>

@push('scripts')
<script defer src="https://cdn.jsdelivr.net/npm/@emailjs/browser@4/dist/email.min.js"></script>
<script>
(function () {
    var serviceID = '{{ env("VITE_EMAILJS_SERVICE_ID") }}';
    var templateID = '{{ env("VITE_EMAILJS_TEMPLATE_ID") }}';
    var publicKey = '{{ env("VITE_EMAILJS_PUBLIC_KEY") }}';
    var contactEmail = '{{ env("CONTACT_EMAIL", "") }}';

    function initEmailJS() {
        if (typeof emailjs !== 'undefined') {
            emailjs.init(publicKey);
            return true;
        }
        return false;
    }

    document.addEventListener('DOMContentLoaded', function () {
        var form = document.getElementById('contactForm');
        var feedback = document.getElementById('formFeedback');
        var submitBtn = document.getElementById('submitBtn');

        if (!serviceID || !templateID || !publicKey) {
            form.addEventListener('submit', function (e) {
                e.preventDefault();
                feedback.textContent = 'EmailJS not configured. Check .env variables.';
                feedback.style.display = 'block';
                feedback.style.color = '#FF4466';
                feedback.style.background = 'rgba(255,68,102,0.1)';
            });
            return;
        }

        form.addEventListener('submit', function (e) {
            e.preventDefault();
            feedback.style.display = 'none';

            var name = document.getElementById('name').value.trim();
            var email = document.getElementById('email').value.trim();
            var message = document.getElementById('message').value.trim();

            if (!name || !email || !message) {
                feedback.textContent = 'Please fill in all fields.';
                feedback.style.display = 'block';
                feedback.style.color = '#FF4466';
                feedback.style.background = 'rgba(255,68,102,0.1)';
                return;
            }

            submitBtn.disabled = true;
            submitBtn.textContent = 'Sending...';

            var ready = initEmailJS();

            function doSend() {
                emailjs.send(serviceID, templateID, {
                    from_name: name,
                    from_email: email,
                    message: message,
                    to_email: contactEmail || email,
                }).then(function () {
                    feedback.textContent = 'Message sent successfully! I\'ll get back to you soon.';
                    feedback.style.display = 'block';
                    feedback.style.color = '#00FFB3';
                    feedback.style.background = 'rgba(0,255,179,0.1)';
                    form.reset();
                }).catch(function (err) {
                    feedback.textContent = 'Failed to send. Please try again or email me directly.';
                    feedback.style.display = 'block';
                    feedback.style.color = '#FF4466';
                    feedback.style.background = 'rgba(255,68,102,0.1)';
                }).finally(function () {
                    submitBtn.disabled = false;
                    submitBtn.textContent = 'Send Message';
                });
            }

            if (ready) {
                doSend();
            } else {
                var check = setInterval(function () {
                    if (initEmailJS()) {
                        clearInterval(check);
                        doSend();
                    }
                }, 200);
                setTimeout(function () {
                    clearInterval(check);
                    if (typeof emailjs === 'undefined') {
                        feedback.textContent = 'EmailJS SDK failed to load. Please refresh.';
                        feedback.style.display = 'block';
                        feedback.style.color = '#FF4466';
                        feedback.style.background = 'rgba(255,68,102,0.1)';
                        submitBtn.disabled = false;
                        submitBtn.textContent = 'Send Message';
                    }
                }, 8000);
            }
        });
    });
})();
</script>
@endpush
@endsection
