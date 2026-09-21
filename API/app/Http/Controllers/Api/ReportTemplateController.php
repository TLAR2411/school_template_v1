<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Core\ReportTemplate;
use Illuminate\Http\Request;

class ReportTemplateController extends Controller
{
    public function show(Request $request)
    {
        $request->validate([
            'key' => 'required|string|max:64',
        ]);

        $branchId = $this->resolveBranchId($request);
        $key = $request->input('key');

        $brand = $this->findTemplate('report-brand', $branchId);
        $report = $key === 'report-brand'
            ? null
            : $this->findTemplate($key, $branchId);

        return response()->json([
            'status' => true,
            'data' => [
                'key' => $key,
                'branch_id' => $branchId,
                'brand' => $brand?->config,
                'report' => $report?->config,
            ],
        ]);
    }

    public function save(Request $request)
    {
        $request->validate([
            'key' => 'required|string|max:64',
            'config' => 'required|array',
        ]);

        $branchId = $this->resolveBranchId($request);
        $key = $request->input('key');
        $config = $request->input('config');

        $this->processConfigImages($config);

        $row = ReportTemplate::updateOrCreate(
            [
                'key' => $key,
                'branch_id' => $branchId,
            ],
            [
                'config' => $config,
            ],
        );

        return response()->json([
            'status' => true,
            'data' => [
                'key' => $row->key,
                'branch_id' => $row->branch_id,
                'config' => $row->config,
            ],
            'message' => 'Report template saved.',
        ]);
    }

    protected function resolveBranchId(Request $request): ?int
    {
        $raw = $request->input('branchId')
            ?? $request->header('X-Branch-Id');

        if ($raw === null || $raw === '' || $raw === '*') {
            return null;
        }

        return (int) $raw;
    }

    protected function findTemplate(string $key, ?int $branchId): ?ReportTemplate
    {
        if ($branchId !== null) {
            $scoped = ReportTemplate::where('key', $key)
                ->where('branch_id', $branchId)
                ->first();

            if ($scoped) {
                return $scoped;
            }
        }

        return ReportTemplate::where('key', $key)
            ->whereNull('branch_id')
            ->first();
    }

    /**
     * Replace data-URL images in config with storage paths (logo, signatures, …).
     *
     * @param  array<string, mixed>  $config
     */
    protected function processConfigImages(array &$config): void
    {
        array_walk_recursive($config, function (&$value, $key) {
            if (!is_string($value)) {
                return;
            }

            if (!str_starts_with($value, 'data:image/')) {
                return;
            }

            $folder = in_array($key, ['logo', 'image'], true)
                ? 'reports/images'
                : 'reports/images';

            $value = 'storage/' . $this->storeImage($value, $folder);
        });
    }
}
