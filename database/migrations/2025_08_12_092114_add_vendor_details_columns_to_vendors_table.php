<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('vendors', function (Blueprint $table) {
            if (!Schema::hasColumn('vendors', 'pan_number')) {
                $table->string('pan_number')->nullable();
            }
            if (!Schema::hasColumn('vendors', 'aadhar_number')) {
                $table->string('aadhar_number')->nullable();
            }
            if (!Schema::hasColumn('vendors', 'bank_account')) {
                $table->string('bank_account')->nullable();
            }
            if (!Schema::hasColumn('vendors', 'ifsc_code')) {
                $table->string('ifsc_code')->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('vendors', function (Blueprint $table) {
            $table->dropColumn(['pan_number', 'aadhar_number', 'bank_account', 'ifsc_code']);
        });
    }
};
