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
        Schema::create('grading_rules', function (Blueprint $table) {
            $table->id();
            $table->integer('grade_id');
            $table->integer('cur_id')->nullable();
            $table->integer('subject_id')->nullable();
            $table->integer('class_type_id')->nullable(); // social class or scient class
            $table->integer('subject_activity_type_id')->nullable(); //homework / work / att...
            $table->integer('percentage')->nullable();
            $table->string('max_score')->nullable();
            $table->integer('year_id')->nullable();
            $table->integer('term_id')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grading_rules');
    }
};
