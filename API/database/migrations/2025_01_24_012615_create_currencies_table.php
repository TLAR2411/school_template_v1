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
        Schema::create('currencies', function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->char('currency_code', 3)->unique();
            $table->string('name_kh', 50);
            $table->string('name_en', 50);
            $table->string('abbr', 10);
            $table->string('show', 10);
            $table->double('exchange_rate')->nullable();
            $table->boolean('default')->default(false)->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('currencies');
    }
};
