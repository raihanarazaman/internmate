<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\Admin;
use App\Models\Student;
use App\Notifications\ApplicationStatusChanged;
use Illuminate\Support\Facades\Notification;
class DashboardController extends Controller
{
    public function index()
{
    $user = auth()->user();

    if ($user->role !== 'admin') {
        abort(403);
    }

    // 🔔 Notifications
    $notifications = $user->unreadNotifications;

    // 👩‍🎓 ALL students (even those without applications)
    $students = Student::withCount([
        'applications',
        'applications as admin_approved_count' => function ($q) {
            $q->where('status', 'admin_approved');
        }
    ])->get();

    // 📄 Applications SUBMITTED by students for admin approval
    $applications = Application::with([
        'student',
        'internship.company',
    ])
        ->where('status', 'student_submitted')
        ->latest()
        ->get();

    return view('admin.dashboard', compact(
        'students',
        'applications',
        'notifications'
    ));
}


    public function approve(Application $application)
    {
        $this->guardAdmin();

        if ($application->status !== 'student_submitted') {
            return back()->withErrors(['Invalid application state.']);
        }

        $application->update([
            'status' => 'admin_approved',
            'admin_decision_at' => now(),
        ]);

        // 🔔 notify student
        $application->student->notify(
            new ApplicationStatusChanged($application)
        );

        return back()->with('success', 'Application approved.');
    }

    public function reject(Application $application)
    {
        $this->guardAdmin();

        if ($application->status !== 'student_submitted') {
            return back()->withErrors(['Invalid application state.']);
        }

        $application->update([
            'status' => 'admin_rejected',
            'admin_decision_at' => now(),
        ]);

        // 🔔 notify student
        $application->student->notify(
            new ApplicationStatusChanged($application)
        );

        return back()->with('success', 'Application rejected.');
    }

    private function guardAdmin()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }
    }

     public function showStudent(Student $student)
    {
        $user = auth()->user();

        if ($user->role !== 'admin') {
            abort(403);
        }

        $student->load([
            'applications.internship.company',
        ]);

        return view('admin.students.show', compact('student'));
    }
}
