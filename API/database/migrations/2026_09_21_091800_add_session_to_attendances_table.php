<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('attendances', function (Blueprint $table) {
            $table->string('session', 8)->nullable()->after('subject_id');
            $table->index(['class_id', 'date', 'session'], 'attendances_class_date_session_index');
        });

        // Old AM / PM class rows → fill session from class.shift.code
        $shiftByClass = DB::table('classes')
            ->join('shifts', 'shifts.id', '=', 'classes.shift_id')
            ->whereIn('shifts.code', ['AM', 'PM'])
            ->pluck('shifts.code', 'classes.id');

        foreach ($shiftByClass as $classId => $code) {
            DB::table('attendances')
                ->where('class_id', $classId)
                ->whereNull('session')
                ->update(['session' => $code]);
        }
    }

    public function down(): void
    {
        Schema::table('attendances', function (Blueprint $table) {
            $table->dropIndex('attendances_class_date_session_index');
            $table->dropColumn('session');
        });
    }
};
