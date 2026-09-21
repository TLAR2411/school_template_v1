<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('report_templates', function (Blueprint $table) {
            $table->id();
            $table->string('key', 64);
            $table->unsignedTinyInteger('branch_id')->nullable();
            $table->json('config');
            $table->timestamps();

            $table->unique(['key', 'branch_id']);
            $table->index('key');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('report_templates');
    }
};
