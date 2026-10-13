@extends('layouts.app')

@section('title', 'Cases List')

@section('content')
<div style="margin-bottom: 1.5rem; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
    <div>
        <h1 style="font-size: 1.5rem; font-weight: 800; color: #0f172a;">Cases</h1>
        <p style="color: #64748b; font-size: 0.875rem;">Manage and monitor all surgical implant cases</p>
    </div>
    @can('create', App\Models\MedicalCase::class)
        <a href="{{ route('cases.create') }}" class="btn btn-primary">+ Create New Case</a>
    @endcan
</div>

<div class="card" style="margin-bottom: 1.5rem; padding: 1.1rem;">
    <form method="GET" action="{{ route('cases.index') }}" style="display: flex; gap: 0.85rem; flex-wrap: wrap; align-items: center;">
        <div style="flex: 1; min-width: 220px;">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search Case # or Surgeon..."
                style="width: 100%; padding: 0.55rem 0.85rem; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 0.875rem;">
        </div>
        <div style="min-width: 160px;">
            <select name="status" style="width: 100%; padding: 0.55rem 0.85rem; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 0.875rem; background: white;">
                <option value="">All Statuses</option>
                @foreach (['Draft', 'Planning', 'In Review', 'Approved', 'Completed', 'Cancelled'] as $st)
                    <option value="{{ $st }}" {{ request('status') === $st ? 'selected' : '' }}>{{ $st }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-secondary">Filter</button>
        @if (request()->hasAny(['search', 'status']))
            <a href="{{ route('cases.index') }}" class="btn btn-secondary" style="color: #64748b;">Clear</a>
        @endif
    </form>
</div>

<div class="card" style="padding: 0; overflow-x: auto;">
    <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 0.875rem;">
        <thead>
            <tr style="background: #f8fafc; border-bottom: 1px solid #e2e8f0; color: #475569; font-weight: 700; text-transform: uppercase; font-size: 0.75rem; letter-spacing: 0.04em;">
                <th style="padding: 0.85rem 1.25rem;">Case Number</th>
                <th style="padding: 0.85rem 1rem;">Patient Ref</th>
                <th style="padding: 0.85rem 1rem;">Surgeon</th>
                <th style="padding: 0.85rem 1rem;">Implant Type</th>
                <th style="padding: 0.85rem 1rem;">Status</th>
                <th style="padding: 0.85rem 1rem;">Priority</th>
                <th style="padding: 0.85rem 1rem;">Surgery Date</th>
                <th style="padding: 0.85rem 1.25rem; text-align: right;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($cases as $c)
                <tr style="border-bottom: 1px solid #f1f5f9;">
                    <td style="padding: 0.85rem 1.25rem; font-weight: 700; color: #0284c7;">
                        <a href="{{ route('cases.show', $c) }}" style="text-decoration: none; color: inherit;">{{ $c->case_number }}</a>
                    </td>
                    <td style="padding: 0.85rem 1rem; color: #334155;">{{ $c->patient_reference }}</td>
                    <td style="padding: 0.85rem 1rem; color: #334155;">{{ $c->surgeon_name }}</td>
                    <td style="padding: 0.85rem 1rem; color: #64748b;">{{ $c->implant_type }}</td>
                    <td style="padding: 0.85rem 1rem;">
                        <span class="badge badge-{{ str_replace(' ', '-', $c->status) }}">{{ $c->status }}</span>
                    </td>
                    <td style="padding: 0.85rem 1rem;">
                        <span class="priority-{{ $c->priority }}">{{ $c->priority }}</span>
                    </td>
                    <td style="padding: 0.85rem 1rem; color: #64748b;">{{ $c->surgery_date ? $c->surgery_date->format('Y-m-d') : '—' }}</td>
                    <td style="padding: 0.85rem 1.25rem; text-align: right;">
                        <div style="display: inline-flex; gap: 0.4rem;">
                            <a href="{{ route('cases.show', $c) }}" class="btn btn-secondary btn-sm">View</a>
                            @can('update', $c)
                                <a href="{{ route('cases.edit', $c) }}" class="btn btn-secondary btn-sm">Edit</a>
                            @endcan
                            @can('delete', $c)
                                <form action="{{ route('cases.destroy', $c) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete case {{ $c->case_number }}?');" style="margin: 0;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            @endcan
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" style="padding: 2.5rem; text-align: center; color: #64748b;">
                        No cases found matching your criteria.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div style="margin-top: 1.5rem;">
    {{ $cases->links() }}
</div>
@endsection
