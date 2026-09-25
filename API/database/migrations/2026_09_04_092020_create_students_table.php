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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name_en');
            $table->string('name_kh');
            $table->date('dob')->nullable();
            $table->string('gender');
            $table->string('nation')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('village_code')->nullable();
            $table->string('commune_code')->nullable();
            $table->string('district_code')->nullable();
            $table->string('province_code')->nullable();
            $table->string('b_village_code')->nullable();
            $table->string('b_commune_code')->nullable();
            $table->string('b_district_code')->nullable();
            $table->string('b_province_code')->nullable();
            // $table->boolean('is_graduated')->default(false);
            $table->boolean('is_active')->default(true);
            $table->string('photo_path')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->integer('branch_id')->nullable(); // home branch id or work space (student create on that branch)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
