<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class CompanyDashboardController extends Controller
{
    public function profile()
    {
        return view('company.profile');
    }

   public function index()
    {
        $company = Auth::guard('company')->user();

        if (!$company->is_paid) {
            Auth::guard('company')->logout(); // logout unpaid company
            return redirect()->route('company.login')->with('error', 'Please complete your payment to access dashboard.');
        }

        $companyId = $company->id;
        $vendorsCount = Vendor::where('company_id', $companyId)->count();

        return view('company.dashboard', compact('vendorsCount'));
    }

    

    public function showPlans()
    {
        return view('company.plans');
    }

    public function selectPlan(Request $request)
    {
        $request->validate([
            'plan_name' => 'required|string',
        ]);

        $company = Auth::guard('company')->user();
        $company->plan_name = $request->plan_name;
        $company->is_paid = false; // Not yet paid
        $company->save();

        return redirect()->route('company.payment.qr')->with('success', 'Plan selected. Please complete the payment.');
    }

    public function showQr()
    {
        $company = Auth::guard('company')->user();

        if (!$company->plan_name) {
            return redirect()->route('company.plans')->with('error', 'Please select a plan first.');
        }

        return view('company.qr', compact('company'));
    }
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        $company = Auth::guard('company')->user();

        if (!Hash::check($request->current_password, $company->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        $company->password = Hash::make($request->new_password);
        $company->save();

        return back()->with('success', 'Password changed successfully.');
    }


    }
