<?php

namespace App\Services\School;

use App\Models\School\Month;
use App\Models\School\ScoreEntrySetting;
use App\Models\School\Year;
use Carbon\Carbon;

/**
 * Option A lock: after a month's cutoff calendar day, that score month stays locked forever
 * (including later months). Example: cutoff_day=26 → Jan locked from 27 Jan onward.
 */
class ScoreEntryDeadlineService
{
    public function getSetting(?int $yearId, ?int $curId, ?int $branchId = null): ?ScoreEntrySetting
    {
        if (!$yearId) {
            return null;
        }

        // Match year + curriculum flexibly (branch optional).
        // After login headers can differ slightly from save time; still find the saved cutoff.
        $query = ScoreEntrySetting::query()
            ->where('year_id', $yearId)
            ->where('is_active', true);

        if ($curId) {
            $query->where(function ($q) use ($curId) {
                $q->where('cur_id', $curId)->orWhereNull('cur_id');
            })->orderByRaw('CASE WHEN cur_id IS NULL THEN 1 ELSE 0 END');
        } else {
            // No curriculum selected: prefer null cur, else any for this year
            $query->orderByRaw('CASE WHEN cur_id IS NULL THEN 0 ELSE 1 END');
        }

        if ($branchId) {
            $query->orderByRaw(
                'CASE WHEN branch_id = ? THEN 0 WHEN branch_id IS NULL THEN 1 ELSE 2 END',
                [$branchId]
            );
        } else {
            $query->orderByRaw('CASE WHEN branch_id IS NULL THEN 0 ELSE 1 END');
        }

        return $query->first();
    }

    /**
     * @return array{locked: bool, cutoff_day: ?int, close_date: ?string, can_override: bool}
     */
    public function windowForMonth(
        int $monthId,
        ?int $yearId,
        ?int $curId,
        ?int $branchId = null,
        bool $canOverride = false
    ): array {
        $setting = $this->getSetting($yearId, $curId, $branchId);
        $cutoffDay = $setting?->cutoff_day;

        if (!$cutoffDay) {
            return [
                'locked'       => false,
                'cutoff_day'   => null,
                'close_date'   => null,
                'can_override' => $canOverride,
            ];
        }

        $closeDate = $this->closeDateForMonth($monthId, $yearId, $cutoffDay);
        $locked = $closeDate
            ? Carbon::today()->gt($closeDate)
            : false;

        return [
            'locked'       => $locked,
            'cutoff_day'   => $cutoffDay,
            'close_date'   => $closeDate?->toDateString(),
            'can_override' => $canOverride,
        ];
    }

    public function closeDateForMonth(int $monthId, ?int $yearId, int $cutoffDay): ?Carbon
    {
        $month = Month::find($monthId);
        if (!$month) {
            return null;
        }

        $monthNum = Carbon::parse($month->name_en)->month;
        $year = $yearId ? Year::query()->find($yearId) : null;
        $start = $year?->start_date
            ? Carbon::parse($year->start_date)
            : Carbon::now()->startOfYear();
        $end = $year?->end_date
            ? Carbon::parse($year->end_date)
            : Carbon::now()->endOfYear();

        // Same mapping as AttendanceReportService::monthRange
        $cursor = $start->copy()->month($monthNum)->startOfMonth();
        if ($cursor->lt($start->copy()->startOfMonth())) {
            $cursor->addYear();
        }

        if ($cursor->gt($end)) {
            return null;
        }

        $day = min($cutoffDay, $cursor->daysInMonth);

        return $cursor->copy()->day($day)->startOfDay();
    }

    public function userCanOverride($user): bool
    {
        if (!$user) {
            return false;
        }

        if (method_exists($user, 'isAbleTo') && $user->isAbleTo('approve-score-entry')) {
            return true;
        }

        if (method_exists($user, 'hasPermission') && $user->hasPermission('approve-score-entry')) {
            return true;
        }

        if (method_exists($user, 'hasRole') && $user->hasRole(['developer', 'superadmin', 'admin'])) {
            return true;
        }

        return false;
    }

    /** True when teachers must be blocked (locked and no override). */
    public function shouldBlockSave(
        int $monthId,
        ?int $yearId,
        ?int $curId,
        ?int $branchId,
        $user
    ): array {
        $canOverride = $this->userCanOverride($user);
        $window = $this->windowForMonth($monthId, $yearId, $curId, $branchId, $canOverride);
        $block = $window['locked'] && !$canOverride;

        return [
            'block'  => $block,
            'window' => $window,
        ];
    }
}
