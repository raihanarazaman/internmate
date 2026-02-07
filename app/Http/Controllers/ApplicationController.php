<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Student;


class ApplicationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'internship_id' => 'required|exists:internships,id',
        ]);

        // Get student ID from session
        $student = Student::where('student_id', session('student_id'))->first();        if (!$student) {
            return back()->withErrors(['Student not found.']);
        }

        // Prevent duplicate applications
        $exists = DB::table('applications')
            ->where('student_id', $student->id)
            ->where('internship_id', $request->internship_id)
            ->exists();

        if ($exists) {
            return back()->withErrors(['You have already applied to this internship.']);
        }

        // Create application
        DB::table('applications')->insert([
            'student_id' => $student->id,
            'internship_id' => $request->internship_id,
            'status' => 'pending',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return back()->with('success', 'Application submitted successfully!');
    }

    public function update(Request $request, $id)
    {
        // Approve application
        DB::table('applications')
            ->where('id', $id)
            ->update(['status' => 'approved']);

        // Get student ID from application
        $application = DB::table('applications')->find($id);
        $student = DB::table('students')->find($application->student_id);

        // Create notification
        DB::table('notifications')->insert([
            'student_id' => $student->student_id, // e.g., CD22033
            'type' => 'application_approved',
            'message' => "Your application for {$application->internship_id} has been approved!",
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return back()->with('success', 'Application approved!');
    }

    public function destroy($id)
    {
        // Get student info before deleting
        $application = DB::table('applications')->find($id);
        $student = DB::table('students')->find($application->student_id);

        // Delete application
        DB::table('applications')->where('id', $id)->delete();

        // Create rejection notification
        DB::table('notifications')->insert([
            'student_id' => $student->student_id,
            'type' => 'application_rejected',
            'message' => "Your application for {$application->internship_id} has been rejected.",
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return back()->with('success', 'Application rejected!');
    }
}