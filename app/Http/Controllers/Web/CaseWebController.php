<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCaseRequest;
use App\Http\Requests\UpdateCaseRequest;
use App\Models\MedicalCase;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
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

        $cases = $query->latest('id')->paginate(10)->withQueryString();

        return view('cases.index', compact('cases'));
    }

    public function create(): View
    {
        Gate::authorize('create', MedicalCase::class);

        $case = new MedicalCase();
        return view('cases.form', compact('case'));
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

        return view('cases.form', compact('case'));
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
}
