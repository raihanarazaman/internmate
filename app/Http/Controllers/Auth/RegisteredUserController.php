<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Student;
use App\Models\Admin;
use App\Models\Company;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
   public function store(Request $request): RedirectResponse
    {
         
        $request->validate([
            // ================= COMMON USER =================
            'name' => ['required', 'string', 'max:255'], // username
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:student,company,admin'],

            // ================= STUDENT =================
            'student_id' => ['required_if:role,student', 'string', 'max:50', 'unique:students,student_id'],
            'full_name'  => ['required_if:role,student', 'string', 'max:255'],
            'course'     => ['required_if:role,student', 'string', 'max:255'],
            'cgpa'       => ['nullable', 'numeric', 'between:0,4'],
            'interests'  => ['nullable', 'string', 'max:255'],

            // ================= COMPANY =================
            'company_name'  => ['required_if:role,company', 'string', 'max:255'],
            'company_email' => ['required_if:role,company', 'email', 'max:255'],
            'location'      => ['required_if:role,company', 'string', 'max:255'],

            // ================= ADMIN =================
            'staff_id'        => ['required_if:role,admin', 'string', 'max:50', 'unique:admins,staff_id'],
            'admin_full_name' => ['required_if:role,admin', 'string', 'max:255'],
        ]);

        // ================= CREATE USER =================
        $user = User::create([
            'name' => $request->name, // username
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        // ================= CREATE ROLE PROFILE =================
        if ($user->role === 'student') {
           Student::create([
                'user_id'    => $user->id,
                'student_id' => $request->student_id,
                'full_name'  => $request->full_name,
                'course'     => $request->course,
                'cgpa'       => $request->cgpa,
                'interests'  => $request->interests,
            ]);
        }

        if ($user->role === 'company') {
            Company::create([
                'user_id'       => $user->id,
                'company_name'  => $request->company_name,
                'company_email' => $request->company_email,
                'location'      => $request->location,
            ]);
        }

        if ($user->role === 'admin') {
            Admin::create([
                'user_id'   => $user->id,
                'staff_id'  => $request->staff_id,
                'full_name' => $request->admin_full_name,
            ]);
        }

        // ================= LOGIN & REDIRECT =================
        event(new Registered($user));
        Auth::login($user);
       \Log::info('User registered', [
        'id' => auth()->id(),
        'role' => auth()->user()->role,
        'is_logged_in' => auth()->check()
    ]);
     $route = match ($user->role) {
        'student' => 'student.dashboard',
        'company' => 'company.dashboard',
        'admin' => 'admin.dashboard',
    };
     \Log::info('Redirecting to: ' . $route);
    return redirect()->route($route);
    }

}
