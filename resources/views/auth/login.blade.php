@extends('layouts.app')

@section('title', 'Sign In')

@section('content')
<div class="login-container">
    <div class="login-card">
        <div style="text-align: center; margin-bottom: 2.25rem;">
            <div style="width: 54px; height: 54px; background: linear-gradient(135deg, #0284c7 0%, #2563eb 100%); color: white; border-radius: 14px; display: inline-flex; align-items: center; justify-content: center; font-size: 1.75rem; font-weight: 800; box-shadow: 0 8px 16px rgba(2, 132, 199, 0.3); margin-bottom: 1rem; animation: pulseGlow 2.5s infinite;">+</div>
            <h1 style="font-size: 1.55rem; font-weight: 800; color: #0f172a; letter-spacing: -0.02em;">Welcome Back</h1>
            <p style="color: #64748b; font-size: 0.9rem; margin-top: 0.4rem;">Sign in to Medical Implant Case Management</p>
        </div>

        <form method="POST" action="{{ route('login.perform') }}">
            @csrf

            <div style="margin-bottom: 1.35rem;">
                <label for="email" style="display: block; font-size: 0.85rem; font-weight: 700; color: #334155; margin-bottom: 0.45rem;">Work Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required placeholder="name@jajalmedical.com"
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

        <div class="demo-access-box">
            <div class="demo-access-title">
                <span>🔑</span> Quick Demo Access:
            </div>
            <div class="demo-access-list">
                <div class="demo-access-item">
                    <span class="role-pill admin">Admin</span>
                    <div class="demo-creds">
                        <code>admin@jajalmedical.com</code>
                        <span class="demo-sep">/</span>
                        <code>password123</code>
                    </div>
                </div>
                <div class="demo-access-item">
                    <span class="role-pill engineer">Engineer</span>
                    <div class="demo-creds">
                        <code>engineer@jajalmedical.com</code>
                        <span class="demo-sep">/</span>
                        <code>password123</code>
                    </div>
                </div>
                <div class="demo-access-item">
                    <span class="role-pill viewer">Viewer</span>
                    <div class="demo-creds">
                        <code>viewer@jajalmedical.com</code>
                        <span class="demo-sep">/</span>
                        <code>password123</code>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.login-container {
    max-width: 480px;
    margin: 3rem auto 2rem;
    padding: 0 1rem;
    animation: scaleIn 0.4s cubic-bezier(0.16, 1, 0.3, 1);
}
.login-card {
    padding: 2.5rem 2rem;
    border-radius: 20px;
    box-shadow: var(--shadow-lg);
    border: 1px solid #e2e8f0;
    background: #ffffff;
}
.demo-access-box {
    margin-top: 1.75rem;
    padding: 1.1rem;
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: var(--radius-md);
    font-size: 0.825rem;
    color: #475569;
}
.demo-access-title {
    font-weight: 700;
    color: #0f172a;
    margin-bottom: 0.65rem;
    display: flex;
    align-items: center;
    gap: 0.4rem;
    font-size: 0.85rem;
}
.demo-access-list {
    display: flex;
    flex-direction: column;
    gap: 0.55rem;
}
.demo-access-item {
    display: flex;
    align-items: center;
    gap: 0.6rem;
    flex-wrap: wrap;
    background: #ffffff;
    padding: 0.5rem 0.65rem;
    border-radius: 8px;
    border: 1px solid #edf2f7;
}
.demo-access-item .role-pill {
    min-width: 68px;
    text-align: center;
    font-size: 0.68rem;
    padding: 0.2rem 0.45rem;
    flex-shrink: 0;
}
.demo-creds {
    display: flex;
    align-items: center;
    gap: 0.35rem;
    flex-wrap: wrap;
    font-size: 0.775rem;
    color: #334155;
    word-break: break-all;
}
.demo-creds code {
    background: #f1f5f9;
    padding: 0.15rem 0.35rem;
    border-radius: 4px;
    color: #0f172a;
    font-family: 'JetBrains Mono', monospace;
    font-size: 0.76rem;
}
.demo-sep {
    color: #94a3b8;
    font-weight: 600;
}
@media (max-width: 480px) {
    .login-container {
        margin: 1.5rem auto 1.5rem;
        padding: 0 0.75rem;
    }
    .login-card {
        padding: 1.75rem 1.25rem;
    }
    .demo-access-item {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.35rem;
    }
}
</style>
@endsection
