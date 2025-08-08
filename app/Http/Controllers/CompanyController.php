<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

}
