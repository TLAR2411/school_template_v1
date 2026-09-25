<?php

namespace Tests\Unit;

use App\Services\School\AttendanceReportService;
use PHPUnit\Framework\TestCase;

class AttendanceReportServiceTest extends TestCase
{
    public function test_it_maps_flags_to_status(): void
    {
        $this->assertSame('permission', AttendanceReportService::statusOf(true, false, false));
        $this->assertSame('late', AttendanceReportService::statusOf(false, true, true));
        $this->assertSame('absent', AttendanceReportService::statusOf(false, false, false));
        $this->assertSame('present', AttendanceReportService::statusOf(false, false, true));
    }

    public function test_it_bumps_counts(): void
    {
        $counts = AttendanceReportService::emptyCounts();
        AttendanceReportService::bump($counts, 'present');
        AttendanceReportService::bump($counts, 'absent');
        AttendanceReportService::bump($counts, 'absent');

        $this->assertSame(1, $counts['present']);
        $this->assertSame(2, $counts['absent']);
        $this->assertSame(3, $counts['total']);
    }
}
