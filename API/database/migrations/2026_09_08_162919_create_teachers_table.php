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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('name_en');
            $table->string('name_kh');
            $table->date('dob')->nullable();
            $table->string('gender');
            $table->integer('manage_branch')->nullable();
            $table->string('nation')->nullable();
            $table->string('phone')->nullable();
            $table->integer('cur_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('is_teaching')->nullable();
            $table->string('village_code')->nullable();
            $table->string('commune_code')->nullable();
            $table->string('district_code')->nullable();
            $table->string('province_code')->nullable();
            $table->string('photo_path')->nullable();
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
        Schema::dropIfExists('teachers');
    }
};
