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
        Schema::create('student_curriculums', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id');
            $table->integer('curriculum_id');
            $table->integer('branch_id');
            $table->string('student_card_id')->nullable();
            $table->string('rfid')->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('is_transfer')->default(false);
            $table->boolean('is_graduate')->default(false);
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_curriculums');
    }
};
