<?php

namespace Database\Factories;

use App\Models\MedicalCase;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MedicalCase>
 */
class MedicalCaseFactory extends Factory
{
    protected $model = MedicalCase::class;

    public function definition(): array
    {
        $statuses = ['Draft', 'Planning', 'In Review', 'Approved', 'Completed', 'Cancelled'];
        $priorities = ['Low', 'Medium', 'High'];
        $implantTypes = [
            'Titanium Cranial Plate',
            'Ceramic Hip Prosthesis',
            'Spinal Fusion Cage',
            'Knee Articular Spacer',
            'Cardiovascular Stent',
            'Dental Abutment System',
        ];

        static $sequence = 1;

        return [
            'case_number' => sprintf('CASE-%04d', $sequence++),
            'patient_reference' => 'PAT-' . strtoupper(fake()->bothify('##??##')),
            'surgeon_name' => 'Dr. ' . fake()->lastName(),
            'implant_type' => fake()->randomElement($implantTypes),
            'status' => fake()->randomElement($statuses),
            'priority' => fake()->randomElement($priorities),
            'surgery_date' => fake()->boolean(80) ? fake()->dateTimeBetween('now', '+3 months')->format('Y-m-d') : null,
            'created_by' => User::factory(),
        ];
    }
}
