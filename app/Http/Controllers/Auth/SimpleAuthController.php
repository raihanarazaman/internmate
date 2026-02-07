<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class SimpleAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $input = $request->email;

        // Student login (non-email)
        if (!filter_var($input, FILTER_VALIDATE_EMAIL)) {
            $student = Student::where('student_id', $input)->first();
            if ($student && Hash::check($request->password, $student->password)) {
                session([
                    'logged_in_as' => 'student',
                    'student_id' => $student->student_id,
                    'full_name' => $student->full_name,
                    'course' => $student->course,
                    'cgpa' => $student->cgpa,
                    'interests' => $student->interests,
                ]);
                return redirect('/student/dashboard');
            }
        }

        // Company login (email)
        $company = Company::where('email', $input)->first();
        if ($company && Hash::check($request->password, $company->password)) {
            session([
                'logged_in_as' => 'company',
                'email' => $company->email,
                'company_name' => $company->company_name,
                'location' => $company->location,
            ]);
            return redirect('/company/dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function logout()
    {
        session()->flush();
        return redirect('/login');
    }
}