<?php

namespace App\Console\Commands;

use App\Models\School\Student;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;
use Throwable;

class ConvertStudentPhotosToWebp extends Command
{
    protected $signature = 'students:convert-photos-webp';

    protected $description = 'Convert existing student .jpg photos to .webp';

    public function handle(): int
    {
        $students = Student::where('photo_path', 'like', '%.jpg')->get();
        $this->info("Found {$students->count()} student photo(s) with .jpg");

        $converted = 0;
        $missing = 0;
        $failed = 0;

        foreach ($students as $student) {
            $old = preg_replace('/^storage\//', '', $student->photo_path);

            if (! Storage::disk('public')->exists($old)) {
                $this->warn("Missing: {$old}");
                $missing++;

                continue;
            }

            try {
                $img = Image::read(Storage::disk('public')->get($old));
                $new = 'images/students/images/'.now()->format('Y/n/j').'/'.Str::uuid().'.webp';

                Storage::disk('public')->put($new, (string) $img->toWebp(80));
                $student->update(['photo_path' => 'storage/'.$new]);
                $converted++;
            } catch (Throwable $e) {
                $this->error("Failed {$student->id}: {$e->getMessage()}");
                $failed++;
            }
        }

        $this->info("Converted: {$converted}");
        $this->info("Missing files: {$missing}");
        $this->info("Failed: {$failed}");

        return self::SUCCESS;
    }
}
