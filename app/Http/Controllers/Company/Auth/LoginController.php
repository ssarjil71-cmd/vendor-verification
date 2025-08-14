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
    /**
     * Show login form (optional, if needed)
     */
    public function showLoginForm()
    {
        return view('company.auth.login');
    }

    /**
     * Handle company login
     */
    public function login(Request $request)
    {
        // ✅ Validate input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // ✅ Find company by email
        $company = Company::where('email', $request->email)->first();

        // ❌ Invalid email or password
        if (!$company || !Hash::check($request->password, $company->password)) {
            return back()->withErrors(['email' => 'Invalid credentials.']);
        }

        // ❌ Not activated
        if (!$company->is_active) {
            return back()->withErrors(['email' => 'Account not active. Please contact admin.']);
        }

        // ❌ Subscription expired
        if ($company->valid_until && Carbon::now()->greaterThan($company->valid_until)) {
            return back()->withErrors(['email' => 'Subscription expired. Please renew.']);
        }

        // ✅ Everything ok — login
        Auth::guard('company')->login($company);

        return redirect()->route('company.dashboard');
    }

    /**
     * Custom logout to avoid "Route [login] not defined" error
     */
    public function logout(Request $request)
    {
        Auth::guard('company')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('company.login');
    }
}
