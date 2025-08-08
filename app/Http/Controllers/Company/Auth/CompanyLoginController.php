<?php
namespace App\Http\Controllers\Company\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CompanyLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('company.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('company')->attempt($credentials)) {
            $company = Auth::guard('company')->user();

            // Check if company is paid
            if (!$company->is_paid) {
                Auth::guard('company')->logout();
                return redirect()->route('company.login')->with('error', 'Your account is pending payment approval.');
            }

            // Check if company is active
            if (!$company->is_active) {
                Auth::guard('company')->logout();
                return redirect()->route('company.login')->with('error', 'Your account is not activated yet.');
            }

            // Check if subscription is expired
            if ($company->valid_until && Carbon::now()->gt($company->valid_until)) {
                Auth::guard('company')->logout();
                return redirect()->route('company.login')->with('error', 'Your subscription has expired.');
            }

            return redirect()->route('company.dashboard');
        }

        return redirect()->back()->with('error', 'Invalid credentials');
    }

   public function logout(Request $request)
    {
        Auth::guard('company')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('company.login'); // 👈 Fix: Use correct named route
    }

}
