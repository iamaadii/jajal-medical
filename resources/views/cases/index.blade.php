@extends('layouts.app')

@section('title', 'Case Directory')

@section('content')
<style>
    .mobile-cards-view {
        display: none;
        flex-direction: column;
        gap: 1rem;
    }

    .case-card-item {
        background: #ffffff;
        border: 1px solid var(--border-color);
        border-radius: var(--radius-md);
        padding: 1.25rem;
        box-shadow: var(--shadow-sm);
        transition: var(--transition);
        display: flex;
        flex-direction: column;
        gap: 0.85rem;
    }

    .case-card-item:hover {
        border-color: var(--border-hover);
        box-shadow: var(--shadow-md);
        transform: translateY(-2px);
    }

    .card-header-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 0.5rem;
    }

    .card-data-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0.75rem 1rem;
        background: #f8fafc;
        padding: 0.85rem 1rem;
        border-radius: var(--radius-sm);
        border: 1px solid #f1f5f9;
    }

    .card-data-label {
        font-size: 0.725rem;
        text-transform: uppercase;
        color: #64748b;
        font-weight: 700;
        letter-spacing: 0.04em;
    }

    .card-data-value {
        font-size: 0.875rem;
        font-weight: 600;
        color: #1e293b;
        margin-top: 0.15rem;
    }

    .card-actions-row {
        display: flex;
        gap: 0.5rem;
        margin-top: 0.25rem;
    }

    .card-actions-row .btn {
        flex: 1;
        padding: 0.55rem;
        font-size: 0.85rem;
    }

    @media (max-width: 820px) {
        .table-container {
            display: none !important;
        }
        .mobile-cards-view {
            display: flex !important;
        }
        .filter-form {
            flex-direction: column !important;
            align-items: stretch !important;
        }
        .filter-actions {
            display: flex;
            gap: 0.5rem;
            width: 100%;
        }
        .filter-actions .btn {
            flex: 1;
        }
    }
</style>

<div style="margin-bottom: 2rem; display: flex; justify-content: space-between; align-items: flex-end; flex-wrap: wrap; gap: 1.25rem;">
    <div>
        <h1 style="font-size: 1.85rem; font-weight: 800; color: #0f172a; letter-spacing: -0.03em;">Case Directory</h1>
        <p style="color: #64748b; font-size: 0.925rem; margin-top: 0.3rem;">Real-time searchable register of custom surgical cases</p>
    </div>
    @can('create', App\Models\MedicalCase::class)
        <a href="{{ route('cases.create') }}" class="btn btn-primary" style="width: auto;">
            <span>+ Create New Case</span>
        </a>
    @endcan
</div>

<div class="card" style="margin-bottom: 1.75rem; padding: 1.25rem;">
    <form method="GET" action="{{ route('cases.index') }}" class="filter-form" style="display: flex; gap: 0.85rem; flex-wrap: wrap; align-items: center;">
        <div style="flex: 2; min-width: 220px; position: relative;">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search Case # or Surgeon..."
                class="input-control" style="padding-left: 2.5rem;">
            <svg style="position: absolute; left: 0.85rem; top: 50%; transform: translateY(-50%); color: #94a3b8;" width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
        </div>
        <div style="flex: 1; min-width: 150px;">
            <select name="status" class="input-control" style="background: white;">
                <option value="">All Statuses</option>
                @foreach (['Draft', 'Planning', 'In Review', 'Approved', 'Completed', 'Cancelled'] as $st)
                    <option value="{{ $st }}" {{ request('status') === $st ? 'selected' : '' }}>{{ $st }}</option>
                @endforeach
            </select>
        </div>
        <div style="flex: 1; min-width: 140px;">
            <select name="priority" class="input-control" style="background: white;">
                <option value="">All Priorities</option>
                @foreach (['High', 'Medium', 'Low'] as $pr)
                    <option value="{{ $pr }}" {{ request('priority') === $pr ? 'selected' : '' }}>{{ $pr }} Priority</option>
                @endforeach
            </select>
        </div>
        <div class="filter-actions" style="display: flex; gap: 0.5rem;">
            <button type="submit" class="btn btn-primary" style="padding: 0.7rem 1.25rem;">Filter</button>
            @if (request()->hasAny(['search', 'status', 'priority', 'sort']))
                <a href="{{ route('cases.index') }}" class="btn btn-secondary" style="padding: 0.7rem 1.1rem; color: #64748b;">Reset</a>
            @endif
        </div>
    </form>
</div>

@php
    function sortUrl($column, $currentSort, $currentDirection) {
        $newDirection = ($currentSort === $column && $currentDirection === 'asc') ? 'desc' : 'asc';
        return request()->fullUrlWithQuery(['sort' => $column, 'direction' => $newDirection]);
    }
    function sortIndicator($column, $currentSort, $currentDirection) {
        if ($currentSort !== $column) return '⇅';
        return $currentDirection === 'asc' ? '▲' : '▼';
    }
@endphp

<!-- Desktop / Tablet Table View -->
<div class="table-container">
    <table class="data-table">
        <thead>
            <tr>
                <th>
                    <a href="{{ sortUrl('case_number', $sortBy ?? 'id', $direction ?? 'asc') }}" style="text-decoration: none; color: inherit; display: inline-flex; align-items: center; gap: 0.35rem;">
                        <span>Case Number</span>
                        <span style="font-size: 0.75rem; color: var(--primary);">{{ sortIndicator('case_number', $sortBy ?? 'id', $direction ?? 'asc') }}</span>
                    </a>
                </th>
                <th>
                    <a href="{{ sortUrl('patient_reference', $sortBy ?? 'id', $direction ?? 'asc') }}" style="text-decoration: none; color: inherit; display: inline-flex; align-items: center; gap: 0.35rem;">
                        <span>Patient Ref</span>
                        <span style="font-size: 0.75rem; color: var(--primary);">{{ sortIndicator('patient_reference', $sortBy ?? 'id', $direction ?? 'asc') }}</span>
                    </a>
                </th>
                <th>
                    <a href="{{ sortUrl('surgeon_name', $sortBy ?? 'id', $direction ?? 'asc') }}" style="text-decoration: none; color: inherit; display: inline-flex; align-items: center; gap: 0.35rem;">
                        <span>Surgeon</span>
                        <span style="font-size: 0.75rem; color: var(--primary);">{{ sortIndicator('surgeon_name', $sortBy ?? 'id', $direction ?? 'asc') }}</span>
                    </a>
                </th>
                <th>Implant Type</th>
                <th>
                    <a href="{{ sortUrl('status', $sortBy ?? 'id', $direction ?? 'asc') }}" style="text-decoration: none; color: inherit; display: inline-flex; align-items: center; gap: 0.35rem;">
                        <span>Status</span>
                        <span style="font-size: 0.75rem; color: var(--primary);">{{ sortIndicator('status', $sortBy ?? 'id', $direction ?? 'asc') }}</span>
                    </a>
                </th>
                <th>
                    <a href="{{ sortUrl('priority', $sortBy ?? 'id', $direction ?? 'asc') }}" style="text-decoration: none; color: inherit; display: inline-flex; align-items: center; gap: 0.35rem;">
                        <span>Priority</span>
                        <span style="font-size: 0.75rem; color: var(--primary);">{{ sortIndicator('priority', $sortBy ?? 'id', $direction ?? 'asc') }}</span>
                    </a>
                </th>
                <th>
                    <a href="{{ sortUrl('surgery_date', $sortBy ?? 'id', $direction ?? 'asc') }}" style="text-decoration: none; color: inherit; display: inline-flex; align-items: center; gap: 0.35rem;">
                        <span>Surgery Date</span>
                        <span style="font-size: 0.75rem; color: var(--primary);">{{ sortIndicator('surgery_date', $sortBy ?? 'id', $direction ?? 'asc') }}</span>
                    </a>
                </th>
                <th style="text-align: right;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($cases as $c)
                <tr>
                    <td>
                        <a href="{{ route('cases.show', $c) }}" style="text-decoration: none; font-weight: 700; color: var(--primary);">
                            <span class="code-pill" style="color: var(--primary); background: var(--primary-light);">{{ $c->case_number }}</span>
                        </a>
                    </td>
                    <td><span class="code-pill">{{ $c->patient_reference }}</span></td>
                    <td style="font-weight: 600; color: #1e293b;">{{ $c->surgeon_name }}</td>
                    <td style="color: #64748b; max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;" title="{{ $c->implant_type }}">{{ $c->implant_type }}</td>
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

<!-- Mobile Cards View (<820px) -->
<div class="mobile-cards-view">
    @forelse ($cases as $c)
        <div class="case-card-item">
            <div class="card-header-row">
                <a href="{{ route('cases.show', $c) }}" style="text-decoration: none;">
                    <span class="code-pill" style="font-size: 0.95rem; font-weight: 800; color: var(--primary); background: var(--primary-light);">
                        {{ $c->case_number }}
                    </span>
                </a>
                <span class="badge badge-{{ str_replace(' ', '-', $c->status) }}">
                    <span>●</span> {{ $c->status }}
                </span>
            </div>

            <div style="font-size: 1.05rem; font-weight: 700; color: #0f172a;">
                {{ $c->surgeon_name }}
            </div>

            <div style="font-size: 0.875rem; color: #64748b;">
                {{ $c->implant_type }}
            </div>

            <div class="card-data-grid">
                <div>
                    <div class="card-data-label">Patient Ref</div>
                    <div class="card-data-value"><span class="code-pill" style="font-size: 0.75rem;">{{ $c->patient_reference }}</span></div>
                </div>
                <div>
                    <div class="card-data-label">Priority</div>
                    <div class="card-data-value">
                        <span class="priority-indicator priority-{{ $c->priority }}">
                            <span class="priority-dot"></span>
                            <span>{{ $c->priority }}</span>
                        </span>
                    </div>
                </div>
                <div style="grid-column: span 2;">
                    <div class="card-data-label">Surgery Date</div>
                    <div class="card-data-value">{{ $c->surgery_date ? $c->surgery_date->format('M d, Y') : 'Not scheduled' }}</div>
                </div>
            </div>

            <div class="card-actions-row">
                <a href="{{ route('cases.show', $c) }}" class="btn btn-secondary">View Details</a>
                @can('update', $c)
                    <a href="{{ route('cases.edit', $c) }}" class="btn btn-secondary" style="color: var(--primary); border-color: #bae6fd;">Edit</a>
                @endcan
                @can('delete', $c)
                    <form action="{{ route('cases.destroy', $c) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete case {{ $c->case_number }}?');" style="margin: 0; flex: 1;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" style="width: 100%; background: #dc2626; border-color: #b91c1c;">
                            Delete
                        </button>
                    </form>
                @endcan
            </div>
        </div>
    @empty
        <div class="card" style="padding: 3rem 1.5rem; text-align: center; color: #64748b;">
            <div style="font-size: 2.2rem; margin-bottom: 0.75rem;">📂</div>
            <h4 style="font-size: 1.1rem; color: #1e293b; font-weight: 700;">No cases found</h4>
            <p style="font-size: 0.875rem; margin-top: 0.35rem;">Try adjusting your search query or status filter.</p>
        </div>
    @endforelse
</div>

<div style="margin-top: 2rem;">
    {{ $cases->links() }}
</div>
@endsection
