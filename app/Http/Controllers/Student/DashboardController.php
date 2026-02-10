<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student ;
use App\Models\User ;
use App\Models\Application;
use App\Models\Internship;
use Illuminate\Support\Facades\DB;
use App\Notifications\ApplicationStatusChanged;
class DashboardController extends Controller
{
    /**
     * Display the student dashboard.
     */
public function index(Request $request)
{
    $user = auth()->user();

    if ($user->role !== 'student') {
        abort(403);
    }

    $student = Student::where('user_id', $user->id)->first();

    if (!$student) {
        abort(404, 'Student profile not found');
    }

    // Notifications


    // 🔒 FINAL admin approval check (ONLY lock here)
    $hasFinalApproval = Application::where('student_id', $student->id)
        ->where('status', 'admin_approved')
        ->exists();

    // 🟢 Company-approved offers (student must choose)
    $companyApprovedApplications = Application::with('internship.company')
        ->where('student_id', $student->id)
        ->where('status', 'company_approved')
        ->get();

    // Internship filters (still visible until admin approves)
    $query = Internship::with('company');

    if ($request->filled('course')) {
        $query->where('course_required', $request->course);
    }

    if ($request->filled('location')) {
        $query->where('location', $request->location);
    }

    $internships = $query->get();

    // Already-applied internships
    $appliedInternshipIds = Application::where('student_id', $student->id)
        ->pluck('internship_id');

    return view('student.dashboard', [
        'student' => $student,
        'internships' => $internships,
        'hasApprovedApplication' => $hasFinalApproval, // FINAL only
        'companyApprovedApplications' => $companyApprovedApplications,
        'appliedInternshipIds' => $appliedInternshipIds,
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

            // Safety (middleware already protects this)
            if ($user->role !== 'student') {
                abort(403);
            }

            $request->validate([
                'internship_id' => ['required', 'exists:internships,id'],
            ]);

            // Source of truth: student via user_id
            $student = Student::where('user_id', $user->id)->firstOrFail();

            // ❌ Block if student already has a FINAL approved internship
            $hasFinalApproval = Application::where('student_id', $student->id)
                ->where('status', 'admin_approved')
                ->exists();

            if ($hasFinalApproval) {
                return back()->withErrors([
                    'You already have an approved internship and cannot apply for another.',
                ]);
            }

            // ❌ Block duplicate application to same internship
            $alreadyApplied = Application::where('student_id', $student->id)
                ->where('internship_id', $request->internship_id)
                ->exists();

            if ($alreadyApplied) {
                return back()->withErrors([
                    'You have already applied to this internship.',
                ]);
            }

            // ✅ Create application (INITIAL STATE)
            Application::create([
                'student_id'    => $student->id,
                'internship_id' => $request->internship_id,
                'status'        => 'applied',
            ]);

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

}