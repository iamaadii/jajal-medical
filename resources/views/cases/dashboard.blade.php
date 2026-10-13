@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div style="margin-bottom: 2rem; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
    <div>
        <h1 style="font-size: 1.75rem; font-weight: 800; color: #0f172a;">Case Dashboard</h1>
        <p style="color: #64748b; font-size: 0.925rem; margin-top: 0.25rem;">Medical device implant tracking overview</p>
    </div>
    @can('create', App\Models\MedicalCase::class)
        <a href="{{ route('cases.create') }}" class="btn btn-primary">+ Create New Case</a>
    @endcan
</div>

<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(210px, 1fr)); gap: 1.25rem; margin-bottom: 2.5rem;">
    <div class="card" style="border-left: 4px solid #0284c7;">
        <span style="font-size: 0.85rem; font-weight: 600; color: #64748b;">Total Cases</span>
        <div style="font-size: 2rem; font-weight: 800; color: #0f172a; margin-top: 0.35rem;">{{ $total }}</div>
    </div>
    <div class="card" style="border-left: 4px solid #6366f1;">
        <span style="font-size: 0.85rem; font-weight: 600; color: #64748b;">Planning</span>
        <div style="font-size: 2rem; font-weight: 800; color: #4338ca; margin-top: 0.35rem;">{{ $planning }}</div>
    </div>
    <div class="card" style="border-left: 4px solid #f59e0b;">
        <span style="font-size: 0.85rem; font-weight: 600; color: #64748b;">In Review</span>
        <div style="font-size: 2rem; font-weight: 800; color: #b45309; margin-top: 0.35rem;">{{ $inReview }}</div>
    </div>
    <div class="card" style="border-left: 4px solid #10b981;">
        <span style="font-size: 0.85rem; font-weight: 600; color: #64748b;">Approved</span>
        <div style="font-size: 2rem; font-weight: 800; color: #047857; margin-top: 0.35rem;">{{ $approved }}</div>
    </div>
    <div class="card" style="border-left: 4px solid #0d9488;">
        <span style="font-size: 0.85rem; font-weight: 600; color: #64748b;">Completed</span>
        <div style="font-size: 2rem; font-weight: 800; color: #0f766e; margin-top: 0.35rem;">{{ $completed }}</div>
    </div>
</div>

<div class="card" style="display: flex; justify-content: space-between; align-items: center;">
    <div>
        <h3 style="font-size: 1.1rem; font-weight: 700; color: #0f172a;">Browse Implant Cases</h3>
        <p style="color: #64748b; font-size: 0.875rem;">View, search and manage medical implant records</p>
    </div>
    <a href="{{ route('cases.index') }}" class="btn btn-secondary">Go to Case List &rarr;</a>
</div>
@endsection
