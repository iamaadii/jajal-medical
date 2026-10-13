@extends('layouts.app')

@section('title', 'Case Details - ' . $case->case_number)

@section('content')
<div style="max-width: 900px; margin: 1rem auto 3rem; animation: fadeInUp 0.4s cubic-bezier(0.16, 1, 0.3, 1);">
    <div style="margin-bottom: 1.75rem; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
        <div>
            <div style="display: flex; align-items: center; gap: 0.75rem; flex-wrap: wrap;">
                <span class="code-pill" style="font-size: 1.25rem; font-weight: 800; color: var(--primary); background: var(--primary-light); padding: 0.3rem 0.8rem; border-radius: 8px;">
                    {{ $case->case_number }}
                </span>
                <span class="badge badge-{{ str_replace(' ', '-', $case->status) }}" style="font-size: 0.85rem; padding: 0.35rem 0.85rem;">
                    <span>●</span> {{ $case->status }}
                </span>
            </div>
            <p style="color: #64748b; font-size: 0.9rem; margin-top: 0.35rem;">Medical device surgical implant case record</p>
        </div>
        <div style="display: flex; gap: 0.6rem; flex-wrap: wrap;">
            <a href="{{ route('cases.index') }}" class="btn btn-secondary btn-sm">&larr; Back to list</a>
            @can('update', $case)
                <a href="{{ route('cases.edit', $case) }}" class="btn btn-primary btn-sm">Edit Case</a>
            @endcan
            @can('delete', $case)
                <form action="{{ route('cases.destroy', $case) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete case {{ $case->case_number }}?');" style="margin: 0; display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
            @endcan
        </div>
    </div>

    <div class="card" style="padding: 0; overflow: hidden; border-radius: var(--radius-lg);">
        <div style="padding: 1.35rem 1.75rem; background: linear-gradient(180deg, #f8fafc 0%, #f1f5f9 100%); border-bottom: 1px solid var(--border-color); display: flex; justify-content: space-between; align-items: center;">
            <span style="font-weight: 800; color: #1e293b; font-size: 1rem; letter-spacing: -0.01em;">Technical Specifications & Clinical Parameters</span>
            <span style="font-size: 0.8rem; color: #64748b; font-weight: 600;">System Record #{{ $case->id }}</span>
        </div>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1.75rem; padding: 1.75rem;">
            <div>
                <span style="font-size: 0.775rem; text-transform: uppercase; color: #64748b; font-weight: 700; letter-spacing: 0.05em;">Case Number</span>
                <p style="font-size: 1.15rem; font-weight: 800; color: var(--primary); margin-top: 0.35rem;">
                    {{ $case->case_number }}
                </p>
            </div>

            <div>
                <span style="font-size: 0.775rem; text-transform: uppercase; color: #64748b; font-weight: 700; letter-spacing: 0.05em;">Patient Reference</span>
                <p style="margin-top: 0.35rem;">
                    <span class="code-pill">{{ $case->patient_reference }}</span>
                </p>
            </div>

            <div>
                <span style="font-size: 0.775rem; text-transform: uppercase; color: #64748b; font-weight: 700; letter-spacing: 0.05em;">Operating Surgeon</span>
                <p style="font-size: 1.05rem; font-weight: 700; color: #0f172a; margin-top: 0.35rem;">
                    {{ $case->surgeon_name }}
                </p>
            </div>

            <div>
                <span style="font-size: 0.775rem; text-transform: uppercase; color: #64748b; font-weight: 700; letter-spacing: 0.05em;">Implant Device</span>
                <p style="font-size: 1rem; font-weight: 600; color: #334155; margin-top: 0.35rem;">
                    {{ $case->implant_type }}
                </p>
            </div>

            <div>
                <span style="font-size: 0.775rem; text-transform: uppercase; color: #64748b; font-weight: 700; letter-spacing: 0.05em;">Workflow Status</span>
                <div style="margin-top: 0.35rem;">
                    <span class="badge badge-{{ str_replace(' ', '-', $case->status) }}">
                        <span>●</span> {{ $case->status }}
                    </span>
                </div>
            </div>

            <div>
                <span style="font-size: 0.775rem; text-transform: uppercase; color: #64748b; font-weight: 700; letter-spacing: 0.05em;">Priority Severity</span>
                <div style="margin-top: 0.35rem;">
                    <span class="priority-indicator priority-{{ $case->priority }}" style="font-size: 1rem;">
                        <span class="priority-dot"></span>
                        <span>{{ $case->priority }}</span>
                    </span>
                </div>
            </div>

            <div>
                <span style="font-size: 0.775rem; text-transform: uppercase; color: #64748b; font-weight: 700; letter-spacing: 0.05em;">Scheduled Surgery</span>
                <p style="font-size: 1rem; font-weight: 700; color: #0f172a; margin-top: 0.35rem;">
                    {{ $case->surgery_date ? $case->surgery_date->format('F d, Y') : 'Not scheduled' }}
                </p>
            </div>

            <div>
                <span style="font-size: 0.775rem; text-transform: uppercase; color: #64748b; font-weight: 700; letter-spacing: 0.05em;">Registered By</span>
                <p style="font-size: 0.95rem; font-weight: 600; color: #0f172a; margin-top: 0.35rem; display: flex; align-items: center; gap: 0.5rem;">
                    <span>{{ $case->creator ? $case->creator->name : 'System' }}</span>
                    @if ($case->creator)
                        <span class="role-pill {{ strtolower($case->creator->role) }}">{{ $case->creator->role }}</span>
                    @endif
                </p>
            </div>

            <div>
                <span style="font-size: 0.775rem; text-transform: uppercase; color: #64748b; font-weight: 700; letter-spacing: 0.05em;">Date Registered</span>
                <p style="font-size: 0.9rem; color: #475569; margin-top: 0.35rem;">
                    {{ $case->created_at->format('M d, Y · H:i:s') }}
                </p>
            </div>

            <div>
                <span style="font-size: 0.775rem; text-transform: uppercase; color: #64748b; font-weight: 700; letter-spacing: 0.05em;">Last Modified</span>
                <p style="font-size: 0.9rem; color: #475569; margin-top: 0.35rem;">
                    {{ $case->updated_at->format('M d, Y · H:i:s') }}
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
