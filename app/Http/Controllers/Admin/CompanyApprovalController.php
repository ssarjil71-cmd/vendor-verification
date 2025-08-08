<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CompanyApprovalController extends Controller
{
    public function index()
    {
        // Get only companies that are unpaid (pending approval)
        $pendingCompanies = Company::where('is_paid', false)->get();
        return view('admin.pending-companies', compact('pendingCompanies'));
    }

    public function approve($id)
    {
        $company = Company::findOrFail($id);
        $company->is_paid = true; // Mark as approved/paid
        $company->save();

        return redirect()->route('admin.pending.companies')->with('success', 'Company approved successfully!');
    }

    public function reject($id)
    {
        $company = Company::findOrFail($id);
        $company->delete(); // Or set a status flag instead of deleting

        return redirect()->route('admin.pending.companies')->with('error', 'Company rejected and deleted.');
    }
    public function activate($id)
    {
        $company = Company::findOrFail($id);

        $company->is_active = true;
        $company->valid_until = Carbon::now()->addMonth(); // 1 month access
        $company->is_paid = true; // ✅ IMPORTANT: Mark as paid

        $company->save();

        return redirect()->back()->with('success', 'Company activated for 1 month and marked as paid.');
    }

}
