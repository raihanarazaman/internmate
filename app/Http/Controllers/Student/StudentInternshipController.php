<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Application;
use App\Models\Internship;

class StudentInternshipController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        if ($user->role !== 'student') {
            abort(403);
        }

        $student = Student::where('user_id', $user->id)->firstOrFail();

        // 🔒 Final admin approval lock
        $hasFinalApproval = Application::where('student_id', $student->id)
            ->where('status', 'admin_approved')
            ->exists();

        // 📄 Internships + company
        $query = Internship::with('company');

        // Optional filters
        if ($request->filled('course')) {
            $query->where('course_required', $request->course);
        }

        if ($request->filled('location')) {
            $query->where('location', $request->location);
        }

        $internships = $query->latest()->get();

        // 🧠 Applied internship IDs
        $appliedInternshipIds = Application::where('student_id', $student->id)
            ->pluck('internship_id');

        return view('student.internships.index', [
            'student' => $student,
            'internships' => $internships,
            'appliedInternshipIds' => $appliedInternshipIds,
            'hasFinalApproval' => $hasFinalApproval,
        ]);
    }
public function show(Internship $internship)
{
    return view('student.internships.show', [
        'internship' => $internship,
        // later you can add:
        // 'canApply' => true/false
    ]);
}


}
