@extends('layouts.app')

@section('title', 'Case Directory')

@section('content')
<div style="margin-bottom: 2rem; display: flex; justify-content: space-between; align-items: flex-end; flex-wrap: wrap; gap: 1.25rem;">
    <div>
        <h1 style="font-size: 1.85rem; font-weight: 800; color: #0f172a; letter-spacing: -0.03em;">Case Directory</h1>
        <p style="color: #64748b; font-size: 0.925rem; margin-top: 0.3rem;">Real-time searchable register of custom surgical cases</p>
    </div>
    @can('create', App\Models\MedicalCase::class)
        <a href="{{ route('cases.create') }}" class="btn btn-primary">
            <span>+ Create New Case</span>
        </a>
    @endcan
</div>

<div class="card" style="margin-bottom: 1.75rem; padding: 1.25rem;">
    <form method="GET" action="{{ route('cases.index') }}" style="display: flex; gap: 0.85rem; flex-wrap: wrap; align-items: center;">
        <div style="flex: 2; min-width: 240px; position: relative;">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by Case # (e.g. CASE-0001) or Surgeon..."
                class="input-control" style="padding-left: 2.5rem;">
            <svg style="position: absolute; left: 0.85rem; top: 50%; transform: translateY(-50%); color: #94a3b8;" width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
        </div>
        <div style="flex: 1; min-width: 170px;">
            <select name="status" class="input-control" style="background: white;">
                <option value="">All Statuses</option>
                @foreach (['Draft', 'Planning', 'In Review', 'Approved', 'Completed', 'Cancelled'] as $st)
                    <option value="{{ $st }}" {{ request('status') === $st ? 'selected' : '' }}>{{ $st }}</option>
                @endforeach
            </select>
        </div>
        <div style="display: flex; gap: 0.5rem; flex-wrap: wrap;">
            <button type="submit" class="btn btn-primary" style="padding: 0.7rem 1.25rem;">Filter</button>
            @if (request()->hasAny(['search', 'status']))
                <a href="{{ route('cases.index') }}" class="btn btn-secondary" style="padding: 0.7rem 1.1rem; color: #64748b;">Reset</a>
            @endif
        </div>
    </form>
</div>

<div class="table-container">
    <table class="data-table">
        <thead>
            <tr>
                <th>Case Number</th>
                <th>Patient Ref</th>
                <th>Surgeon</th>
                <th>Implant Type</th>
                <th>Status</th>
                <th>Priority</th>
                <th>Surgery Date</th>
                <th style="text-align: right;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($cases as $c)
                <tr>
                    <td>
                        <a href="{{ route('cases.show', $c) }}" style="text-decoration: none; font-weight: 700; color: var(--primary); display: flex; align-items: center; gap: 0.4rem;">
                            <span class="code-pill" style="color: var(--primary); background: var(--primary-light);">{{ $c->case_number }}</span>
                        </a>
                    </td>
                    <td><span class="code-pill">{{ $c->patient_reference }}</span></td>
                    <td style="font-weight: 600; color: #1e293b;">{{ $c->surgeon_name }}</td>
                    <td style="color: #64748b; max-width: 220px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;" title="{{ $c->implant_type }}">{{ $c->implant_type }}</td>
                    <td>
                        <span class="badge badge-{{ str_replace(' ', '-', $c->status) }}">
                            <span>●</span> {{ $c->status }}
                        </span>
                    </td>
                    <td>
                        <span class="priority-indicator priority-{{ $c->priority }}">
                            <span class="priority-dot"></span>
                            <span>{{ $c->priority }}</span>
                        </span>
                    </td>
                    <td style="color: #64748b;">
                        {{ $c->surgery_date ? $c->surgery_date->format('M d, Y') : '—' }}
                    </td>
                    <td style="text-align: right; white-space: nowrap; min-width: 190px;">
                        <div style="display: inline-flex; align-items: center; justify-content: flex-end; gap: 0.5rem;">
                            <a href="{{ route('cases.show', $c) }}" class="btn btn-secondary btn-sm" title="View details" style="padding: 0.45rem 0.85rem; font-weight: 700;">View</a>
                            @can('update', $c)
                                <a href="{{ route('cases.edit', $c) }}" class="btn btn-secondary btn-sm" title="Edit case" style="padding: 0.45rem 0.85rem; font-weight: 700; color: var(--primary); border-color: #bae6fd;">Edit</a>
                            @endcan
                            @can('delete', $c)
                                <form action="{{ route('cases.destroy', $c) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete case {{ $c->case_number }}?');" style="margin: 0; display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" title="Delete case" style="padding: 0.45rem 0.85rem; font-weight: 700; background: #dc2626; border: 1px solid #b91c1c; color: #ffffff;">
                                        Delete
                                    </button>
                                </form>
                            @endcan
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" style="padding: 3.5rem 1.5rem; text-align: center; color: #64748b;">
                        <div style="font-size: 2.2rem; margin-bottom: 0.75rem;">📂</div>
                        <h4 style="font-size: 1.1rem; color: #1e293b; font-weight: 700;">No cases found</h4>
                        <p style="font-size: 0.875rem; margin-top: 0.35rem;">Try adjusting your search query or status filter.</p>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div style="margin-top: 2rem;">
    {{ $cases->links() }}
</div>
@endsection
