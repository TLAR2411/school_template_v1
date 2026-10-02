<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Display order of subjects for score entry — per grade (all classes in that grade share it).
     */
    public function up(): void
    {
        Schema::create('grade_subject_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('grade_id');
            $table->unsignedBigInteger('subject_id');
            $table->unsignedInteger('sort')->default(0);
            $table->unsignedBigInteger('cur_id')->nullable();
            $table->unsignedBigInteger('branch_id')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();

            $table->unique(['grade_id', 'subject_id', 'cur_id'], 'grade_subject_orders_unique');
            $table->index(['grade_id', 'cur_id', 'sort']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('grade_subject_orders');
    }
};
