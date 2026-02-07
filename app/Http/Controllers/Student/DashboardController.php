<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student as StudentModel;
use App\Models\Application;
use App\Models\Internship;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display the student dashboard.
     */
    public function index(Request $request)
    {
        // Get student from session
        $studentId = session('student_id');
        if (!$studentId) {
            return redirect('/login');
        }

        $student = \App\Models\Student::where('student_id', $studentId)->first();
        if (!$student) {
            return redirect('/login')->withErrors(['Student not found.']);
        }

        // ✅ ALWAYS load notifications (for both approved and non-approved cases)
        $notifications = \Illuminate\Support\Facades\DB::table('notifications')
            ->where('student_id', $studentId)
            ->where('read', false)
            ->get();

        // Check for approved application
        $hasApprovedApplication = \App\Models\Application::where('student_id', $student->id)
            ->where('status', 'approved')
            ->exists();

        if ($hasApprovedApplication) {
            $approvedApplication = \App\Models\Application::with('internship.company')
                ->where('student_id', $student->id)
                ->where('status', 'approved')
                ->first();

            return view('student.dashboard', [
                'internships' => collect(),
                'hasApprovedApplication' => true,
                'approvedInternship' => $approvedApplication,
                'appliedInternshipIds' => collect(),
                'notifications' => $notifications // 👈 Now defined!
            ]);
        }

        // Build query with filters
        $query = \App\Models\Internship::with('company');

        if ($request->filled('course')) {
            $query->where('course_required', $request->course);
        }
        if ($request->filled('location')) {
            $query->where('location', $request->location);
        }

        $internships = $query->get();

        $appliedInternshipIds = \App\Models\Application::where('student_id', $student->id)
            ->pluck('internship_id');

        // ✅ Pass $notifications here too
        return view('student.dashboard', compact(
            'internships',
            'hasApprovedApplication',
            'appliedInternshipIds',
            'notifications' // 👈 Now always defined
        ));
    }


    public function showProfile()
    {
        // Get student from session
        $studentId = session('student_id');
        $student = \App\Models\Student::where('student_id', $studentId)->first();

        if (!$student) {
            return redirect('/login');
        }

        return view('student.profile', [
            'student' => $student
        ]);
    }

    /**
     * Update student profile.
     */
    public function updateProfile(Request $request)
    {
        // Get current student
        $student = \App\Models\Student::where('student_id', session('student_id'))->first();

        if (!$student) {
            return redirect('/login');
        }

        // Validate
        $request->validate([
            'student_id' => 'required|unique:students,student_id,' . $student->id,
            'full_name' => 'required|string|max:255',
            'course' => 'required|string|max:255',
            'cgpa' => 'nullable|numeric|min:0|max:4',
            'interests' => 'nullable|string|max:255',
        ]);

        // Update database
        $student->update([
            'student_id' => $request->student_id,
            'full_name' => $request->full_name,
            'course' => $request->course,
            'cgpa' => $request->cgpa,
            'interests' => $request->interests,
        ]);

        // ✅ CRITICAL: Update session with NEW values
        session([
            'student_id' => $request->student_id,
            'full_name' => $request->full_name,
            'course' => $request->course,
            'cgpa' => $request->cgpa,
            'interests' => $request->interests,
        ]);

        // ✅ Redirect to dashboard (not back!)
        return redirect()->route('student.dashboard')->with('success', 'Profile updated successfully!');
    }

    /**
     * Apply for an internship.
     */
    public function apply(Request $request)
    {
        // Validate
        $request->validate([
            'internship_id' => 'required|exists:internships,id',
        ]);

        // Get student
        $student = StudentModel::where('student_id', session('student_id'))->first();
        if (!$student) {
            return back()->withErrors(['Student not found.']);
        }

        // Check if already applied
        if (Application::where('student_id', $student->id)
            ->where('internship_id', $request->internship_id)
            ->exists()) {
            return back()->withErrors(['You have already applied to this internship.']);
        }

        // Check if already approved for another internship
        if (Application::where('student_id', $student->id)
            ->where('status', 'approved')
            ->exists()) {
            return back()->withErrors(['You already have an approved internship and cannot apply to others.']);
        }

        // Create application
        Application::create([
            'student_id' => $student->id,
            'internship_id' => $request->internship_id,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Application submitted successfully!');
    }
}