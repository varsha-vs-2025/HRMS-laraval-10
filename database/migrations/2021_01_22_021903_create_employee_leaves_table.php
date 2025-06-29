<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        /*Schema::create('employee_leaves', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->string('leave_type'); // Sick, Annual, Casual, etc.
            $table->integer('leaves_quota')->default(0); // Total allowed leaves
            $table->integer('used_leaves')->default(0); // Leaves already used
            $table->date('start_date')->nullable(); // Leave start date
            $table->date('end_date')->nullable(); // Leave end date
            $table->text('reason')->nullable(); // Reason for leave
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending'); // Leave status
            $table->timestamps();

            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
        });*/

        Schema::create('employee_leaves', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('users')->onDelete('cascade'); // ✅ Change to 'users'
            $table->string('leave_type');
            $table->date('start_date');
            $table->date('end_date');
            $table->text('reason');
            $table->string('status')->default('Pending');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_leaves');
    }
};
