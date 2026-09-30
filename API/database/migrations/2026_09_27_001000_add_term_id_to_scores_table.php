<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('scores', function (Blueprint $table) {
            $table->integer('term_id')->nullable()->after('month_id');
        });

        // English uses term_id; Khmer uses month_id — both nullable depending on sheet type
        DB::statement('ALTER TABLE scores MODIFY month_id INT NULL');

        Schema::table('scores', function (Blueprint $table) {
            $table->dropUnique('scores_cell_unique');
            $table->unique(
                [
                    'student_id',
                    'class_id',
                    'subject_id',
                    'month_id',
                    'term_id',
                    'year_id',
                    'grading_rule_id',
                    'assessment_id',
                ],
                'scores_cell_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::table('scores', function (Blueprint $table) {
            $table->dropUnique('scores_cell_unique');
        });

        Schema::table('scores', function (Blueprint $table) {
            $table->dropColumn('term_id');
        });

        DB::statement('ALTER TABLE scores MODIFY month_id INT NOT NULL');

        Schema::table('scores', function (Blueprint $table) {
            $table->unique(
                [
                    'student_id',
                    'class_id',
                    'subject_id',
                    'month_id',
                    'year_id',
                    'grading_rule_id',
                    'assessment_id',
                ],
                'scores_cell_unique'
            );
        });
    }
};
