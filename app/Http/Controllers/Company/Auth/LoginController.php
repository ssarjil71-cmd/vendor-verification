<?php

namespace App\Http\Controllers\Company\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Company;
use Carbon\Carbon;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // ✅ Validate input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // ✅ Find company by email
        $company = Company::where('email', $request->email)->first();

        // ❌ If not found or password invalid
        if (!$company || !Hash::check($request->password, $company->password)) {
            return back()->withErrors(['email' => 'Invalid credentials.']);
        }

        // ❌ If not activated
        if (!$company->is_active) {
            return back()->withErrors(['email' => 'Account not active. Please contact admin.']);
        }

        // ❌ If subscription expired
        if ($company->valid_until && Carbon::now()->greaterThan($company->valid_until)) {
            return back()->withErrors(['email' => 'Subscription expired. Please renew.']);
        }

        // ✅ Everything OK, login now
        Auth::guard('company')->login($company);

        return redirect()->route('company.dashboard');
    }
}
