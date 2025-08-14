<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vendor;

class VendorFormController extends Controller
{
    public function showForm($token)
    {
        $vendor = Vendor::where('token', $token)->firstOrFail();
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
            'status'        => 'submitted',
            'form_filled'   => 1,
        ]);

        // Form submit ke baad thankyou page pe bhejo
        return redirect()->route('vendor.thankyou', ['token' => $vendor->token])
            ->with('success', 'Form submitted successfully!');
    }
}
