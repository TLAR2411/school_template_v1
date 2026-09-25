<?php

namespace Tests\Unit;

use App\Services\School\TeacherImportService;
use PHPUnit\Framework\TestCase;

class TeacherImportServiceTest extends TestCase
{
    public function test_it_normalizes_excel_headers(): void
    {
        $this->assertSame('name_kh', TeacherImportService::normalizeHeader('Name KH'));
        $this->assertSame('name_en', TeacherImportService::normalizeHeader('name-en'));
        $this->assertSame('date_of_birth', TeacherImportService::normalizeHeader('Date of Birth'));
    }

    public function test_it_maps_gender_values(): void
    {
        $this->assertSame('male', TeacherImportService::mapGender('Male'));
        $this->assertSame('male', TeacherImportService::mapGender('M'));
        $this->assertSame('female', TeacherImportService::mapGender('female'));
        $this->assertSame('female', TeacherImportService::mapGender('F'));
        $this->assertNull(TeacherImportService::mapGender('unknown'));
    }

    public function test_it_parses_dates(): void
    {
        $this->assertSame('1990-05-20', TeacherImportService::parseDob('1990-05-20'));
        $this->assertSame('1990-05-20', TeacherImportService::parseDob('20/05/1990'));
        $this->assertNull(TeacherImportService::parseDob(''));
    }

    public function test_it_builds_usernames_from_english_names(): void
    {
        $this->assertSame('sok.vireak', TeacherImportService::usernameFromName('Sok Vireak'));
        $this->assertSame('lay.lina', TeacherImportService::usernameFromName('LAY  LINA'));
        $this->assertSame('sok.vireak', TeacherImportService::usernameFromName('Sok-Vireak'));
    }

    public function test_it_defaults_nation_to_kh(): void
    {
        $this->assertSame('kh', TeacherImportService::mapNation(null));
        $this->assertSame('kh', TeacherImportService::mapNation('Cambodian'));
        $this->assertSame('other', TeacherImportService::mapNation('other'));
    }
}
