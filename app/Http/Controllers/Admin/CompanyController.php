<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::all();
        return view('admin.companies.index', compact('companies'));
    }

    public function create()
    {
        return view('admin.companies.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:companies,email',
            'password' => 'required|min:6',
        ]);

        Company::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.companies.index')->with('success', 'Company created successfully');
    }

    public function paid()
    {
        $companies = Company::where('is_paid', true)->get();
        return view('admin.companies.index', compact('companies'));
    }

    public function unpaid()
    {
        $companies = Company::where('is_paid', false)->get();
        return view('admin.companies.index', compact('companies'));
    }
    public function destroy($id)
    {
        $company = Company::findOrFail($id);

        if ($company->is_paid) {
            return redirect()->back()->with('error', 'Paid companies cannot be deleted!');
        }

        $company->delete();

        return redirect()->back()->with('success', 'Unpaid company deleted successfully!');
    }
    

        public function pending()
    {
        $pendingCompanies = Company::where('status', 'pending')->get();
        return view('admin.companies.pending', compact('pendingCompanies'));
    }

}
