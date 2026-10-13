@extends('layouts.app')

@section('title', $case->exists ? 'Edit Case ' . $case->case_number : 'Create New Case')

@section('content')
<div style="max-width: 760px; margin: 1rem auto;">
    <div style="margin-bottom: 1.5rem; display: flex; justify-content: space-between; align-items: center;">
        <div>
            <h1 style="font-size: 1.6rem; font-weight: 800; color: #0f172a;">
                {{ $case->exists ? 'Edit Case: ' . $case->case_number : 'Create New Implant Case' }}
            </h1>
            <p style="color: #64748b; font-size: 0.875rem;">Fill out all required clinical case metadata</p>
        </div>
        <a href="{{ $case->exists ? route('cases.show', $case) : route('cases.index') }}" class="btn btn-secondary btn-sm">&larr; Back</a>
    </div>

    <div class="card">
        <form method="POST" action="{{ $case->exists ? route('cases.update', $case) : route('cases.store') }}">
            @csrf
            @if ($case->exists)
                @method('PUT')
            @endif

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.25rem; margin-bottom: 1.25rem;">
                <div>
                    <label for="case_number" style="display: block; font-size: 0.85rem; font-weight: 600; color: #334155; margin-bottom: 0.4rem;">
                        Case Number <span style="color: #ef4444;">*</span>
                    </label>
                    <input id="case_number" type="text" name="case_number" value="{{ old('case_number', $case->case_number) }}" required placeholder="e.g. CASE-0001"
                        style="width: 100%; padding: 0.65rem 0.85rem; border: 1px solid {{ $errors->has('case_number') ? '#ef4444' : '#cbd5e1' }}; border-radius: 8px; font-size: 0.9rem;">
                    @error('case_number')
                        <p style="color: #ef4444; font-size: 0.8rem; margin-top: 0.35rem; font-weight: 500;">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="patient_reference" style="display: block; font-size: 0.85rem; font-weight: 600; color: #334155; margin-bottom: 0.4rem;">
                        Patient Reference (Dummy Code) <span style="color: #ef4444;">*</span>
                    </label>
                    <input id="patient_reference" type="text" name="patient_reference" value="{{ old('patient_reference', $case->patient_reference) }}" required placeholder="e.g. PAT-9821"
                        style="width: 100%; padding: 0.65rem 0.85rem; border: 1px solid {{ $errors->has('patient_reference') ? '#ef4444' : '#cbd5e1' }}; border-radius: 8px; font-size: 0.9rem;">
                    @error('patient_reference')
                        <p style="color: #ef4444; font-size: 0.8rem; margin-top: 0.35rem; font-weight: 500;">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.25rem; margin-bottom: 1.25rem;">
                <div>
                    <label for="surgeon_name" style="display: block; font-size: 0.85rem; font-weight: 600; color: #334155; margin-bottom: 0.4rem;">
                        Surgeon Name <span style="color: #ef4444;">*</span>
                    </label>
                    <input id="surgeon_name" type="text" name="surgeon_name" value="{{ old('surgeon_name', $case->surgeon_name) }}" required placeholder="e.g. Dr. House"
                        style="width: 100%; padding: 0.65rem 0.85rem; border: 1px solid {{ $errors->has('surgeon_name') ? '#ef4444' : '#cbd5e1' }}; border-radius: 8px; font-size: 0.9rem;">
                    @error('surgeon_name')
                        <p style="color: #ef4444; font-size: 0.8rem; margin-top: 0.35rem; font-weight: 500;">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="implant_type" style="display: block; font-size: 0.85rem; font-weight: 600; color: #334155; margin-bottom: 0.4rem;">
                        Implant Type <span style="color: #ef4444;">*</span>
                    </label>
                    <input id="implant_type" type="text" name="implant_type" value="{{ old('implant_type', $case->implant_type) }}" required placeholder="e.g. Cranial Plate PEEK"
                        style="width: 100%; padding: 0.65rem 0.85rem; border: 1px solid {{ $errors->has('implant_type') ? '#ef4444' : '#cbd5e1' }}; border-radius: 8px; font-size: 0.9rem;">
                    @error('implant_type')
                        <p style="color: #ef4444; font-size: 0.8rem; margin-top: 0.35rem; font-weight: 500;">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.25rem; margin-bottom: 1.75rem;">
                <div>
                    <label for="status" style="display: block; font-size: 0.85rem; font-weight: 600; color: #334155; margin-bottom: 0.4rem;">
                        Status <span style="color: #ef4444;">*</span>
                    </label>
                    <select id="status" name="status" required
                        style="width: 100%; padding: 0.65rem 0.85rem; border: 1px solid {{ $errors->has('status') ? '#ef4444' : '#cbd5e1' }}; border-radius: 8px; font-size: 0.9rem; background: white;">
                        @foreach (['Draft', 'Planning', 'In Review', 'Approved', 'Completed', 'Cancelled'] as $st)
                            <option value="{{ $st }}" {{ old('status', $case->status ?? 'Draft') === $st ? 'selected' : '' }}>{{ $st }}</option>
                        @endforeach
                    </select>
                    @error('status')
                        <p style="color: #ef4444; font-size: 0.8rem; margin-top: 0.35rem; font-weight: 500;">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="priority" style="display: block; font-size: 0.85rem; font-weight: 600; color: #334155; margin-bottom: 0.4rem;">
                        Priority <span style="color: #ef4444;">*</span>
                    </label>
                    <select id="priority" name="priority" required
                        style="width: 100%; padding: 0.65rem 0.85rem; border: 1px solid {{ $errors->has('priority') ? '#ef4444' : '#cbd5e1' }}; border-radius: 8px; font-size: 0.9rem; background: white;">
                        @foreach (['Low', 'Medium', 'High'] as $pr)
                            <option value="{{ $pr }}" {{ old('priority', $case->priority ?? 'Medium') === $pr ? 'selected' : '' }}>{{ $pr }}</option>
                        @endforeach
                    </select>
                    @error('priority')
                        <p style="color: #ef4444; font-size: 0.8rem; margin-top: 0.35rem; font-weight: 500;">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="surgery_date" style="display: block; font-size: 0.85rem; font-weight: 600; color: #334155; margin-bottom: 0.4rem;">
                        Surgery Date
                    </label>
                    <input id="surgery_date" type="date" name="surgery_date" value="{{ old('surgery_date', $case->surgery_date ? $case->surgery_date->format('Y-m-d') : '') }}"
                        style="width: 100%; padding: 0.65rem 0.85rem; border: 1px solid {{ $errors->has('surgery_date') ? '#ef4444' : '#cbd5e1' }}; border-radius: 8px; font-size: 0.9rem; background: white;">
                    @error('surgery_date')
                        <p style="color: #ef4444; font-size: 0.8rem; margin-top: 0.35rem; font-weight: 500;">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div style="display: flex; gap: 0.75rem; justify-content: flex-end; border-top: 1px solid #f1f5f9; padding-top: 1.25rem;">
                <a href="{{ $case->exists ? route('cases.show', $case) : route('cases.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">
                    {{ $case->exists ? 'Update Case' : 'Create Case' }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
