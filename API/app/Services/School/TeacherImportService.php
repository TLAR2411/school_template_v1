<?php

namespace App\Services\School;

use App\Models\Auth\Role;
use App\Models\Core\Branch;
use App\Models\Core\Setting;
use App\Models\School\Curriculum;
use App\Models\School\Teacher;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Shared\Date as ExcelDate;
use Throwable;

class TeacherImportService
{
    private const HEADER_ALIASES = [
        'name_kh' => [
            'name_kh', 'namekh', 'khmer_name', 'name_km', 'kh_name', 'name_in_khmer',
        ],
        'name_en' => [
            'name_en', 'nameen', 'english_name', 'en_name', 'full_name', 'name_in_english', 'name',
        ],
        'gender' => ['gender', 'sex'],
        'nation' => ['nation', 'nationality'],
        'dob' => ['dob', 'date_of_birth', 'birth_date', 'birthday'],
        'phone' => ['phone', 'contact', 'telephone', 'tel', 'mobile'],
        'role' => ['role', 'role_name'],
        'email' => ['email', 'e_mail'],
    ];

    public function import(string $filePath, array $context = []): array
    {
        $dryRun = (bool) ($context['dry_run'] ?? false);
        $branchId = $this->resolveBranchId($context['branch_id'] ?? null);
        $curId = $this->resolveCurriculumId($context['cur_id'] ?? null);
        $fallbackRole = $this->resolveRole($context['role_id'] ?? null, $context['role'] ?? null);
        $createdBy = $context['created_by'] ?? null;

        $defaultPasswordPrefix = Setting::where('key', 'default_password')->value('value') ?: 'dewey@123';
        $emailSuffix = Setting::where('key', 'company_email')->value('value') ?: '@school.test';

        $rows = $this->readRows($filePath);
        $created = 0;
        $skipped = 0;
        $failed = 0;
        $details = [];

        foreach ($rows as $item) {
            $rowNumber = $item['row'];
            $data = $item['data'];

            if ($this->isEmptyRow($data)) {
                continue;
            }

            $nameEn = trim((string) ($data['name_en'] ?? ''));
            $nameKh = trim((string) ($data['name_kh'] ?? ''));

            if ($nameEn === '' && $nameKh === '') {
                continue;
            }

            if ($nameEn === '') {
                $failed++;
                $details[] = $this->detail($rowNumber, 'failed', $nameKh, 'English name is required');
                continue;
            }

            if ($nameKh === '') {
                $nameKh = $nameEn;
            }

            $gender = static::mapGender($data['gender'] ?? null);
            if (($data['gender'] ?? '') !== '' && $data['gender'] !== null && $gender === null) {
                $failed++;
                $details[] = $this->detail($rowNumber, 'failed', $nameEn, 'Invalid gender (use male/female)');
                continue;
            }
            $gender = $gender ?: 'male';

            $nation = static::mapNation($data['nation'] ?? null);
            $dob = static::parseDob($data['dob'] ?? null);
            $phone = trim((string) ($data['phone'] ?? '')) ?: null;
            $email = trim((string) ($data['email'] ?? '')) ?: null;

            $alreadyExists = Teacher::query()
                ->when($curId, fn ($q) => $q->where('cur_id', $curId))
                ->whereRaw('LOWER(name_en) = ?', [mb_strtolower($nameEn)])
                ->where('name_kh', $nameKh)
                ->exists();

            if ($alreadyExists) {
                $skipped++;
                $details[] = $this->detail($rowNumber, 'skipped', $nameEn, 'Teacher already exists');
                continue;
            }

            $role = $this->resolveRole(null, $data['role'] ?? null) ?? $fallbackRole;
            $username = $this->uniqueUsername($nameEn);

            if ($username === '') {
                $failed++;
                $details[] = $this->detail($rowNumber, 'failed', $nameEn, 'Could not build a username from English name');
                continue;
            }

            $password = $defaultPasswordPrefix.$username;
            $userEmail = $this->uniqueEmail($email ?: ($username.$emailSuffix));

            if ($dryRun) {
                $created++;
                $details[] = $this->detail($rowNumber, 'created', $nameEn, null, $username, $password);
                continue;
            }

            try {
                DB::transaction(function () use (
                    $nameEn,
                    $nameKh,
                    $gender,
                    $nation,
                    $dob,
                    $phone,
                    $userEmail,
                    $username,
                    $password,
                    $role,
                    $branchId,
                    $curId,
                    $createdBy
                ) {
                    $user = User::create([
                        'name_kh' => $nameKh,
                        'name_en' => strtoupper($nameEn),
                        'gender' => $gender,
                        'dob' => $dob,
                        'contact' => $phone,
                        'email' => $userEmail,
                        'manage_branch' => 1,
                        'branch_id' => $branchId,
                        'role_id' => $role?->id,
                        'password' => Hash::make($password),
                        'username' => $username,
                        'is_active' => true,
                        'default_part' => 'school',
                    ]);

                    $user->code = 'T-'.str_pad((string) $user->id, 6, '0', STR_PAD_LEFT);
                    $user->save();

                    if ($role) {
                        $user->addRole($role);
                    }

                    Teacher::create([
                        'user_id' => $user->id,
                        'manage_branch' => 1,
                        'name_en' => $nameEn,
                        'name_kh' => $nameKh,
                        'dob' => $dob,
                        'gender' => $gender,
                        'nation' => $nation,
                        'phone' => $phone,
                        'cur_id' => $curId,
                        'is_active' => true,
                        'created_by' => $createdBy,
                    ]);
                });

                $created++;
                $details[] = $this->detail($rowNumber, 'created', $nameEn, null, $username, $password);
            } catch (Throwable $e) {
                $failed++;
                $details[] = $this->detail($rowNumber, 'failed', $nameEn, $e->getMessage());
            }
        }

        return [
            'created' => $created,
            'skipped' => $skipped,
            'failed' => $failed,
            'rows' => $details,
        ];
    }

    public function readRows(string $filePath): array
    {
        $spreadsheet = IOFactory::load($filePath);
        $sheet = $spreadsheet->getActiveSheet();
        $highestRow = (int) $sheet->getHighestDataRow();
        $highestColumn = $sheet->getHighestDataColumn();
        $columnCount = Coordinate::columnIndexFromString($highestColumn);

        $raw = [];
        for ($row = 1; $row <= $highestRow; $row++) {
            $values = [];
            for ($col = 1; $col <= $columnCount; $col++) {
                $cell = $sheet->getCell(Coordinate::stringFromColumnIndex($col).$row);
                $value = $cell->getValue();

                if ($value !== null && $value !== '' && ExcelDate::isDateTime($cell)) {
                    $values[] = ExcelDate::excelToDateTimeObject($value)->format('Y-m-d');
                } else {
                    $values[] = is_string($value) ? trim($value) : $value;
                }
            }
            $raw[] = $values;
        }

        $headerIndex = $this->detectHeaderRow($raw);
        $map = $this->headerMap($raw[$headerIndex] ?? []);
        $rows = [];

        for ($i = $headerIndex + 1; $i < count($raw); $i++) {
            $assoc = [];
            foreach ($map as $field => $col) {
                $assoc[$field] = $raw[$i][$col] ?? null;
            }
            $rows[] = [
                'row' => $i + 1,
                'data' => $assoc,
            ];
        }

        return $rows;
    }

    public static function normalizeHeader(?string $header): string
    {
        $header = trim((string) $header);
        $header = preg_replace('/\s+/', '_', $header) ?? $header;
        $header = str_replace(['-', '.', '/', '\\'], '_', $header);
        $header = preg_replace('/_+/', '_', $header) ?? $header;

        return mb_strtolower(trim($header, '_'));
    }

    public static function mapGender(mixed $value): ?string
    {
        $value = mb_strtolower(trim((string) $value));
        if ($value === '') {
            return null;
        }

        return match ($value) {
            'male', 'm', 'man', 'boy', '1' => 'male',
            'female', 'f', 'woman', 'girl', '2' => 'female',
            default => str_contains($value, 'male') && ! str_contains($value, 'female') ? 'male' : (
                str_contains($value, 'female') ? 'female' : null
            ),
        };
    }

    public static function mapNation(mixed $value): string
    {
        $value = mb_strtolower(trim((string) $value));

        if (in_array($value, ['other', 'other nationality'], true)) {
            return 'other';
        }

        return 'kh';
    }

    public static function parseDob(mixed $value): ?string
    {
        if ($value === null || $value === '') {
            return null;
        }

        if (is_numeric($value) && (float) $value > 20000) {
            try {
                return ExcelDate::excelToDateTimeObject((float) $value)->format('Y-m-d');
            } catch (Throwable) {
                // fall through
            }
        }

        $value = trim((string) $value);

        foreach (['Y-m-d', 'd/m/Y', 'd-m-Y', 'm/d/Y', 'Y/m/d', 'd.m.Y'] as $format) {
            try {
                $date = Carbon::createFromFormat($format, $value);
                if ($date !== false) {
                    return $date->format('Y-m-d');
                }
            } catch (Throwable) {
                // try next
            }
        }

        try {
            return Carbon::parse($value)->format('Y-m-d');
        } catch (Throwable) {
            return null;
        }
    }

    public static function usernameFromName(string $nameEn): string
    {
        $base = mb_strtolower(trim($nameEn));
        $base = preg_replace('/[^a-z0-9\s._-]/', '', $base) ?? '';
        $base = preg_replace('/[\s._-]+/', '.', $base) ?? '';

        return trim($base, '.');
    }

    private function uniqueUsername(string $nameEn): string
    {
        $base = static::usernameFromName($nameEn);
        if ($base === '') {
            return '';
        }

        $username = $base;
        $i = 2;
        while (User::where('username', $username)->exists()) {
            $username = $base.'-'.$i;
            $i++;
        }

        return $username;
    }

    private function uniqueEmail(string $email): string
    {
        if (! str_contains($email, '@')) {
            $email .= '@school.test';
        }

        [$local, $domain] = explode('@', $email, 2);
        $candidate = $email;
        $i = 2;
        while (User::where('email', $candidate)->exists()) {
            $candidate = $local.'-'.$i.'@'.$domain;
            $i++;
        }

        return $candidate;
    }

    private function resolveBranchId(mixed $branchId): int
    {
        if ($branchId && $branchId !== '*') {
            return (int) $branchId;
        }

        return (int) (auth('api')->user()?->branch_id ?: Branch::query()->value('id') ?: 1);
    }

    private function resolveCurriculumId(mixed $curId): ?int
    {
        if ($curId && $curId !== '*') {
            return (int) $curId;
        }

        $id = Curriculum::query()->value('id');

        return $id ? (int) $id : null;
    }

    private function resolveRole(mixed $roleId, mixed $roleName): ?Role
    {
        if ($roleId) {
            return Role::find($roleId);
        }

        $roleName = trim((string) $roleName);
        if ($roleName === '') {
            return Role::where('name', 'teacher')->first();
        }

        return Role::query()
            ->where('id', $roleName)
            ->orWhere('name', $roleName)
            ->orWhere('display_name', $roleName)
            ->first();
    }

    private function detectHeaderRow(array $raw): int
    {
        foreach ($raw as $index => $values) {
            if (count($this->headerMap($values)) >= 2) {
                return $index;
            }
        }

        return 0;
    }

    private function headerMap(array $values): array
    {
        $map = [];
        foreach ($values as $index => $header) {
            $normalized = static::normalizeHeader(is_string($header) ? $header : (string) $header);
            if ($normalized === '') {
                continue;
            }
            foreach (self::HEADER_ALIASES as $field => $aliases) {
                if (in_array($normalized, $aliases, true) && ! isset($map[$field])) {
                    $map[$field] = $index;
                }
            }
        }

        return $map;
    }

    private function isEmptyRow(array $data): bool
    {
        foreach ($data as $value) {
            if (trim((string) $value) !== '') {
                return false;
            }
        }

        return true;
    }

    private function detail(
        int $row,
        string $status,
        ?string $nameEn = null,
        ?string $reason = null,
        ?string $username = null,
        ?string $password = null
    ): array {
        return array_filter([
            'row' => $row,
            'status' => $status,
            'name_en' => $nameEn,
            'reason' => $reason,
            'username' => $username,
            'password' => $password,
        ], fn ($value) => $value !== null && $value !== '');
    }
}
