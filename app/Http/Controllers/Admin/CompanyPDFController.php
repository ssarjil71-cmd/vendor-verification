<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;
use PDF;

class CompanyPDFController extends Controller
{
    public function download($type)
    {
        if (!in_array($type, ['all', 'paid', 'unpaid'])) {
            abort(404);
        }

        $companies = match($type) {
            'paid' => Company::where('is_paid', true)->get(),
            'unpaid' => Company::where('is_paid', false)->get(),
            'all' => Company::all(),
        };

        $pdf = PDF::loadView('admin.companies.pdf', compact('companies', 'type'));

        return $pdf->download(ucfirst($type) . '_companies.pdf');
    }
}
