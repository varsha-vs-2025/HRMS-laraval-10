<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::table('employee_leaves', function (Blueprint $table) {
            $table->integer('leaves_quota')->default(12); // Adjust default value as needed
        });
    }

    public function down() {
        Schema::table('employee_leaves', function (Blueprint $table) {
            $table->dropColumn('leaves_quota');
        });
    }
};
