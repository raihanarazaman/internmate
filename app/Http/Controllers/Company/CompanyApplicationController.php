<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Application;

class CompanyApplicationController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        if ($user->role !== 'company') {
            abort(403);
        }

        $applications = Application::with([
                'student',
                'internship'
            ])
            ->whereHas('internship', function ($q) use ($user) {
                $q->whereHas('company', function ($q2) use ($user) {
                    $q2->where('user_id', $user->id);
                });
            })
            ->latest()
            ->get();

        return view('company.applications.index', compact('applications'));
    }
}
