<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\User ;
use App\Models\Application;
use App\Models\Internship;
use App\Notifications\StudentAppliedNotification;
use Illuminate\Support\Facades\DB;
use App\Notifications\ApplicationStatusChanged;
class DashboardController extends Controller
{
    /**
     * Display the student dashboard.
     */
public function index()
{
    $user = auth()->user();

    if ($user->role !== 'student') {
        abort(403);
    }

    $student = Student::where('user_id', $user->id)->firstOrFail();

    // 📊 DASHBOARD STATS ONLY
    $stats = [
        'total_applications' => Application::where('student_id', $student->id)->count(),

        'company_approved' => Application::where('student_id', $student->id)
            ->where('status', 'company_approved')
            ->count(),

        'admin_approved' => Application::where('student_id', $student->id)
            ->where('status', 'admin_approved')
            ->count(),
    ];

    return view('student.dashboard', [
        'student' => $student,
        'stats'   => $stats,
    ]);
}


        public function showProfile()
        {
            $user = auth()->user();

            if ($user->role !== 'student') {
                abort(403);
            }

            $student = Student::where('user_id', $user->id)->firstOrFail();

            return view('student.profile', [
                'student' => $student,
            ]);
        }

    /**
     * Update student profile.
     */
    public function updateProfile(Request $request)
        {
            $user = auth()->user();

            if ($user->role !== 'student') {
                abort(403);
            }

            $student = Student::where('user_id', $user->id)->firstOrFail();

            $request->validate([
                'student_id' => 'required|unique:students,student_id,' . $student->id,
                'full_name'  => 'required|string|max:255',
                'course'     => 'required|string|max:255',
                'cgpa'       => 'nullable|numeric|min:0|max:4',
                'interests'  => 'nullable|string|max:255',
            ]);

            $student->update([
                'student_id' => $request->student_id,
                'full_name'  => $request->full_name,
                'course'     => $request->course,
                'cgpa'       => $request->cgpa,
                'interests'  => $request->interests,
            ]);

            return redirect()
                ->route('student.dashboard')
                ->with('success', 'Profile updated successfully!');
        }

    /**
     * Apply for an internship.
     */
public function apply(Request $request)
{
    $user = auth()->user();

    if ($user->role !== 'student') {
        abort(403);
    }

    $request->validate([
        'internship_id' => ['required', 'exists:internships,id'],
    ]);

    $student = Student::where('user_id', $user->id)->firstOrFail();

    // ❌ Already admin approved
    $hasFinalApproval = Application::where('student_id', $student->id)
        ->where('status', 'admin_approved')
        ->exists();

    if ($hasFinalApproval) {
        return back()->withErrors([
            'You already have an approved internship and cannot apply for another.',
        ]);
    }

    // ❌ Duplicate application
    $alreadyApplied = Application::where('student_id', $student->id)
        ->where('internship_id', $request->internship_id)
        ->exists();

    if ($alreadyApplied) {
        return back()->withErrors([
            'You have already applied to this internship.',
        ]);
    }

    // ✅ Create application
    $application = Application::create([
        'student_id'    => $student->id,
        'internship_id' => $request->internship_id,
        'status'        => 'applied',
    ]);


    // 🔔 NOTIFY COMPANY
    $companyUser = $application
        ->internship
        ->company
        ->user;

    $companyUser->notify(
        new StudentAppliedNotification($application)
    );

    return back()->with('success', 'Application submitted successfully!');
}
        public function submitToAdmin(Application $application)
{
    $user = auth()->user();

    if ($user->role !== 'student') {
        abort(403);
    }

    $student = Student::where('user_id', $user->id)->firstOrFail();

    // Ownership check
    if ($application->student_id !== $student->id) {
        abort(403);
    }

    // Must be company-approved
    if ($application->status !== 'company_approved') {
        return back()->withErrors(['This application cannot be submitted.']);
    }

    // ❌ Already has active submission
    $hasActiveSubmission = Application::where('student_id', $student->id)
        ->where('status', 'student_submitted')
        ->exists();

    if ($hasActiveSubmission) {
        return back()->withErrors([
            'You already submitted an application for admin approval.',
        ]);
    }

    // ❌ Already finally approved
    $hasFinalApproval = Application::where('student_id', $student->id)
        ->where('status', 'admin_approved')
        ->exists();

    if ($hasFinalApproval) {
        return back()->withErrors([
            'You already have an approved internship.',
        ]);
    }

    $application->update([
        'status' => 'student_submitted',
    ]);
    $admins = User::where('role', 'admin')->get();

    foreach ($admins as $admin) {
        $admin->notify(new ApplicationStatusChanged($application));
    }
    // 🔔 Notify admin (later)
    // 🔔 Notify company (optional)

    return back()->with('success', 'Application submitted to admin.');
}

    public function applicationsIndex()
    {
        $user = auth()->user();

        if ($user->role !== 'student') {
            abort(403);
        }

        $student = Student::where('user_id', $user->id)->firstOrFail();

        // Fetch all applications with internship + company
        $applications = Application::with([
                'internship.company'
            ])
            ->where('student_id', $student->id)
            ->orderByDesc('created_at')
            ->get();

        return view('student.applications.index', [
            'student' => $student,
            'applications' => $applications,
        ]);
    }
}