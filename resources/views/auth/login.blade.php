@extends('layouts.app')

@section('title', 'Sign In')

@section('content')
<div style="max-width: 440px; margin: 3rem auto;">
    <div class="card" style="padding: 2.25rem;">
        <div style="text-align: center; margin-bottom: 2rem;">
            <div style="width: 48px; height: 48px; background: linear-gradient(135deg, #0284c7, #2563eb); color: white; border-radius: 12px; display: inline-flex; align-items: center; justify-content: center; font-size: 1.5rem; font-weight: 800; margin-bottom: 0.75rem;">+</div>
            <h1 style="font-size: 1.4rem; font-weight: 800; color: #0f172a;">Sign in to your account</h1>
            <p style="color: #64748b; font-size: 0.875rem; margin-top: 0.35rem;">Medical Implant Case Management System</p>
        </div>

        <form method="POST" action="{{ route('login.perform') }}">
            @csrf

            <div style="margin-bottom: 1.25rem;">
                <label for="email" style="display: block; font-size: 0.85rem; font-weight: 600; color: #334155; margin-bottom: 0.4rem;">Email address</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                    style="width: 100%; padding: 0.65rem 0.85rem; border: 1px solid {{ $errors->has('email') ? '#ef4444' : '#cbd5e1' }}; border-radius: 8px; font-size: 0.925rem; outline: none; transition: border-color 0.15s;">
                @error('email')
                    <p style="color: #ef4444; font-size: 0.8rem; margin-top: 0.35rem; font-weight: 500;">{{ $message }}</p>
                @enderror
            </div>

            <div style="margin-bottom: 1.5rem;">
                <label for="password" style="display: block; font-size: 0.85rem; font-weight: 600; color: #334155; margin-bottom: 0.4rem;">Password</label>
                <input id="password" type="password" name="password" required
                    style="width: 100%; padding: 0.65rem 0.85rem; border: 1px solid {{ $errors->has('password') ? '#ef4444' : '#cbd5e1' }}; border-radius: 8px; font-size: 0.925rem; outline: none;">
                @error('password')
                    <p style="color: #ef4444; font-size: 0.8rem; margin-top: 0.35rem; font-weight: 500;">{{ $message }}</p>
                @enderror
            </div>

            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.5rem;">
                <label style="display: flex; align-items: center; gap: 0.5rem; font-size: 0.85rem; color: #64748b; cursor: pointer;">
                    <input type="checkbox" name="remember" value="1">
                    <span>Remember me</span>
                </label>
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%; padding: 0.75rem; font-size: 0.95rem;">
                Sign In
            </button>
        </form>

        <div style="margin-top: 1.75rem; padding-top: 1.25rem; border-top: 1px solid #f1f5f9; font-size: 0.8rem; color: #64748b; line-height: 1.5;">
            <strong>Demo Credentials:</strong><br>
            • Admin: <code>admin@jajalmedical.com</code> / <code>password123</code><br>
            • Viewer: <code>viewer@jajalmedical.com</code> / <code>password123</code>
        </div>
    </div>
</div>
@endsection
