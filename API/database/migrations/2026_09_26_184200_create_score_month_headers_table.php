<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('score_month_headers', function (Blueprint $table) {
            $table->id();
            $table->integer('class_id');
            $table->integer('month_id');
            $table->integer('year_id')->nullable();
            $table->integer('cur_id')->nullable();
            $table->decimal('divisor', 8, 2)->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();

            $table->unique(
                ['class_id', 'month_id', 'year_id', 'cur_id'],
                'score_month_headers_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('score_month_headers');
    }
};
