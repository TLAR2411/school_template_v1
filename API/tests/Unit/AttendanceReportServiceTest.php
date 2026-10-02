<?php

namespace Tests\Unit;

use App\Services\School\AttendanceReportService;
use PHPUnit\Framework\TestCase;

class AttendanceReportServiceTest extends TestCase
{
    public function test_it_maps_flags_to_status_for_subject_mode(): void
    {
        $this->assertSame('permission', AttendanceReportService::statusOf(true, false, false));
        $this->assertSame('late', AttendanceReportService::statusOf(false, true, true));
        $this->assertSame('absent', AttendanceReportService::statusOf(false, false, false));
        $this->assertSame('present', AttendanceReportService::statusOf(false, false, true));
    }

    public function test_it_maps_came_status_for_day_month_mode(): void
    {
        // Present + absent/permission merged → on-time present wins
        $this->assertSame('present', AttendanceReportService::statusCame(true, false, true, true));
        $this->assertSame('present', AttendanceReportService::statusCame(false, true, true, true));
        $this->assertSame('present', AttendanceReportService::statusCame(false, false, true, true));

        // Late only (came late, no on-time subject)
        $this->assertSame('late', AttendanceReportService::statusCame(false, true, true, false));

        // Permission only (did not come)
        $this->assertSame('permission', AttendanceReportService::statusCame(true, false, false, false));

        // Absent only
        $this->assertSame('absent', AttendanceReportService::statusCame(false, false, false, false));
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
