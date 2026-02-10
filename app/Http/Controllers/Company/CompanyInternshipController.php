<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Internship;
use App\Models\Company;
use App\Notifications\ApplicationStatusChanged;

class CompanyInternshipController extends Controller
{
      public function index()
    {
        $company = Company::where('user_id', auth()->id())->firstOrFail();

        $internships = Internship::where('company_id', $company->id)
            ->latest()
            ->get();

        return view('company.internships.index', compact('internships'));
    }

    public function create()
    {
        return view('company.internships.create');
    }

    public function store(Request $request)
    {
        $company = Company::where('user_id', auth()->id())->firstOrFail();

        $validated = $request->validate([
            'job_name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'duration' => 'required|string|max:100',
            'allowance' => 'nullable|numeric|min:0',
            'course_required' => 'required|string|max:255',
            'min_cgpa' => 'nullable|numeric|min:0|max:4',
            'description' => 'required|string',
            'job_scope' => 'required|string',
            'hostel_provided' => 'nullable|boolean',
        ]);

        Internship::create([
            'company_id' => $company->id,
            ...$validated,
            'hostel_provided' => $request->boolean('hostel_provided'),
        ]);

        return redirect()
            ->route('company.internships.index')
            ->with('success', 'Internship posted successfully.');
    }

    public function edit(Internship $internship)
    {
        $this->authorizeOwnership($internship);

        return view('company.internships.edit', compact('internship'));
    }

    public function update(Request $request, Internship $internship)
    {
        $this->authorizeOwnership($internship);

        $validated = $request->validate([
            'job_name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'duration' => 'required|string|max:100',
            'allowance' => 'nullable|numeric|min:0',
            'course_required' => 'required|string|max:255',
            'min_cgpa' => 'nullable|numeric|min:0|max:4',
            'description' => 'required|string',
            'job_scope' => 'required|string',
            'hostel_provided' => 'nullable|boolean',
        ]);

        $internship->update([
            ...$validated,
            'hostel_provided' => $request->boolean('hostel_provided'),
        ]);

        return back()->with('success', 'Internship updated.');
    }

    public function destroy(Internship $internship)
    {
        $this->authorizeOwnership($internship);

        $internship->delete();

        return back()->with('success', 'Internship deleted.');
    }

    private function authorizeOwnership(Internship $internship)
    {
        $company = Company::where('user_id', auth()->id())->firstOrFail();

        if ($internship->company_id !== $company->id) {
            abort(403);
        }
    }
}
