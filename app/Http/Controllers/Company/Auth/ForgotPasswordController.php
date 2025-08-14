<?php

namespace App\Http\Controllers\Company\Auth;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class ForgotPasswordController extends Controller
{
    public function showForgotForm()
    {
        return view('company.auth.forgot-password');
    }

    public function sendOtp(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $company = Company::where('email', $request->email)->first();

        if (!$company) {
            return back()->withErrors(['email' => 'Company not found']);
        }

        $otp = rand(100000, 999999);
        $company->reset_otp = $otp;
        $company->otp_expires_at = Carbon::now()->addMinutes(10);
        $company->save();

        // Email the OTP
        Mail::raw("Your OTP is: $otp (valid for 10 minutes)", function ($message) use ($company) {
            $message->to($company->email)->subject('Company Password Reset OTP');
        });

        session(['company_email' => $company->email]);

        return redirect()->route('company.verify.form')->with('status', 'OTP sent to your email');
    }

    public function showVerifyForm()
    {
        return view('company.auth.verify-otp');
    }

    public function verifyOtp(Request $request)
    {
        $request->validate(['otp' => 'required|digits:6']);

        $company = Company::where('email', session('company_email'))->first();

        if (!$company || $company->reset_otp != $request->otp) {
            return back()->withErrors(['otp' => 'Invalid OTP']);
        }

        if (Carbon::now()->gt($company->otp_expires_at)) {
            return back()->withErrors(['otp' => 'OTP expired']);
        }

        session(['otp_verified' => true]);

        return redirect()->route('company.reset.form');
    }

    public function showResetForm()
    {
        if (!session('otp_verified')) {
            return redirect()->route('company.forgot.form');
        }
        return view('company.auth.reset-password');
    }

    public function resetPassword(Request $request)
    {
        if (!session('otp_verified')) {
            return redirect()->route('company.forgot.form');
        }

        $request->validate([
            'password' => 'required|min:6|confirmed',
        ]);

        $company = Company::where('email', session('company_email'))->first();
        $company->password = Hash::make($request->password);
        $company->reset_otp = null;
        $company->otp_expires_at = null;
        $company->save();

        session()->forget(['company_email', 'otp_verified']);

        return redirect()->route('company.login')->with('status', 'Password reset successfully');
    }
}
