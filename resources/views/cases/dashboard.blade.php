@extends('layouts.app')

@section('title', 'Clinical Dashboard')

@section('content')
<div style="margin-bottom: 2.25rem; display: flex; justify-content: space-between; align-items: flex-end; flex-wrap: wrap; gap: 1.25rem;">
    <div>
        <div style="display: inline-flex; align-items: center; gap: 0.5rem; background: var(--primary-light); color: var(--primary-hover); padding: 0.3rem 0.75rem; border-radius: var(--radius-pill); font-size: 0.775rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.6rem;">
            <span>●</span> Live Case Operations
        </div>
        <h1 style="font-size: 2rem; font-weight: 800; color: #0f172a; letter-spacing: -0.03em;">Medical Case Dashboard</h1>
        <p style="color: #64748b; font-size: 0.95rem; margin-top: 0.3rem;">Real-time surgical implant pipeline from draft to completion.</p>
    </div>
    <div style="display: flex; gap: 0.75rem; flex-wrap: wrap;">
        <a href="{{ route('cases.index') }}" class="btn btn-secondary">
            <span>Browse All Cases</span>
            <span style="font-size: 1.1rem; line-height: 1;">&rarr;</span>
        </a>
        @can('create', App\Models\MedicalCase::class)
            <a href="{{ route('cases.create') }}" class="btn btn-primary">
                <span>+ Create New Case</span>
            </a>
        @endcan
    </div>
</div>

<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 1.25rem; margin-bottom: 2.5rem;">
    <!-- Total Card -->
    <div class="card" style="padding: 1.6rem; position: relative; overflow: hidden; border-top: 4px solid #0284c7;">
        <div style="display: flex; justify-content: space-between; align-items: flex-start;">
            <span style="font-size: 0.85rem; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em;">Total Cases</span>
            <div style="width: 32px; height: 32px; border-radius: 8px; background: #e0f2fe; color: #0284c7; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 0.9rem;">Σ</div>
        </div>
        <div style="font-size: 2.4rem; font-weight: 800; color: #0f172a; margin-top: 0.6rem; letter-spacing: -0.03em;">{{ $total }}</div>
        <p style="font-size: 0.8rem; color: #94a3b8; margin-top: 0.2rem;">All tracked implants</p>
    </div>

    <!-- Planning Card -->
    <div class="card" style="padding: 1.6rem; position: relative; overflow: hidden; border-top: 4px solid #3b82f6;">
        <div style="display: flex; justify-content: space-between; align-items: flex-start;">
            <span style="font-size: 0.85rem; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em;">Planning</span>
            <div style="width: 32px; height: 32px; border-radius: 8px; background: #eff6ff; color: #2563eb; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 0.9rem;">⚙</div>
        </div>
        <div style="font-size: 2.4rem; font-weight: 800; color: #1d4ed8; margin-top: 0.6rem; letter-spacing: -0.03em;">{{ $planning }}</div>
        <p style="font-size: 0.8rem; color: #94a3b8; margin-top: 0.2rem;">CAD/CAM surgical prep</p>
    </div>

    <!-- In Review Card -->
    <div class="card" style="padding: 1.6rem; position: relative; overflow: hidden; border-top: 4px solid #f59e0b;">
        <div style="display: flex; justify-content: space-between; align-items: flex-start;">
            <span style="font-size: 0.85rem; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em;">In Review</span>
            <div style="width: 32px; height: 32px; border-radius: 8px; background: #fefce8; color: #ca8a04; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 0.9rem;">👁</div>
        </div>
        <div style="font-size: 2.4rem; font-weight: 800; color: #b45309; margin-top: 0.6rem; letter-spacing: -0.03em;">{{ $inReview }}</div>
        <p style="font-size: 0.8rem; color: #94a3b8; margin-top: 0.2rem;">Surgeon clinical review</p>
    </div>

    <!-- Approved Card -->
    <div class="card" style="padding: 1.6rem; position: relative; overflow: hidden; border-top: 4px solid #10b981;">
        <div style="display: flex; justify-content: space-between; align-items: flex-start;">
            <span style="font-size: 0.85rem; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em;">Approved</span>
            <div style="width: 32px; height: 32px; border-radius: 8px; background: #ecfdf5; color: #059669; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 0.9rem;">✓</div>
        </div>
        <div style="font-size: 2.4rem; font-weight: 800; color: #047857; margin-top: 0.6rem; letter-spacing: -0.03em;">{{ $approved }}</div>
        <p style="font-size: 0.8rem; color: #94a3b8; margin-top: 0.2rem;">Cleared for fabrication</p>
    </div>

    <!-- Completed Card -->
    <div class="card" style="padding: 1.6rem; position: relative; overflow: hidden; border-top: 4px solid #0d9488;">
        <div style="display: flex; justify-content: space-between; align-items: flex-start;">
            <span style="font-size: 0.85rem; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em;">Completed</span>
            <div style="width: 32px; height: 32px; border-radius: 8px; background: #f0fdfa; color: #0d9488; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 0.9rem;">★</div>
        </div>
        <div style="font-size: 2.4rem; font-weight: 800; color: #0f766e; margin-top: 0.6rem; letter-spacing: -0.03em;">{{ $completed }}</div>
        <p style="font-size: 0.8rem; color: #94a3b8; margin-top: 0.2rem;">Implanted & finalized</p>
    </div>
</div>

<div class="card" style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1.5rem; background: linear-gradient(135deg, #ffffff 0%, #f0f9ff 100%); border: 1px solid #bae6fd;">
    <div>
        <h3 style="font-size: 1.25rem; font-weight: 800; color: #0f172a;">Search & Manage Implant Cases</h3>
        <p style="color: #475569; font-size: 0.925rem; margin-top: 0.35rem;">Filter by surgeon, search unique identifiers, and inspect technical specifications.</p>
    </div>
    <a href="{{ route('cases.index') }}" class="btn btn-primary" style="padding: 0.75rem 1.5rem;">
        Open Case Directory &rarr;
    </a>
</div>
@endsection
