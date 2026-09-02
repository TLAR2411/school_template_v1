<?php

namespace Database\Seeders\Core;

use App\Models\Core\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    public function run(): void
    {
        $departments = [
            [
                'name_kh' => 'ក្រុមប្រឹក្សាភិបាល',
                'name_en' => 'Board of Directors',
            ],
            [
                'name_kh' => 'នាយកដ្ឋានប្រតិបត្តិការ',
                'name_en' => 'Operations Department',
            ],
            [
                'name_kh' => 'នាយកដ្ឋានហិរញ្ញវត្ថុ',
                'name_en' => 'Finance Department',
            ],
            [
                'name_kh' => 'នាយកដ្ឋានសវនកម្ម',
                'name_en' => 'Audit Department',
            ],
            [
                'name_kh' => 'នាយកដ្ឋានទីផ្សា',
                'name_en' => 'Marketing Department',
            ],
            [
                'name_kh' => 'នាយកដ្ឋានធនធានមនុស្ស',
                'name_en' => 'Human Resources Department',
            ],
            [
                'name_kh' => 'នាយកដ្ឋានបច្ចេកវិទ្យាពត៍មាន',
                'name_en' => 'Department of Information Technology',
            ],
            [
                'name_kh' => 'នាយកដ្ឋានដោះស្រាយបំណុល',
                'name_en' => 'Debt Settlement Department',
            ],
        ];

        foreach ($departments as $item) {
            Department::create($item);
        }
    }
}
