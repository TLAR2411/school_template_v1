<?php

namespace App\Http\Controllers\Api\School;

use App\Http\Controllers\Controller;
use App\Models\School\ScoreEntrySetting;
use App\Services\School\ScoreEntryDeadlineService;
use App\Services\School\ScoreEntryStatusService;
use Illuminate\Http\Request;

class ScoreEntryStatusController extends Controller
{
    public function __construct(
        private ScoreEntryDeadlineService $deadlineService,
        private ScoreEntryStatusService $statusService,
    ) {}

    /** Load cutoff setting for current year + curriculum. */
    public function showSetting()
    {
        $yearId = $this->resolveYearId();
        $curId = $this->resolveCurId();
        $branchId = $this->resolveBranchId();

        if (!$yearId) {
            return response()->json([
                'status'  => false,
                'message' => 'Please select a school year',
            ], 422);
        }

        $setting = $this->deadlineService->getSetting($yearId, $curId, $branchId);

        return response()->json([
            'status' => true,
            'data'   => [
                'id'         => $setting?->id,
                'year_id'    => $yearId,
                'cur_id'     => $curId,
                'branch_id'  => $branchId,
                'cutoff_day' => $setting?->cutoff_day,
                'is_active'  => $setting?->is_active ?? true,
            ],
        ]);
    }

    /** Save one cutoff day (1–31) for current year + curriculum. */
    public function storeSetting(Request $request)
    {
        $data = $request->validate([
            'cutoff_day' => 'required|integer|min:1|max:31',
            'is_active'  => 'nullable|boolean',
        ]);

        $yearId = $this->resolveYearId();
        $curId = $this->resolveCurId();
        $branchId = $this->resolveBranchId();
        $userId = auth('api')->id();

        if (!$yearId) {
            return response()->json([
                'status'  => false,
                'message' => 'Please select a school year',
            ], 422);
        }

        // One cutoff for the whole school year: ignore curriculum so the row is
        // shared by every curriculum/teacher. Prefer an existing row that matches
        // the requested curriculum, then a null one, then any for this year.
        $settingQuery = ScoreEntrySetting::query()
            ->where('year_id', $yearId)
            ->orderByRaw(
                'CASE WHEN cur_id = ? THEN 0 WHEN cur_id IS NULL THEN 1 ELSE 2 END',
                [$curId]
            );

        if ($branchId) {
            $settingQuery->orderByRaw(
                'CASE WHEN branch_id = ? THEN 0 WHEN branch_id IS NULL THEN 1 ELSE 2 END',
                [$branchId]
            );
        } else {
            $settingQuery->orderByRaw('CASE WHEN branch_id IS NULL THEN 0 ELSE 1 END');
        }

        $setting = $settingQuery->first();

        $payload = [
            'year_id'    => $yearId,
            'cur_id'     => null,
            'branch_id'  => $branchId,
            'cutoff_day' => (int) $data['cutoff_day'],
            'is_active'  => array_key_exists('is_active', $data)
                ? (bool) $data['is_active']
                : true,
            'updated_by' => $userId,
        ];

        if ($setting) {
            $setting->update($payload);
        } else {
            $setting = ScoreEntrySetting::create([
                ...$payload,
                'created_by' => $userId,
            ]);
        }

        return response()->json([
            'status'  => true,
            'message' => 'Score entry deadline saved',
            'data'    => [
                'id'         => $setting->id,
                'year_id'    => $setting->year_id,
                'cur_id'     => $setting->cur_id,
                'branch_id'  => $setting->branch_id,
                'cutoff_day' => $setting->cutoff_day,
                'is_active'  => $setting->is_active,
            ],
        ]);
    }

    /**
     * Track missing / partial / done scores for class + subject (+ teacher).
     * Body: month_id, optional grade_id, class_id, status (missing|partial|done|all)
     */
    public function statusList(Request $request)
    {
        $data = $request->validate([
            'month_id'  => 'required|integer|exists:months,id',
            'grade_id'  => 'nullable|integer|exists:grades,id',
            'class_id'  => 'nullable|integer|exists:classes,id',
            'status'    => 'nullable|in:missing,partial,done,all',
        ]);

        $yearId = $this->resolveYearId();
        $curId = $this->resolveCurId();
        $branchId = $this->resolveBranchId();
        $monthId = (int) $data['month_id'];
        $user = auth('api')->user();

        $result = $this->statusService->list(
            $monthId,
            $yearId,
            $curId,
            $branchId,
            isset($data['grade_id']) ? (int) $data['grade_id'] : null,
            isset($data['class_id']) ? (int) $data['class_id'] : null,
            $data['status'] ?? 'all',
        );

        $window = $this->deadlineService->windowForMonth(
            $monthId,
            $yearId,
            $curId,
            $branchId,
            $this->deadlineService->userCanOverride($user)
        );

        return response()->json([
            'status' => true,
            'data'   => [
                'month_id' => $monthId,
                'year_id'  => $yearId,
                'cur_id'   => $curId,
                'window'   => $window,
                'summary'  => $result['summary'],
                'rows'     => $result['rows'],
            ],
        ]);
    }

    private function resolveYearId(): ?int
    {
        $yearId = $this->getYear();

        return ($yearId !== null && $yearId !== '' && $yearId !== '*')
            ? (int) $yearId
            : null;
    }

    private function resolveCurId(): ?int
    {
        $curId = $this->getCur();

        return ($curId !== null && $curId !== '' && $curId !== '*')
            ? (int) $curId
            : null;
    }

    private function resolveBranchId(): ?int
    {
        $branchId = $this->getBranch();

        return ($branchId !== null && $branchId !== '' && $branchId !== '*')
            ? (int) $branchId
            : null;
    }
}
