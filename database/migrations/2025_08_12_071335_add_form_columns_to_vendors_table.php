<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFormColumnsToVendorsTable extends Migration
{
    public function up()
    {
        Schema::table('vendors', function (Blueprint $table) {
            if (!Schema::hasColumn('vendors', 'form_filled')) {
                $table->boolean('form_filled')->default(false)->after('token');
            }
            if (!Schema::hasColumn('vendors', 'status')) {
                $table->string('status')->default('pending')->after('form_filled');
            }
        });
    }

    public function down()
    {
        Schema::table('vendors', function (Blueprint $table) {
            $table->dropColumn(['form_filled', 'status']);
        });
    }
}
