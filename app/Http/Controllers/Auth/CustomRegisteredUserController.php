<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Student;
use App\Models\Company;

class CustomRegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'role' => 'required|in:student,company',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($request->role === 'student') {
            $request->validate([
                'student_id' => 'required|unique:students,student_id',
                'full_name' => 'required|string|max:255',
                'course' => 'required|string|max:255',
            ]);

            Student::create([
                'student_id' => $request->student_id,
                'full_name' => $request->full_name,
                'course' => $request->course,
                'password' => Hash::make($request->password),
            ]);

            session([
                'logged_in_as' => 'student',
                'student_id' => $request->student_id,
                'full_name' => $request->full_name,
                'course' => $request->course,
            ]);

            return redirect('/student/dashboard');

        } else {
            $request->validate([
                'email' => 'required|email|unique:companies,email',
                'company_name' => 'required|string|max:255',
                'location' => 'required|string|max:255',
            ]);

            Company::create([
                'email' => $request->email,
                'company_name' => $request->company_name,
                'location' => $request->location,
                'password' => Hash::make($request->password),
            ]);

            session([
                'logged_in_as' => 'company',
                'email' => $request->email,
                'company_name' => $request->company_name,
                'location' => $request->location,
            ]);

            return redirect('/company/dashboard');
        }
    }
}