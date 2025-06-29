<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLocationAndDeadlineToRecruitmentsTable extends Migration
{
    public function up()
    {
        Schema::table('recruitments', function (Blueprint $table) {
            $table->string('location')->nullable()->after('description');
            $table->date('deadline')->nullable()->after('location');
        });
    }

    public function down()
    {
        Schema::table('recruitments', function (Blueprint $table) {
            $table->dropColumn(['location', 'deadline']);
        });
    }
}
