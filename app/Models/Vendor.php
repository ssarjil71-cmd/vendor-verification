<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $fillable = [
        'name',
        'email',
        'token',
        'status',
        'form_filled',   // <-- yeh add kiya
        'company_id',
        'pan_number',
        'aadhar_number',
        'bank_account',
        'ifsc_code',
    ];
}
