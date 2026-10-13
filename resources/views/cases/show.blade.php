@extends('layouts.app')

@section('title', 'Case Details - ' . $case->case_number)

@section('content')
<div style="max-width: 820px; margin: 1rem auto;">
    <div style="margin-bottom: 1.5rem; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
        <div>
            <div style="display: flex; align-items: center; gap: 0.75rem;">
                <h1 style="font-size: 1.6rem; font-weight: 800; color: #0f172a;">{{ $case->case_number }}</h1>
                <span class="badge badge-{{ str_replace(' ', '-', $case->status) }}">{{ $case->status }}</span>
            </div>
            <p style="color: #64748b; font-size: 0.875rem; margin-top: 0.25rem;">Medical device surgical implant case record</p>
        </div>
        <div style="display: flex; gap: 0.5rem;">
            <a href="{{ route('cases.index') }}" class="btn btn-secondary">&larr; Back to list</a>
            @can('update', $case)
                <a href="{{ route('cases.edit', $case) }}" class="btn btn-primary">Edit Case</a>
            @endcan
            @can('delete', $case)
                <form action="{{ route('cases.destroy', $case) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete case {{ $case->case_number }}?');" style="margin: 0;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            @endcan
        </div>
    </div>

    <div class="card" style="padding: 0; overflow: hidden;">
        <div style="padding: 1.25rem 1.5rem; background: #f8fafc; border-bottom: 1px solid #e2e8f0; font-weight: 700; color: #1e293b;">
            Case Specifications & Metadata
        </div>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 1.5rem; padding: 1.5rem;">
            <div>
                <span style="font-size: 0.775rem; text-transform: uppercase; color: #64748b; font-weight: 700; letter-spacing: 0.05em;">Case ID</span>
                <p style="font-size: 1rem; font-weight: 600; color: #0f172a; margin-top: 0.25rem;">#{{ $case->id }}</p>
            </div>
            <div>
                <span style="font-size: 0.775rem; text-transform: uppercase; color: #64748b; font-weight: 700; letter-spacing: 0.05em;">Case Number</span>
                <p style="font-size: 1rem; font-weight: 600; color: #0284c7; margin-top: 0.25rem;">{{ $case->case_number }}</p>
            </div>
            <div>
                <span style="font-size: 0.775rem; text-transform: uppercase; color: #64748b; font-weight: 700; letter-spacing: 0.05em;">Patient Reference</span>
                <p style="font-size: 1rem; font-weight: 600; color: #0f172a; margin-top: 0.25rem;">{{ $case->patient_reference }}</p>
            </div>
            <div>
                <span style="font-size: 0.775rem; text-transform: uppercase; color: #64748b; font-weight: 700; letter-spacing: 0.05em;">Surgeon Name</span>
                <p style="font-size: 1rem; font-weight: 600; color: #0f172a; margin-top: 0.25rem;">{{ $case->surgeon_name }}</p>
            </div>
            <div>
                <span style="font-size: 0.775rem; text-transform: uppercase; color: #64748b; font-weight: 700; letter-spacing: 0.05em;">Implant Type</span>
                <p style="font-size: 1rem; font-weight: 600; color: #0f172a; margin-top: 0.25rem;">{{ $case->implant_type }}</p>
            </div>
            <div>
                <span style="font-size: 0.775rem; text-transform: uppercase; color: #64748b; font-weight: 700; letter-spacing: 0.05em;">Status</span>
                <p style="margin-top: 0.25rem;">
                    <span class="badge badge-{{ str_replace(' ', '-', $case->status) }}">{{ $case->status }}</span>
                </p>
            </div>
            <div>
                <span style="font-size: 0.775rem; text-transform: uppercase; color: #64748b; font-weight: 700; letter-spacing: 0.05em;">Priority</span>
                <p style="font-size: 1rem; margin-top: 0.25rem;" class="priority-{{ $case->priority }}">{{ $case->priority }}</p>
            </div>
            <div>
                <span style="font-size: 0.775rem; text-transform: uppercase; color: #64748b; font-weight: 700; letter-spacing: 0.05em;">Surgery Date</span>
                <p style="font-size: 1rem; font-weight: 600; color: #0f172a; margin-top: 0.25rem;">
                    {{ $case->surgery_date ? $case->surgery_date->format('F d, Y') : 'Not scheduled' }}
                </p>
            </div>
            <div>
                <span style="font-size: 0.775rem; text-transform: uppercase; color: #64748b; font-weight: 700; letter-spacing: 0.05em;">Created By</span>
                <p style="font-size: 1rem; font-weight: 600; color: #0f172a; margin-top: 0.25rem;">
                    {{ $case->creator ? $case->creator->name . ' (' . $case->creator->role . ')' : 'System' }}
                </p>
            </div>
            <div>
                <span style="font-size: 0.775rem; text-transform: uppercase; color: #64748b; font-weight: 700; letter-spacing: 0.05em;">Created At</span>
                <p style="font-size: 0.925rem; color: #475569; margin-top: 0.25rem;">{{ $case->created_at->format('M d, Y H:i:s') }}</p>
            </div>
            <div>
                <span style="font-size: 0.775rem; text-transform: uppercase; color: #64748b; font-weight: 700; letter-spacing: 0.05em;">Last Updated</span>
                <p style="font-size: 0.925rem; color: #475569; margin-top: 0.25rem;">{{ $case->updated_at->format('M d, Y H:i:s') }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
