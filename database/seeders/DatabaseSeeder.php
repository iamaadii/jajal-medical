<?php

namespace Database\Seeders;

use App\Models\MedicalCase;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $admin = User::firstOrCreate(
            ['email' => 'admin@jajalmedical.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password123'),
                'role' => 'Admin',
            ]
        );

        $engineer = User::firstOrCreate(
            ['email' => 'engineer@jajalmedical.com'],
            [
                'name' => 'Engineer User',
                'password' => Hash::make('password123'),
                'role' => 'Engineer',
            ]
        );

        $viewer = User::firstOrCreate(
            ['email' => 'viewer@jajalmedical.com'],
            [
                'name' => 'Viewer User',
                'password' => Hash::make('password123'),
                'role' => 'Viewer',
            ]
        );

        $statuses = ['Draft', 'Planning', 'In Review', 'Approved', 'Completed', 'Cancelled'];
        $priorities = ['Low', 'Medium', 'High'];
        $surgeons = ['Dr. Sarah Connor', 'Dr. James Wilson', 'Dr. Gregory House', 'Dr. Meredith Grey', 'Dr. Stephen Strange'];
        $implantTypes = [
            'Titanium Cranial Plate 3D-Custom',
            'Ceramic Total Hip Replacement',
            'Spinal Cage PEEK Radiotransparent',
            'Bicondylar Knee Articular Spacer',
            'Cardiovascular Bioresorbable Stent',
            'Custom Orbital Floor Mesh Titanium',
        ];

        for ($i = 1; $i <= 25; $i++) {
            MedicalCase::firstOrCreate(
                ['case_number' => sprintf('CASE-%04d', $i)],
                [
                    'patient_reference' => 'PAT-' . str_pad((string) $i, 4, '0', STR_PAD_LEFT),
                    'surgeon_name' => $surgeons[($i - 1) % count($surgeons)],
                    'implant_type' => $implantTypes[($i - 1) % count($implantTypes)],
                    'status' => $statuses[($i - 1) % count($statuses)],
                    'priority' => $priorities[($i - 1) % count($priorities)],
                    'surgery_date' => now()->addDays($i * 2)->format('Y-m-d'),
                    'created_by' => $admin->id,
                ]
            );
        }
    }
}
