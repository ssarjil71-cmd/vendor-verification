<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vendor;

class VendorFormController extends Controller
{
    public function showForm($token)
    {
        $vendor = Vendor::where('token', $token)->first();

        if (!$vendor) {
            abort(404, 'Vendor not found');
        }

        return view('vendor.form', compact('vendor'));
    }

    public function submitForm(Request $request, $token)
    {
        $vendor = Vendor::where('token', $token)->firstOrFail();

        $request->validate([
            'pan_number'     => 'required|string',
            'aadhar_number'  => 'required|string',
            'bank_account'   => 'required|string',
            'ifsc_code'      => 'required|string',
        ]);

        $vendor->update([
            'pan_number'    => $request->pan_number,
            'aadhar_number' => $request->aadhar_number,
            'bank_account'  => $request->bank_account,
            'ifsc_code'     => $request->ifsc_code,
            'status'        => 'pending',  // ✅ Must match ENUM
        ]);


        return redirect()->back()->with('success', 'Form submitted successfully!');
    }
}
