<?php

namespace Tests\Feature;

use App\Models\MedicalCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CaseManagementFeatureTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;
    private User $viewer;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->create([
            'email' => 'admin_test@jajalmedical.com',
            'role' => 'Admin',
            'password' => bcrypt('password123'),
        ]);

        $this->viewer = User::factory()->create([
            'email' => 'viewer_test@jajalmedical.com',
            'role' => 'Viewer',
            'password' => bcrypt('password123'),
        ]);
    }

    public function test_valid_login_succeeds(): void
    {
        $response = $this->post('/login', [
            'email' => 'admin_test@jajalmedical.com',
            'password' => 'password123',
        ]);

        $response->assertRedirect('/dashboard');
        $this->assertAuthenticatedAs($this->admin);

        $apiResponse = $this->postJson('/api/login', [
            'email' => 'admin_test@jajalmedical.com',
            'password' => 'password123',
        ]);

        $apiResponse->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Login successful',
            ])
            ->assertJsonStructure([
                'data' => ['token', 'user'],
            ]);
    }

    public function test_invalid_login_is_rejected(): void
    {
        $response = $this->post('/login', [
            'email' => 'admin_test@jajalmedical.com',
            'password' => 'wrong_password',
        ]);

        $response->assertSessionHasErrors('email');
        $this->assertGuest();

        $apiResponse = $this->postJson('/api/login', [
            'email' => 'admin_test@jajalmedical.com',
            'password' => 'wrong_password',
        ]);

        $apiResponse->assertStatus(401)
            ->assertJson([
                'success' => false,
                'data' => null,
            ]);
    }

    public function test_guest_cannot_open_case_pages_or_apis(): void
    {
        $response = $this->get('/cases');
        $response->assertRedirect('/login');

        $apiResponse = $this->getJson('/api/cases');
        $apiResponse->assertStatus(401);
    }

    public function test_admin_can_create_a_case(): void
    {
        $caseData = [
            'case_number' => 'CASE-TEST-001',
            'patient_reference' => 'PAT-1234',
            'surgeon_name' => 'Dr. Wilson',
            'implant_type' => 'Titanium Plate',
            'status' => 'Planning',
            'priority' => 'High',
            'surgery_date' => '2026-11-20',
        ];

        $response = $this->actingAs($this->admin)->post('/cases', $caseData);
        $response->assertRedirect('/cases');

        $this->assertDatabaseHas('cases', [
            'case_number' => 'CASE-TEST-001',
            'created_by' => $this->admin->id,
        ]);

        $apiCaseData = [
            'case_number' => 'CASE-TEST-002',
            'patient_reference' => 'PAT-5678',
            'surgeon_name' => 'Dr. House',
            'implant_type' => 'Spinal Fusion Cage',
            'status' => 'Approved',
            'priority' => 'Medium',
            'surgery_date' => '2026-12-01',
        ];

        $token = $this->admin->createToken('admin-test-token')->plainTextToken;

        $apiResponse = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->postJson('/api/cases', $apiCaseData);

        $apiResponse->assertStatus(201)
            ->assertJson([
                'success' => true,
                'message' => 'Case created successfully',
            ])
            ->assertJsonPath('data.case_number', 'CASE-TEST-002');
    }

    public function test_creating_a_case_with_a_duplicate_case_number_fails(): void
    {
        MedicalCase::factory()->create([
            'case_number' => 'CASE-DUPLICATE-999',
            'created_by' => $this->admin->id,
        ]);

        $duplicateData = [
            'case_number' => 'CASE-DUPLICATE-999',
            'patient_reference' => 'PAT-999',
            'surgeon_name' => 'Dr. Grey',
            'implant_type' => 'Knee Spacer',
            'status' => 'Planning',
            'priority' => 'Low',
        ];

        $response = $this->actingAs($this->admin)->post('/cases', $duplicateData);
        $response->assertSessionHasErrors('case_number');

        $token = $this->admin->createToken('admin-test-token')->plainTextToken;

        $apiResponse = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->postJson('/api/cases', $duplicateData);

        $apiResponse->assertStatus(422)
            ->assertJson([
                'success' => false,
                'message' => 'Validation error',
            ])
            ->assertJsonValidationErrors('case_number');
    }

    public function test_viewer_cannot_delete_a_case(): void
    {
        $case = MedicalCase::factory()->create([
            'case_number' => 'CASE-TO-DELETE',
            'created_by' => $this->admin->id,
        ]);

        $response = $this->actingAs($this->viewer)->delete("/cases/{$case->id}");
        $response->assertStatus(403);

        $this->assertDatabaseHas('cases', [
            'id' => $case->id,
        ]);

        $token = $this->viewer->createToken('viewer-test-token')->plainTextToken;

        $apiResponse = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->deleteJson("/api/cases/{$case->id}");

        $apiResponse->assertStatus(403)
            ->assertJson([
                'success' => false,
            ]);

        $this->assertDatabaseHas('cases', [
            'id' => $case->id,
        ]);
    }

    public function test_engineer_can_create_and_edit_case_but_cannot_delete(): void
    {
        $engineer = User::factory()->create([
            'email' => 'engineer_test@jajalmedical.com',
            'role' => 'Engineer',
            'password' => bcrypt('password123'),
        ]);

        $caseData = [
            'case_number' => 'CASE-ENG-001',
            'patient_reference' => 'PAT-ENG',
            'surgeon_name' => 'Dr. Wilson',
            'implant_type' => 'Spinal Cage',
            'status' => 'Planning',
            'priority' => 'Medium',
        ];

        // Engineer can create
        $createResponse = $this->actingAs($engineer)->post('/cases', $caseData);
        $createResponse->assertRedirect('/cases');
        $this->assertDatabaseHas('cases', ['case_number' => 'CASE-ENG-001']);

        $case = MedicalCase::where('case_number', 'CASE-ENG-001')->first();

        // Engineer can edit
        $updateResponse = $this->actingAs($engineer)->put("/cases/{$case->id}", [
            'case_number' => 'CASE-ENG-001',
            'patient_reference' => 'PAT-ENG',
            'surgeon_name' => 'Dr. Wilson',
            'implant_type' => 'Spinal Cage',
            'status' => 'In Review',
            'priority' => 'High',
        ]);
        $updateResponse->assertRedirect("/cases/{$case->id}");
        $this->assertEquals('In Review', $case->fresh()->status);

        // Engineer CANNOT delete (403)
        $deleteResponse = $this->actingAs($engineer)->delete("/cases/{$case->id}");
        $deleteResponse->assertStatus(403);
        $this->assertDatabaseHas('cases', ['id' => $case->id]);
    }
}
