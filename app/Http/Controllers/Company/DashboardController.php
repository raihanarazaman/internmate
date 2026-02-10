<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Company;
use App\Models\User;
use App\Models\Internship;
use Illuminate\Http\Request;
use App\Notifications\ApplicationStatusChanged;
use Illuminate\Support\Facades\Notification;
class DashboardController extends Controller
{
    public function index()
{
    $user = auth()->user();

    if ($user->role !== 'company') {
        abort(403);
    }

    $company = Company::where('user_id', $user->id)->firstOrFail();

    $stats = [
        'internships' => Internship::where('company_id', $company->id)->count(),
        'applications' => Application::whereHas('internship', function ($q) use ($company) {
            $q->where('company_id', $company->id);
        })->count(),
        'pending' => Application::whereHas('internship', function ($q) use ($company) {
            $q->where('company_id', $company->id);
        })->where('status', 'applied')->count(),
    ];

    return view('company.dashboard', compact('company', 'stats'));
}
        public function updateProfile(Request $request)
        {
            $user = auth()->user();

            if ($user->role !== 'company') {
                abort(403);
            }

            $company = Company::where('user_id', $user->id)->firstOrFail();

            // Validate
            $request->validate([
                'company_name' => 'required|string|max:255',
                'company_email' => 'required|email|unique:companies,company_email,' . $company->id,
                'location' => 'required|string|max:255',
            ]);

            // Update company
            $company->update([
                'company_name'  => $request->company_name,
                'company_email' => $request->company_email,
                'location'      => $request->location,
            ]);

            return back()->with('success', 'Company profile updated successfully!');
        }

   public function storeInternship(Request $request)
{
    $user = auth()->user();

    // Safety (middleware already ensures this)
    if ($user->role !== 'company') {
        abort(403);
    }

    // Get company via user_id (NOT email, NOT session)
    $company = Company::where('user_id', $user->id)->first();

    if (!$company) {
        abort(404, 'Company profile not found');
    }

    // Validate input
    $request->validate([
        'job_name' => 'required|string|max:255',
        'course_required' => 'required|string|max:255',
        'min_cgpa' => 'required|numeric|min:0|max:4',
        'location' => 'required|string|max:255',
        'duration' => 'required|string|max:100',
        'allowance' => 'nullable|numeric|min:0',
        'hostel_provided' => 'nullable',
    ]);

    // Create internship
    Internship::create([
        'company_id' => $company->id,
        'job_name' => $request->job_name,
        'course_required' => $request->course_required,
        'min_cgpa' => $request->min_cgpa,
        'location' => $request->location,
        'duration' => $request->duration,
        'hostel_provided' => $request->boolean('hostel_provided'),
        'allowance' => $request->allowance,
    ]);

    return back()->with('success', 'Internship posted successfully!');
}

public function updateApplication(Request $request, Application $application)
{
    $user = auth()->user();

    if ($user->role !== 'company') {
        abort(403);
    }

    $request->validate([
        'status' => ['required', 'in:company_approved,company_rejected'],
    ]);

    // ❌ Admin already decided
    if (in_array($application->status, ['admin_approved', 'admin_rejected'])) {
        return back()->withErrors([
            'This application has already been finalized by admin.',
        ]);
    }

    // ❌ Company already decided
    if (in_array($application->status, ['company_approved', 'company_rejected'])) {
        return back()->withErrors([
            'You have already decided on this application.',
        ]);
    }

    // ✅ Update
    $application->update([
        'status' => $request->status,
        'company_decision_at' => now(),
    ]);

    // 🔔 Notify STUDENT
        $studentUser = $application->student->user;

        $studentUser->notify(
            new ApplicationStatusChanged($application)
        );

    // 🔔 Notify ADMINS
    $admins = User::where('role', 'admin')->get();

    foreach ($admins as $admin) {
        $admin->notify(
            new ApplicationStatusChanged($application)
        );
    }

    return back()->with('success', 'Application decision saved.');
}
    public function destroyApplication(Application $application)
    {
        $application->delete();
        return back();
    }
}