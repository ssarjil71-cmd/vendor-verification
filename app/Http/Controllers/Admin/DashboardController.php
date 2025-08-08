<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;

class DashboardController extends Controller
{
public function index()
{
    $totalCompanies = Company::count();
    $paidCompanies = Company::where('is_paid', 1)->count();
    $unpaidCompanies = Company::where('is_paid', 0)->count();

    return view('admin.dashboard', compact(
        'totalCompanies',
        'paidCompanies',
        'unpaidCompanies'
    ));
}



    // public function pendingCompanies()
    // {
    //     $companies = Company::where('status', 'pending')->get();
    //     return view('admin.companies.pending', compact('companies'));
    // }
}
