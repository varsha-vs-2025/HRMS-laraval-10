<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUsedLeavesToEmployeeLeavesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::table('employee_leaves', function (Blueprint $table) {
        $table->integer('used_leaves')->default(0);
    });
}

public function down()
{
    Schema::table('employee_leaves', function (Blueprint $table) {
        $table->dropColumn('used_leaves');
    });
}

}
