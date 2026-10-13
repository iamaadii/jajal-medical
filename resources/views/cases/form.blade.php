@extends('layouts.app')

@section('title', $case->exists ? 'Edit Case ' . $case->case_number : 'New Implant Case')

@section('content')
<div class="form-container">
    <div class="form-header-row">
        <div>
            <div style="display: inline-flex; align-items: center; gap: 0.4rem; color: var(--primary); font-size: 0.825rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.3rem;">
                <span>✦</span> {{ $case->exists ? 'Case Amendment' : 'New Registration' }}
            </div>
            <h1 style="font-size: 1.75rem; font-weight: 800; color: #0f172a; letter-spacing: -0.02em;">
                {{ $case->exists ? 'Edit Case: ' . $case->case_number : 'Create Surgical Case' }}
            </h1>
            <p style="color: #64748b; font-size: 0.9rem;">Fill in mandatory clinical and manufacturing parameters</p>
        </div>
        <a href="{{ $case->exists ? route('cases.show', $case) : route('cases.index') }}" class="btn btn-secondary btn-sm">
            &larr; Back
        </a>
    </div>

    <div class="card form-card">
        <form method="POST" action="{{ $case->exists ? route('cases.update', $case) : route('cases.store') }}">
            @csrf
            @if ($case->exists)
                @method('PUT')
            @endif

            <div class="form-grid-row">
                <div>
                    <label for="case_number" style="display: block; font-size: 0.85rem; font-weight: 700; color: #334155; margin-bottom: 0.45rem;">
                        Case Number <span style="color: #ef4444;">*</span>
                    </label>
                    <input id="case_number" type="text" name="case_number" value="{{ old('case_number', $case->case_number) }}" required placeholder="e.g. CASE-0001"
                        class="input-control {{ $errors->has('case_number') ? 'input-error' : '' }}">
                    @error('case_number')
                        <p style="color: #ef4444; font-size: 0.825rem; margin-top: 0.4rem; font-weight: 600;">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="patient_reference" style="display: block; font-size: 0.85rem; font-weight: 700; color: #334155; margin-bottom: 0.45rem;">
                        Patient Reference Code <span style="color: #ef4444;">*</span>
                    </label>
                    <input id="patient_reference" type="text" name="patient_reference" value="{{ old('patient_reference', $case->patient_reference) }}" required placeholder="e.g. PAT-9821"
                        class="input-control {{ $errors->has('patient_reference') ? 'input-error' : '' }}">
                    @error('patient_reference')
                        <p style="color: #ef4444; font-size: 0.825rem; margin-top: 0.4rem; font-weight: 600;">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="form-grid-row">
                <div>
                    <label for="surgeon_name" style="display: block; font-size: 0.85rem; font-weight: 700; color: #334155; margin-bottom: 0.45rem;">
                        Surgeon Name <span style="color: #ef4444;">*</span>
                    </label>
                    <input id="surgeon_name" type="text" name="surgeon_name" value="{{ old('surgeon_name', $case->surgeon_name) }}" required placeholder="e.g. Dr. House"
                        class="input-control {{ $errors->has('surgeon_name') ? 'input-error' : '' }}">
                    @error('surgeon_name')
                        <p style="color: #ef4444; font-size: 0.825rem; margin-top: 0.4rem; font-weight: 600;">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="implant_type" style="display: block; font-size: 0.85rem; font-weight: 700; color: #334155; margin-bottom: 0.45rem;">
                        Implant Type / Design <span style="color: #ef4444;">*</span>
                    </label>
                    <input id="implant_type" type="text" name="implant_type" value="{{ old('implant_type', $case->implant_type) }}" required placeholder="e.g. Titanium Cranial Plate 3D-Custom"
                        class="input-control {{ $errors->has('implant_type') ? 'input-error' : '' }}">
                    @error('implant_type')
                        <p style="color: #ef4444; font-size: 0.825rem; margin-top: 0.4rem; font-weight: 600;">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="form-grid-row">
                <div>
                    <label for="status" style="display: block; font-size: 0.85rem; font-weight: 700; color: #334155; margin-bottom: 0.45rem;">
                        Case Status <span style="color: #ef4444;">*</span>
                    </label>
                    <select id="status" name="status" required class="input-control {{ $errors->has('status') ? 'input-error' : '' }}">
                        @foreach (['Draft', 'Planning', 'In Review', 'Approved', 'Completed', 'Cancelled'] as $st)
                            <option value="{{ $st }}" {{ old('status', $case->status ?? 'Draft') === $st ? 'selected' : '' }}>{{ $st }}</option>
                        @endforeach
                    </select>
                    @error('status')
                        <p style="color: #ef4444; font-size: 0.825rem; margin-top: 0.4rem; font-weight: 600;">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="priority" style="display: block; font-size: 0.85rem; font-weight: 700; color: #334155; margin-bottom: 0.45rem;">
                        Priority Level <span style="color: #ef4444;">*</span>
                    </label>
                    <select id="priority" name="priority" required class="input-control {{ $errors->has('priority') ? 'input-error' : '' }}">
                        @foreach (['Low', 'Medium', 'High'] as $pr)
                            <option value="{{ $pr }}" {{ old('priority', $case->priority ?? 'Medium') === $pr ? 'selected' : '' }}>{{ $pr }}</option>
                        @endforeach
                    </select>
                    @error('priority')
                        <p style="color: #ef4444; font-size: 0.825rem; margin-top: 0.4rem; font-weight: 600;">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="surgery_date" style="display: flex; justify-content: space-between; align-items: center; font-size: 0.85rem; font-weight: 700; color: #334155; margin-bottom: 0.45rem;">
                        <span>Surgery Date</span>
                        <span id="holiday_badge" style="font-size: 0.725rem; font-weight: 600; padding: 0.2rem 0.6rem; border-radius: 4px; transition: all 0.2s;" title="Source: Nager.Date Public API">
                            @if (!empty($todayHolidays))
                                <span style="background: #fef3c7; color: #b45309;">📅 Today is {{ $todayHolidays[0]['name'] }}</span>
                            @else
                                <span style="background: #f1f5f9; color: #64748b;">📅 Today: Workday</span>
                            @endif
                        </span>
                    </label>
                    <input id="surgery_date" type="date" name="surgery_date" value="{{ old('surgery_date', $case->surgery_date ? $case->surgery_date->format('Y-m-d') : '') }}"
                        class="input-control {{ $errors->has('surgery_date') ? 'input-error' : '' }}" style="background: white;"
                        onchange="checkDateHoliday(this.value)">
                    <div id="selected_date_holiday_notice" style="margin-top: 0.4rem; font-size: 0.8rem; font-weight: 600; display: none;"></div>
                    @error('surgery_date')
                        <p style="color: #ef4444; font-size: 0.825rem; margin-top: 0.4rem; font-weight: 600;">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="form-actions-bar">
                <a href="{{ $case->exists ? route('cases.show', $case) : route('cases.index') }}" class="btn btn-secondary">
                    Cancel
                </a>
                <button type="submit" class="btn btn-primary">
                    {{ $case->exists ? 'Save Changes' : 'Create Case' }}
                </button>
            </div>
        </form>
    </div>
</div>

<style>
.form-container {
    max-width: 820px;
    margin: 1rem auto 3rem;
    animation: fadeInUp 0.4s cubic-bezier(0.16, 1, 0.3, 1);
}
.form-header-row {
    margin-bottom: 1.75rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 1rem;
}
.form-card {
    padding: 2.25rem;
    border-radius: var(--radius-lg);
}
.form-grid-row {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 1.5rem;
    margin-bottom: 1.5rem;
}
.form-actions-bar {
    display: flex;
    gap: 0.85rem;
    justify-content: flex-end;
    border-top: 1px solid #f1f5f9;
    padding-top: 1.5rem;
}
.form-actions-bar .btn {
    padding: 0.75rem 1.6rem;
}

@media (max-width: 640px) {
    .form-container {
        margin: 0.5rem auto 2rem;
    }
    .form-card {
        padding: 1.35rem 1.15rem;
    }
    .form-header-row {
        flex-direction: column;
        align-items: stretch;
        gap: 0.85rem;
    }
    .form-header-row .btn {
        width: 100%;
        text-align: center;
    }
    .form-grid-row {
        grid-template-columns: 1fr;
        gap: 1.15rem;
        margin-bottom: 1.15rem;
    }
    .form-actions-bar {
        flex-direction: column-reverse;
        gap: 0.65rem;
    }
    .form-actions-bar .btn {
        width: 100%;
        text-align: center;
        justify-content: center;
    }
}
</style>

<script>
    async function checkDateHoliday(dateStr) {
        const noticeEl = document.getElementById('selected_date_holiday_notice');
        if (!dateStr) {
            noticeEl.style.display = 'none';
            return;
        }

        const year = dateStr.split('-')[0];
        try {
            const res = await fetch(`https://date.nager.at/api/v3/PublicHolidays/${year}/US`);
            if (res.ok) {
                const holidays = await res.json();
                const found = holidays.find(h => h.date === dateStr);
                if (found) {
                    noticeEl.style.display = 'block';
                    noticeEl.style.color = '#b45309';
                    noticeEl.style.background = '#fef3c7';
                    noticeEl.style.padding = '0.4rem 0.75rem';
                    noticeEl.style.borderRadius = '6px';
                    noticeEl.style.border = '1px solid #fde68a';
                    noticeEl.innerHTML = `⚠️ Note: <strong>${found.name}</strong> is a public holiday on this date.`;
                    return;
                }
            }
        } catch (e) {
            // fail gracefully
        }

        noticeEl.style.display = 'block';
        noticeEl.style.color = '#047857';
        noticeEl.style.background = '#ecfdf5';
        noticeEl.style.padding = '0.4rem 0.75rem';
        noticeEl.style.borderRadius = '6px';
        noticeEl.style.border = '1px solid #a7f3d0';
        noticeEl.innerHTML = `✓ Regular clinical workday (no public holiday conflicts).`;
    }

    // Auto-check on load if already set
    window.addEventListener('DOMContentLoaded', () => {
        const input = document.getElementById('surgery_date');
        if (input && input.value) {
            checkDateHoliday(input.value);
        }
    });
</script>
@endsection
