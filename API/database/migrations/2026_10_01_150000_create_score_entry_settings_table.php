<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * One cutoff day per school year + curriculum.
     * Example: cutoff_day = 26 → after that calendar day each month, teachers cannot save that month's scores.
     */
    public function up(): void
    {
        Schema::create('score_entry_settings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('year_id');
            $table->unsignedBigInteger('cur_id')->nullable();
            $table->unsignedBigInteger('branch_id')->nullable();
            $table->unsignedTinyInteger('cutoff_day'); // 1–31
            $table->boolean('is_active')->default(true);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();

            $table->unique(['year_id', 'cur_id', 'branch_id'], 'score_entry_settings_scope_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('score_entry_settings');
    }
};
