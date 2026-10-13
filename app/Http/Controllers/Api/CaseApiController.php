<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCaseRequest;
use App\Http\Requests\UpdateCaseRequest;
use App\Models\MedicalCase;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CaseApiController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = MedicalCase::with('creator');

        if ($request->filled('search')) {
            $search = trim($request->input('search'));
            $query->where(function ($q) use ($search) {
                $q->where('case_number', 'like', "%{$search}%")
                  ->orWhere('surgeon_name', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        $cases = $query->latest('id')->paginate(10);

        return response()->json([
            'success' => true,
            'data' => $cases,
            'message' => 'Cases retrieved successfully',
        ], 200);
    }

    public function store(StoreCaseRequest $request): JsonResponse
    {
        $data = $request->validated();
        $data['created_by'] = $request->user()->id;

        $case = MedicalCase::create($data);
        $case->load('creator');

        return response()->json([
            'success' => true,
            'data' => $case,
            'message' => 'Case created successfully',
        ], 201);
    }

    public function show(string|int $id): JsonResponse
    {
        $case = MedicalCase::with('creator')->find($id);

        if (! $case) {
            return response()->json([
                'success' => false,
                'data' => null,
                'message' => 'Case not found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $case,
            'message' => 'Case retrieved successfully',
        ], 200);
    }

    public function update(UpdateCaseRequest $request, string|int $id): JsonResponse
    {
        $case = MedicalCase::find($id);

        if (! $case) {
            return response()->json([
                'success' => false,
                'data' => null,
                'message' => 'Case not found',
            ], 404);
        }

        $case->update($request->validated());
        $case->load('creator');

        return response()->json([
            'success' => true,
            'data' => $case,
            'message' => 'Case updated successfully',
        ], 200);
    }

    public function destroy(Request $request, string|int $id): JsonResponse
    {
        $case = MedicalCase::find($id);

        if (! $case) {
            return response()->json([
                'success' => false,
                'data' => null,
                'message' => 'Case not found',
            ], 404);
        }

        if (strtolower($request->user()->role) !== 'admin') {
            return response()->json([
                'success' => false,
                'data' => null,
                'message' => 'Unauthorized action. Only Admin can delete cases.',
            ], 403);
        }

        $case->delete();

        return response()->json([
            'success' => true,
            'data' => null,
            'message' => 'Case deleted successfully',
        ], 200);
    }
}
