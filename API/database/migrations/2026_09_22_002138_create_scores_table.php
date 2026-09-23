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
        Schema::create('scores', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id');
            $table->integer('class_id');
            $table->integer('subject_id');          // the column they type into
            $table->integer('month_id');
            $table->integer('year_id')->nullable();
            $table->integer('grading_rule_id')->nullable(); // max_score + activity (Exam/Homework)
            $table->integer('assessment_id')->nullable();   // English only; Khmer = null
            $table->decimal('score', 8, 2)->nullable();
            $table->boolean('is_approved')->default(false);
            $table->integer('teacher_id')->nullable();
            $table->integer('branch_id')->nullable();
            $table->integer('cur_id')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->unique(
                ['student_id', 'class_id', 'subject_id', 'month_id', 'year_id', 'grading_rule_id', 'assessment_id'],
                'scores_cell_unique'
            );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scores');
    }
};
