<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Internship;
class InternshipController extends Controller
{
    
    public function show(Internship $internship)
    {
        $user = auth()->user();

        if ($user->role !== 'admin') {
            abort(403);
        }

        // Load everything admin needs to inspect
        $internship->load([
            'company',
            'applications.student',
        ]);

        return view('admin.internships.show', compact('internship'));
    }
}
