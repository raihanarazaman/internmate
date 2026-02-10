<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
class CompanyStudentController extends Controller
{
    public function show(Student $student)
    {
        $user = auth()->user();

        if ($user->role !== 'company') {
            abort(403);
        }

        // Ensure company has an application with this student
        $hasRelationship = $student->applications()
            ->whereHas('internship', function ($q) use ($user) {
                $q->whereHas('company', function ($q2) use ($user) {
                    $q2->where('user_id', $user->id);
                });
            })
            ->exists();

        if (!$hasRelationship) {
            abort(403);
        }

        return view('company.students.show', compact('student'));
    }
}
