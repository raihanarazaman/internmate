<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;
class CompanyProfileController extends Controller
{
   public function edit()
    {
        $user = auth()->user();

        if ($user->role !== 'company') {
            abort(403);
        }

        $company = Company::where('user_id', $user->id)->firstOrFail();

        return view('company.profile.edit', compact('company'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        if ($user->role !== 'company') {
            abort(403);
        }

        $company = Company::where('user_id', $user->id)->firstOrFail();

        $validated = $request->validate([
            'company_name'  => 'required|string|max:255',
            'company_email' => 'required|email|unique:companies,company_email,' . $company->id,
            'location'      => 'required|string|max:255',
            'description'   => 'nullable|string|max:1000',
        ]);

        $company->update($validated);

        return back()->with('success', 'Company profile updated successfully.');
    }
}
