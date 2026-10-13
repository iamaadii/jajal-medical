@extends('layouts.app')

@section('title', 'Sign In')

@section('content')
<div style="max-width: 460px; margin: 3.5rem auto 2rem; animation: scaleIn 0.4s cubic-bezier(0.16, 1, 0.3, 1);">
    <div class="card" style="padding: 2.75rem 2.25rem; border-radius: 20px; box-shadow: var(--shadow-lg); border: 1px solid #e2e8f0;">
        <div style="text-align: center; margin-bottom: 2.25rem;">
            <div style="width: 54px; height: 54px; background: linear-gradient(135deg, #0284c7 0%, #2563eb 100%); color: white; border-radius: 14px; display: inline-flex; align-items: center; justify-content: center; font-size: 1.75rem; font-weight: 800; box-shadow: 0 8px 16px rgba(2, 132, 199, 0.3); margin-bottom: 1rem; animation: pulseGlow 2.5s infinite;">+</div>
            <h1 style="font-size: 1.55rem; font-weight: 800; color: #0f172a; letter-spacing: -0.02em;">Welcome Back</h1>
            <p style="color: #64748b; font-size: 0.9rem; margin-top: 0.4rem;">Sign in to Medical Implant Case Management</p>
        </div>

        <form method="POST" action="{{ route('login.perform') }}">
            @csrf

            <div style="margin-bottom: 1.35rem;">
                <label for="email" style="display: block; font-size: 0.85rem; font-weight: 700; color: #334155; margin-bottom: 0.45rem;">Work Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="name@jajalmedical.com"
                    class="input-control {{ $errors->has('email') ? 'input-error' : '' }}">
                @error('email')
                    <p style="color: #ef4444; font-size: 0.825rem; margin-top: 0.4rem; font-weight: 600; display: flex; align-items: center; gap: 0.3rem;">
                        <span>⚠</span> {{ $message }}
                    </p>
                @enderror
            </div>

            <div style="margin-bottom: 1.5rem;">
                <label for="password" style="display: block; font-size: 0.85rem; font-weight: 700; color: #334155; margin-bottom: 0.45rem;">Password</label>
                <input id="password" type="password" name="password" required placeholder="••••••••"
                    class="input-control {{ $errors->has('password') ? 'input-error' : '' }}">
                @error('password')
                    <p style="color: #ef4444; font-size: 0.825rem; margin-top: 0.4rem; font-weight: 600; display: flex; align-items: center; gap: 0.3rem;">
                        <span>⚠</span> {{ $message }}
                    </p>
                @enderror
            </div>

            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.75rem;">
                <label style="display: flex; align-items: center; gap: 0.55rem; font-size: 0.875rem; color: #475569; cursor: pointer; user-select: none;">
                    <input type="checkbox" name="remember" value="1" style="width: 16px; height: 16px; accent-color: var(--primary); cursor: pointer;">
                    <span>Keep me signed in</span>
                </label>
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%; padding: 0.85rem; font-size: 0.975rem; border-radius: var(--radius-sm); letter-spacing: 0.01em;">
                Sign in to Dashboard &rarr;
            </button>
        </form>

        <div style="margin-top: 2rem; padding: 1.15rem; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: var(--radius-md); font-size: 0.825rem; color: #475569;">
            <div style="font-weight: 700; color: #0f172a; margin-bottom: 0.5rem; display: flex; align-items: center; gap: 0.4rem;">
                <span>🔑</span> Quick Demo Access:
            </div>
            <div style="display: flex; flex-direction: column; gap: 0.35rem;">
                <div><span class="role-pill admin" style="font-size: 0.65rem;">Admin</span> <code>admin@jajalmedical.com</code> / <code>password123</code></div>
                <div><span class="role-pill engineer" style="font-size: 0.65rem; background: #fef3c7; color: #92400e; border: 1px solid #fde68a;">Engineer</span> <code>engineer@jajalmedical.com</code> / <code>password123</code></div>
                <div><span class="role-pill viewer" style="font-size: 0.65rem;">Viewer</span> <code>viewer@jajalmedical.com</code> / <code>password123</code></div>
            </div>
        </div>
    </div>
</div>
@endsection
