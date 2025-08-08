<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

return new class extends \Illuminate\Database\Migrations\Migration {
    public function up()
    {
        DB::statement("ALTER TABLE vendors MODIFY status ENUM('pending', 'submitted', 'approved', 'rejected') DEFAULT 'pending'");
    }

    public function down()
    {
        DB::statement("ALTER TABLE vendors MODIFY status ENUM('pending', 'approved', 'rejected') DEFAULT 'pending'");
    }
};
