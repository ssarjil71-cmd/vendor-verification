<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vendor;
use Illuminate\Support\Str;
use PDF;

class VendorController extends Controller
{
    /**
     * Display all vendors for the logged-in company.
     */
    public function index()
    {
        $vendors = Vendor::where('company_id', auth('company')->id())->get();
        return view('company.vendors.index', compact('vendors'));
    }

    /**
     * Show vendor creation form.
     */
    public function create()
    {
        $verifications = [
            'pan_number'       => ['label' => 'PAN', 'price' => 5],
            'aadhar_number'    => ['label' => 'Aadhar', 'price' => 2],
            'gst_number'       => ['label' => 'GST', 'price' => 3],
            'voter_id'         => ['label' => 'Voter ID', 'price' => 4],
            'dl_number'        => ['label' => 'Driving License', 'price' => 6],
            'passport'         => ['label' => 'Passport', 'price' => 7],
            'ration_card'      => ['label' => 'Ration Card', 'price' => 4],
            'electricity_bill' => ['label' => 'Electricity Bill', 'price' => 1],
            'bank_statement'   => ['label' => 'Bank Statement', 'price' => 2],
        ];

        return view('company.vendors.create', compact('verifications'));
        
    }

    /**
     * Store new vendor and generate token.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:vendors,email',
            'phone' => 'required|string|max:15',
        ]);

        Vendor::create([
            'name'       => $request->name,
            'email'      => $request->email,
            'phone'      => $request->phone,
            'company_id' => auth('company')->id(),
            'token'      => Str::uuid(),
            'status'     => 'pending',
            'form_filled'=> 0,
        ]);

        return redirect()->route('company.vendors.index')
            ->with('success', 'Vendor added! Form link generated.');
    }

    /**
     * Show vendor details in company dashboard.
     */
    public function show($id)
    {
        $vendor = Vendor::findOrFail($id);
        return view('company.vendors.show', compact('vendor'));
    }

    /**
     * Approve vendor.
     */
    public function approve($id)
    {
        Vendor::findOrFail($id)->update(['status' => 'approved']);
        return back()->with('success', 'Vendor approved successfully.');
    }

    /**
     * Reject vendor.
     */
    public function reject($id)
    {
        Vendor::findOrFail($id)->update(['status' => 'rejected']);
        return back()->with('success', 'Vendor rejected successfully.');
    }

    /**
     * Thank you page after form submission.
     */
    public function thankyou(Request $request)
    {
        $vendor = Vendor::where('token', $request->token)->firstOrFail();
        return view('company.vendors.thankyou', compact('vendor'));
    }

    /**
     * Download vendor details as PDF.
     */
    public function downloadPdf($id)
    {
        $vendor = Vendor::findOrFail($id);
        $pdf = PDF::loadView('company.vendors.pdf', compact('vendor'));

        return $pdf->download("vendor_{$vendor->id}_details.pdf");
    }
}
