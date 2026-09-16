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
        Schema::create('term_period_list', function (Blueprint $table) {
            $table->id();
            $table->integer('month_id');
            $table->integer('term_period_id');
            $table->integer('grade_id');
            $table->integer('semester_month_id')->nullable();
            // $table->integer('edu_id');
            $table->string('role')->nullable();   //study or exam
            $table->integer('year_id');
            $table->integer('cur_id')->nullable();
            $table->integer('branch_id');
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('term_period_list');
    }
};
