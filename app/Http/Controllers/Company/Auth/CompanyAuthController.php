<?php

namespace App\Http\Controllers\Company\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;

class CompanyAuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('company.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:companies,email',
            'password' => 'required|confirmed|min:6',
        ]);

        $company = Company::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'is_active' => 0, // initially inactive until payment/approval
        ]);

        return redirect()->route('company.login')->with('success', 'Registered. Await admin approval.');
    }

    public function showLoginForm()
    {
        return view('company.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('company')->attempt($credentials)) {
            $user = Auth::guard('company')->user();

            if (!$user->is_active) {
                Auth::guard('company')->logout();
                return back()->withErrors(['email' => 'Company not approved yet.']);
            }

            return redirect()->route('company.dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }
}
