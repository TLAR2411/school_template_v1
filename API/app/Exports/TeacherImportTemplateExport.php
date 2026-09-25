<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TeacherImportTemplateExport implements FromArray, WithHeadings, ShouldAutoSize
{
    public function headings(): array
    {
        return ['name_kh', 'name_en', 'gender', 'nation', 'dob', 'phone', 'role'];
    }

    public function array(): array
    {
        return [
            ['សុខ វិរៈ', 'Sok Vireak', 'male', 'kh', '1990-05-20', '098765432', 'administration'],
            ['ឡាយ លីណា', 'Lay Lina', 'female', 'kh', '1995-01-15', '012345678', 'administration'],
        ];
    }
}
