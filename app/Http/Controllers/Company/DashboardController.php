<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Company as CompanyModel;
use App\Models\Internship;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $company = CompanyModel::where('email', session('email'))->firstOrFail();
        $applications = Application::whereHas('internship', fn($q) => $q->where('company_id', $company->id))
            ->with('student', 'internship')
            ->get();

        $query = Application::with(['student', 'internship'])
        ->join('students', 'applications.student_id', '=', 'students.id');

        if ($request->filled('min_cgpa')) {
            $query->where('students.cgpa', '>=', $request->min_cgpa);
        }
        if ($request->filled('max_cgpa')) {
            $query->where('students.cgpa', '<=', $request->max_cgpa);
        }

        $applications = $query->select('applications.*')->get();

            return view('company.dashboard', compact('applications'));
        }

    public function updateProfile(Request $request)
    {
        // Get current company
        $company = \App\Models\Company::where('email', session('email'))->first();

        if (!$company) {
            return redirect('/login')->withErrors(['Company not found.']);
        }

        // Validate
        $request->validate([
            'company_name' => 'required|string|max:255',
            'email' => 'required|email|unique:companies,email,' . $company->id,
            'location' => 'required|string|max:255',
        ]);

        // Update database
        $company->update([
            'company_name' => $request->company_name,
            'email' => $request->email,
            'location' => $request->location,
        ]);

        // Update session
        session([
            'company_name' => $request->company_name,
            'email' => $request->email,
            'location' => $request->location,
        ]);

        return back()->with('success', 'Company profile updated successfully!');
    }

    public function storeInternship(Request $request)
    {
        $company = CompanyModel::where('email', session('email'))->firstOrFail();
        
        Internship::create([
            'company_id' => $company->id,
            'job_name' => $request->job_name,
            'course_required' => $request->course_required,
            'min_cgpa' => $request->min_cgpa,
            'location' => $request->location,
            'duration' => $request->duration,
            'hostel_provided' => $request->has('hostel_provided'),
            'allowance' => $request->allowance,
        ]);

        return back()->with('success', 'Internship posted!');
    }

    public function updateApplication(Application $application, Request $request)
    {
        $application->update(['status' => $request->status]);
        return back();
    }

    public function destroyApplication(Application $application)
    {
        $application->delete();
        return back();
    }
}