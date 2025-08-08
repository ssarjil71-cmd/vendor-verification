<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    // app/Models/Vendor.php

protected $fillable = [
    'name',
    'email',
    'token',
    'status',
    'company_id', // make sure this is fillable
];

}
