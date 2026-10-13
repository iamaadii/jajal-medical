<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCaseRequest;
use App\Http\Requests\UpdateCaseRequest;
use App\Models\MedicalCase;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class CaseWebController extends Controller
{
    public function dashboard(): View
    {
        $total = MedicalCase::count();
        $planning = MedicalCase::where('status', 'Planning')->count();
        $inReview = MedicalCase::where('status', 'In Review')->count();
        $approved = MedicalCase::where('status', 'Approved')->count();
        $completed = MedicalCase::where('status', 'Completed')->count();

        return view('cases.dashboard', compact('total', 'planning', 'inReview', 'approved', 'completed'));
    }

    public function index(Request $request): View
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

        if ($request->filled('priority')) {
            $query->where('priority', $request->input('priority'));
        }

        $allowedSortColumns = ['id', 'case_number', 'patient_reference', 'surgeon_name', 'status', 'priority', 'surgery_date'];
        $sortBy = in_array($request->input('sort'), $allowedSortColumns) ? $request->input('sort') : 'id';
        $direction = strtolower($request->input('direction')) === 'desc' ? 'desc' : 'asc';

        $cases = $query->orderBy($sortBy, $direction)->paginate(10)->withQueryString();

        return view('cases.index', compact('cases', 'sortBy', 'direction'));
    }

    public function create(): View
    {
        Gate::authorize('create', MedicalCase::class);

        $case = new MedicalCase();
        $todayHolidays = $this->fetchTodayPublicHolidays();

        return view('cases.form', compact('case', 'todayHolidays'));
    }

    public function store(StoreCaseRequest $request): RedirectResponse
    {
        Gate::authorize('create', MedicalCase::class);

        $data = $request->validated();
        $data['created_by'] = $request->user()->id;

        MedicalCase::create($data);

        return redirect()->route('cases.index')->with('success', 'Case created successfully.');
    }

    public function show(MedicalCase $case): View
    {
        Gate::authorize('view', $case);

        $case->load('creator');
        return view('cases.show', compact('case'));
    }

    public function edit(MedicalCase $case): View
    {
        Gate::authorize('update', $case);

        $todayHolidays = $this->fetchTodayPublicHolidays();
        return view('cases.form', compact('case', 'todayHolidays'));
    }

    public function update(UpdateCaseRequest $request, MedicalCase $case): RedirectResponse
    {
        Gate::authorize('update', $case);

        $case->update($request->validated());

        return redirect()->route('cases.show', $case)->with('success', 'Case updated successfully.');
    }

    public function destroy(MedicalCase $case): RedirectResponse
    {
        Gate::authorize('delete', $case);

        $case->delete();

        return redirect()->route('cases.index')->with('success', 'Case deleted successfully.');
    }

    private function fetchTodayPublicHolidays(): array
    {
        $apiUrl = config('services.nager_date.url', env('NAGER_DATE_API_URL', 'https://date.nager.at/api/v3'));
        $timeout = (int) config('services.nager_date.timeout', env('NAGER_DATE_TIMEOUT', 3));
        $year = now()->year;
        $today = now()->format('Y-m-d');

        try {
            $response = Http::timeout($timeout)
                ->acceptJson()
                ->get("{$apiUrl}/PublicHolidays/{$year}/US");

            if ($response->successful()) {
                $holidays = $response->json();
                $matched = array_filter($holidays, fn ($h) => ($h['date'] ?? '') === $today);
                return array_values($matched);
            }
        } catch (\Throwable $e) {
            Log::warning('Nager.Date public API call failed gracefully: ' . $e->getMessage());
        }

        return [];
    }
}
