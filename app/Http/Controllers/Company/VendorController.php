<?php

// app/Http/Controllers/Company/VendorController.php
namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vendor;
use Illuminate\Support\Str;
class VendorController extends Controller
{
    public function index()
    {
        
        $vendors = Vendor::where('company_id', auth('company')->id())->get();

        return view('company.vendors.index', compact('vendors'));
    }

    public function create()
    {
        return view('company.vendors.create');
    }

   public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:vendors,email',
            'phone' => 'required|string|max:15',
        ]);

        $vendor = Vendor::create([
            'name'       => $request->name,
            'email'      => $request->email,
            'phone'      => $request->phone,
            'company_id' => auth('company')->id(),
            'token'      => Str::uuid(), // Unique token
            'status'     => 'pending',
        ]);

        return redirect()->route('company.vendors.index')
            ->with('success', 'Vendor added! Form link generated.');
    }

    public function show($id)
    {
        $vendor = Vendor::findOrFail($id);
        return view('company.vendors.show', compact('vendor'));
    }
}
