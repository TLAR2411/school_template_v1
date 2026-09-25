<?php

namespace App\Console\Commands;

use App\Services\School\AttendanceReportService;
use Illuminate\Console\Command;

/**
 * Short commands (customize flags as needed):
 *
 *   php artisan attendance:report --class=12 --date=2026-09-24
 *   php artisan attendance:report --class=12 --from=2026-09-01 --to=2026-09-24
 *   php artisan attendance:report --class=12 --month=9 --year=1
 *   php artisan attendance:report --date=2026-09-24 --session=AM --json
 */
class AttendanceReport extends Command
{
    protected $signature = 'attendance:report
        {--class= : Class ID}
        {--date= : One day Y-m-d}
        {--from= : Range start Y-m-d}
        {--to= : Range end Y-m-d}
        {--month= : months.id (1=Jan … 12=Dec if seeded in order)}
        {--session= : AM or PM}
        {--branch= : Branch ID}
        {--cur= : Curriculum ID}
        {--year= : Year ID (used with --month)}
        {--json : Print full JSON}';

    protected $description = 'Print attendance counts (present / late / permission / absent)';

    public function handle(AttendanceReportService $service): int
    {
        $filters = array_filter([
            'class_id'  => $this->option('class'),
            'date'      => $this->option('date'),
            'date_from' => $this->option('from'),
            'date_to'   => $this->option('to'),
            'month_id'  => $this->option('month'),
            'session'   => $this->option('session')
                ? strtoupper($this->option('session'))
                : null,
        ], fn ($v) => $v !== null && $v !== '');

        $data = $service->run(
            $filters,
            $this->option('branch'),
            $this->option('cur'),
            $this->option('year')
        );

        if ($this->option('json')) {
            $this->line(json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

            return self::SUCCESS;
        }

        $this->info("{$data['date_from']} → {$data['date_to']}");
        $s = $data['summary'];
        $this->table(
            ['Present', 'Late', 'Permission', 'Absent', 'Total'],
            [[$s['present'], $s['late'], $s['permission'], $s['absent'], $s['total']]]
        );

        return self::SUCCESS;
    }
}
