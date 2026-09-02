<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('branches', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('name_kh');
            $table->string('name_en')->nullable();
            $table->char('abbr', 3)->unique();
            $table->string('contact')->nullable();
            $table->string('house_no')->nullable();
            $table->string('street')->nullable();

            $table->integer('village_code')->nullable();
            $table->integer('commune_code')->nullable();
            $table->integer('district_code')->nullable();
            $table->integer('province_code')->nullable();

            $table->string('location')->nullable();

            $table->date('start_date')->nullable();

            $table->unsignedTinyInteger('company_id')->default(1);
            $table->foreign('company_id')
                ->references('id')
                ->on('banks')
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->index('company_id');

            $table->unsignedTinyInteger('bank_id')->default(1);
            $table->foreign('bank_id')
                ->references('id')
                ->on('banks')
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->index('bank_id');

            $table->string('account_name')->nullable();
            $table->string('account_number')->nullable();

            $table->string('request_loan_group_id')->nullable();
            $table->string('follow_up_group_id')->nullable();

            $table->unsignedTinyInteger('region')->nullable();
            $table->boolean('is_head')->default(false)->comment('True if this branch is the head office');
            $table->boolean('is_active')->default(true)->comment('True if the branch is active');


            $table->unsignedMediumInteger('created_by')->nullable();
            $table->unsignedMediumInteger('updated_by')->nullable();
            $table->unsignedMediumInteger('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branches');
    }
};
