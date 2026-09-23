<?php

namespace Database\Seeders\School;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\School\Student;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\File;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $path = database_path('seeders/School/students.sql');
        if (!File::exists($path)) {
            $this->command->error("File not found: {$path}");
            return;
        }

        // MySQL strict mode rejects 0000-00-00 on date columns
        $sql = str_replace("'0000-00-00'", "'2000-01-01'", File::get($path));
        DB::unprepared($sql);
        $this->command->info('Successfully seeded: students.sql');
    }
}


// SELECT
//   s.branch_id,
//   b.name_en,
//   COUNT(*) AS total_students
// FROM students s
// LEFT JOIN branches b ON b.id = s.branch_id
// GROUP BY s.branch_id, b.name_en
// ORDER BY s.branch_id;


// count student by branch
