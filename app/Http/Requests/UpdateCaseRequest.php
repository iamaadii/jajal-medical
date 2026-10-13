<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCaseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() && strtolower($this->user()->role) === 'admin';
    }

    public function rules(): array
    {
        $caseId = $this->route('case') ?? $this->route('id');
        if (is_object($caseId)) {
            $caseId = $caseId->id;
        }

        return [
            'case_number' => [
                'required',
                'string',
                'max:50',
                Rule::unique('cases', 'case_number')->ignore($caseId),
            ],
            'patient_reference' => ['required', 'string', 'max:100'],
            'surgeon_name' => ['required', 'string', 'max:150'],
            'implant_type' => ['required', 'string', 'max:150'],
            'status' => ['required', Rule::in(['Draft', 'Planning', 'In Review', 'Approved', 'Completed', 'Cancelled'])],
            'priority' => ['required', Rule::in(['Low', 'Medium', 'High'])],
            'surgery_date' => ['nullable', 'date'],
        ];
    }
}
