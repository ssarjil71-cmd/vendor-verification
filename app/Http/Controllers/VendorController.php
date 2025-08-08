<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Vendor;

class VendorController extends Controller
{
    // Display all vendors belonging to the logged-in company
    public function index()
    {
        $vendors = Vendor::where('company_id', auth('company')->id())
                       ->latest()
                       ->get();

        return view('company.vendors.index', compact('vendors'));
    }

    // Show vendor creation form
    public function create()
    {
        return view('company.vendors.create');
    }

    // Store new vendor
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:vendors,email',
            // Add other fields as needed
        ]);

        $vendor = Vendor::create([
            'name'       => $validated['name'],
            'email'      => $validated['email'],
            'company_id' => auth('company')->id(),
            'token'      => Str::uuid(), // Unique token for form submission
            // Add other fields as needed
        ]);

        return redirect()->route('company.vendors.index')
                         ->with('success', 'Vendor added successfully!');
    }

    // Show a single vendor details
    public function show(Vendor $vendor)
    {
        // Implicit model binding with authorization
        $this->authorize('view', $vendor);
        
        return view('company.vendors.show', compact('vendor'));
    }

    // Add these methods if you need edit/update functionality
    public function edit(Vendor $vendor)
    {
        $this->authorize('update', $vendor);
        
        return view('company.vendors.edit', compact('vendor'));
    }

    public function update(Request $request, Vendor $vendor)
    {
        $this->authorize('update', $vendor);

        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:vendors,email,'.$vendor->id,
            // Add other fields as needed
        ]);

        $vendor->update($validated);

        return redirect()->route('company.vendors.index')
                         ->with('success', 'Vendor updated successfully!');
    }

    public function destroy(Vendor $vendor)
    {
        $this->authorize('delete', $vendor);
        
        $vendor->delete();

        return redirect()->route('company.vendors.index')
                         ->with('success', 'Vendor deleted successfully!');
    }
}