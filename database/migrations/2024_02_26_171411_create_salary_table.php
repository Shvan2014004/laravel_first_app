<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('salary', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->date('salary_date');
            $table->string('empolyee_id');
            $table->string('employee_name');
            $table->double('no_of_workin_days', 3, 2);
            $table->double('salary_per_day',8,2);
            $table->double('deduction',8,2);
            $table->double('netsalary',8,2);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salary');
    }
};
