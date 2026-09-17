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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id');
            $table->integer('class_id');
            $table->integer('teacher_id')->nullable();
            $table->integer('subject_id')->nullable();
            $table->date('date')->nullable();
            $table->string('reason')->nullable();
            $table->boolean('is_late')->default(false);
            $table->boolean('is_permission')->default(false);
            $table->boolean('is_present')->default(true);
            $table->boolean('is_approved')->default(false);
            $table->integer('branch_id')->nullable();
            $table->integer('cur_id')->nullable();
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
        Schema::dropIfExists('attendances');
    }
};
