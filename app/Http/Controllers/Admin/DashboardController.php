<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\Admin;
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

        $admin = Admin::where('user_id', $user->id)->firstOrFail();

        // 🔔 Applications waiting for admin decision
        $applications = Application::with([
                'student',
                'internship.company'
            ])
            ->where('status', 'student_submitted')
            ->latest()
            ->get();

        // 🔔 Admin notifications (Laravel)
        $notifications = $admin->unreadNotifications;

        return view('admin.dashboard', compact(
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
}
