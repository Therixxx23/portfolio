@extends('layouts.app')

@section('title', 'Admin Login')

@section('content')
<section style="min-height:100vh;display:flex;align-items:center;justify-content:center;padding:2rem;">
    <div class="glass-card" style="padding:2.5rem;width:100%;max-width:400px;">
        <h1 style="font-family:'Syne',sans-serif;font-weight:700;font-size:1.5rem;color:#F0F4FF;margin-bottom:0.5rem;">Admin Login</h1>
        <p style="color:#8B9CBD;font-size:0.875rem;margin-bottom:2rem;">Enter your credentials to continue.</p>

        @if ($errors->any())
            <div style="padding:0.75rem;background:rgba(255,68,102,0.1);border:1px solid rgba(255,68,102,0.3);border-radius:0.5rem;margin-bottom:1.5rem;">
                <p style="color:#FF4466;font-size:0.8rem;">{{ $errors->first() }}</p>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.login.post') }}">
            @csrf
            <div style="margin-bottom:1rem;">
                <label for="username" style="display:block;font-size:0.8rem;color:#8B9CBD;margin-bottom:0.4rem;">Username</label>
                <input type="text" id="username" name="username" class="form-input" placeholder="admin" required autocomplete="username">
            </div>
            <div style="margin-bottom:1.5rem;">
                <label for="password" style="display:block;font-size:0.8rem;color:#8B9CBD;margin-bottom:0.4rem;">Password</label>
                <input type="password" id="password" name="password" class="form-input" placeholder="••••••••" required autocomplete="current-password">
            </div>
            <button type="submit" class="btn-primary" style="justify-content:center;width:100%;">Sign In</button>
        </form>
    </div>
</section>
@endsection
