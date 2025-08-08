<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;

class AdminCompanyController extends Controller
{
    public function index()
    {
        $companies = Company::all();
        return view('admin.companies.index', compact('companies'));
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
}
