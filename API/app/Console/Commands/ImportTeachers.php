<?php

namespace App\Console\Commands;

use App\Exports\TeacherImportTemplateExport;
use App\Services\School\TeacherImportService;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class ImportTeachers extends Command
{
    protected $signature = 'teachers:import
        {file? : Path to the Excel file (.xlsx, .xls, .csv)}
        {--template : Generate teacher-import-template.xlsx}
        {--branch= : Branch ID}
        {--cur= : Curriculum ID}
        {--role= : Role name or ID}
        {--dry-run : Parse the file without creating records}';

    protected $description = 'Import teachers from Excel and auto-create login users';

    public function handle(TeacherImportService $service): int
    {
        if ($this->option('template')) {
            $relative = 'teacher-import-template.xlsx';
            Excel::store(new TeacherImportTemplateExport(), $relative, 'local');
            $saved = storage_path('app/private/'.$relative);
            $this->info('Template saved: '.$saved);
            $this->line('php artisan teachers:import '.$saved.' --branch=1 --cur=2');

            return self::SUCCESS;
        }

        $file = $this->argument('file');
        if (! $file) {
            $this->error('Pass an Excel file, or use --template.');
            $this->line('php artisan teachers:import storage/app/teachers.xlsx --branch=1 --cur=2');

            return self::FAILURE;
        }

        $path = $this->resolvePath($file);
        if (! $path) {
            $this->error("File not found: {$file}");

            return self::FAILURE;
        }

        $result = $service->import($path, [
            'branch_id' => $this->option('branch'),
            'cur_id' => $this->option('cur'),
            'role' => $this->option('role'),
            'dry_run' => (bool) $this->option('dry-run'),
            'created_by' => 1,
        ]);

        if ($this->option('dry-run')) {
            $this->warn('Dry run — no teachers or users were created.');
        }

        $this->info("Created: {$result['created']}");
        $this->info("Skipped: {$result['skipped']}");
        $this->info("Failed: {$result['failed']}");

        $rows = collect($result['rows'])->map(fn ($row) => [
            $row['row'] ?? '',
            $row['status'] ?? '',
            $row['name_en'] ?? '',
            $row['username'] ?? '',
            $row['password'] ?? '',
            $row['reason'] ?? '',
        ]);

        if ($rows->isNotEmpty()) {
            $this->table(
                ['Row', 'Status', 'Name', 'Username', 'Password', 'Reason'],
                $rows->all()
            );
        }

        return $result['failed'] > 0 && $result['created'] === 0
            ? self::FAILURE
            : self::SUCCESS;
    }

    private function resolvePath(string $file): ?string
    {
        foreach ([
            $file,
            storage_path($file),
            storage_path('app/'.$file),
            storage_path('app/private/'.$file),
            base_path($file),
        ] as $path) {
            if (is_file($path)) {
                return $path;
            }
        }

        return null;
    }
}
