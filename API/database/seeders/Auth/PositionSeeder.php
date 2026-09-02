<?php

namespace Database\Seeders\Auth;

use App\Models\Auth\Position;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $positions = [
            [
                'name_kh' => "ប្រធានក្រុមប្រឹក្សាភិបាល",
                'name_en' => "Chairman of the Board of Directors",
                'abbr' => "COB",
                'level' => 109,
                'department_id' => 1,
            ],
            [
                'name_kh' => "ក្រុមប្រឹក្សាភិបាល",
                'name_en' => "Board of Directors",
                'abbr' => "BOD",
                'level' => 101,
                'department_id' => 1,
            ],
            [
                'name_kh' => "នាយកប្រតិបត្តិ",
                'name_en' => "Chief Executive Officer",
                'abbr' => "CEO",
                'level' => 99,
                'department_id' => 1,
            ],
            // Operations
            [
                'name_kh' => "ប្រធាននាយកដ្ឋានប្រតិបត្តិការ",
                'name_en' => "Head of Operations Department",
                'abbr' => "COO",
                'level' => 89,
                'department_id' => 2,
            ],
            [
                'name_kh' => "ប្រធាននាយកដ្ឋានឥណទា",
                'name_en' => "Head of Credit Department",
                'abbr' => "HOC",
                'level' => 89,
                'department_id' => 2,
            ],
            [
                'name_kh' => "ប្រធានភូមិភាគ",
                'name_en' => "Regional Manager",
                'abbr' => "RM",
                'level' => 49,
                'department_id' => 2,
            ],
            [
                'name_kh' => "ប្រធានសាខា",
                'name_en' => "Branch Manager",
                'abbr' => "BM",
                'level' => 39,
                'department_id' => 2,
            ],
            [
                'name_kh' => "អនុប្រធានសាខា",
                'name_en' => "Deputy Branch Manager",
                'abbr' => "DBM",
                'level' => 32,
                'department_id' => 2,
            ],
            [
                'name_kh' => "ប្រធានសាខាស្ដីទី",
                'name_en' => "Acting Branch Manager",
                'abbr' => "ABM",
                'level' => 31,
                'department_id' => 2,
            ],
            [
                'name_kh' => "ប្រធានមន្រ្ដីឥណទាន",
                'name_en' => "Chief Credit Officer",
                'abbr' => "CCO",
                'level' => 29,
                'department_id' => 2,
                'is_leader' => true
            ],
            // [
            //     'name_kh' => "អនុប្រធានមន្រ្ដីឥណទាន",
            //     'name_en' => "Chief Credit Officer",
            //     'abbr' => "CCO",
            //     'level' => 21,
            //     'department_id' => 2,
            // ],
            [
                'name_kh' => "ប្រធានមន្រ្ដីឥណទានស្ដីទី",
                'name_en' => "Acting Chief Credit Officer",
                'abbr' => "ACCO",
                'level' => 21,
                'department_id' => 2,
            ],
            [
                'name_kh' => "មន្រ្ដីឥណទាន",
                'name_en' => "Credit Officer",
                'abbr' => "CO",
                'level' => 11,
                'department_id' => 2,
                'is_member' => true
            ],
            // Finance
            [
                'name_kh' => "ប្រធាននាយកដ្ឋានហិរញ្ញវត្ថុ",
                'name_en' => "Head of Finance Department",
                'abbr' => "CFO",
                'level' => 89,
                'department_id' => 3,
            ],
            [
                'name_kh' => "ប្រធានបេឡា",
                'name_en' => "Chief Teller",
                'abbr' => "CT",
                'level' => 22,
                'department_id' => 3,
            ],
            [
                'name_kh' => "បេឡា",
                'name_en' => "Teller",
                'abbr' => "TEL",
                'level' => 11,
                'department_id' => 3,
            ],
            // Audit
            [
                'name_kh' => "ប្រធាននាយកដ្ឋានសវនកម្ម",
                'name_en' => "Head of Audit Department",
                'abbr' => "HOA",
                'level' => 89,
                'department_id' => 4,
            ],
            [
                'name_kh' => "មន្រ្តីសវនកម្ម",
                'name_en' => "Auditor",
                'abbr' => "AUD",
                'level' => 11,
                'department_id' => 4,
            ],
            // Marketing
            [
                'name_kh' => "ប្រធាននាយកដ្ឋានទីផ្សា",
                'name_en' => "Head of Marketing Department",
                'abbr' => "HOM",
                'level' => 89,
                'department_id' => 5,
            ],
            [
                'name_kh' => "មន្រ្តីផ្នែកទីផ្សា",
                'name_en' => "Marketing Officer",
                'abbr' => "MO",
                'level' => 11,
                'department_id' => 5,
            ],
            // Human Resources
            [
                'name_kh' => "ប្រធាននាយកដ្ឋានធនធានមនុស្ស",
                'name_en' => "Head of Human Resources Department",
                'abbr' => "HHR",
                'level' => 89,
                'department_id' => 6,
            ],
            [
                'name_kh' => "រដ្ឋបាល",
                'name_en' => "Administration",
                'abbr' => "ADMIN",
                'level' => 11,
                'department_id' => 5,
            ],
            // Information Technology
            [
                'name_kh' => "ប្រធាននាយកដ្ឋានបច្ចេកវិទ្យាពត៍មាន",
                'name_en' => "Head of Information Technology Department",
                'abbr' => "CIO",
                'level' => 89,
                'department_id' => 7,
            ],
            [
                'name_kh' => "អ្នកអភិវឌ្ឍកម្មវិធី",
                'name_en' => "Developer",
                'abbr' => "DEV",
                'level' => 11,
                'department_id' => 7,
            ],
            [
                'name_kh' => "ប្រធានបច្ចេកវិទ្យាពត៍មាន",
                'name_en' => "Information Technology Manager",
                'abbr' => "ITM",
                'level' => 32,
                'department_id' => 7,
            ],
            [
                'name_kh' => "អ្នកសម្របសម្រួលប្រព័ន្ធ",
                'name_en' => "System Administrator",
                'abbr' => "SA",
                'level' => 11,
                'department_id' => 7,
            ],
            // Debt Settlement
            [
                'name_kh' => "ប្រធាននាយកដ្ឋានដោះស្រាយបំណុល",
                'name_en' => "Head of Debt Settlement Department",
                'abbr' => "HDSD",
                'level' => 89,
                'department_id' => 8,
            ],
            [
                'name_kh' => "មន្រ្តីដោះស្រាយបំណុល",
                'name_en' => "Debt Settlement Officer",
                'abbr' => "DSO",
                'level' => 11,
                'department_id' => 8,
            ],
            [
                'name_kh' => "Chief Support",
                'name_en' => "Chief Support",
                'abbr' => "CS",
                'level' => 39,
                'department_id' => 2,
            ],
            [
                'name_kh' => "ប្រធានះស្រាយបំណុល",
                'name_en' => "Debt Settlement Chief",
                'abbr' => "DSC",
                'level' => 31,
                'department_id' => 8,
            ],
        ];
        foreach ($positions as $item) {
            Position::create($item);
        }
    }
}
