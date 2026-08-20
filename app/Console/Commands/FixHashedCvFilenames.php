<?php

namespace App\Console\Commands;

use App\Models\JobApplication;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

/**
 * Older job applications (submitted before cv_original_name was tracked, or affected by a
 * since-fixed bug) ended up with the storage disk's random hashed filename saved into
 * cv_original_name instead of the applicant's real CV filename — e.g.
 * "KG2QRHKmFbvvySZ3W4gnPPiidTIu75gE5JHVqzSk" instead of "John_Doe_CV.pdf".
 *
 * That original filename was never stored anywhere, so it can't be recovered. This command
 * instead replaces the hash-looking value with a readable, deterministic name built from the
 * applicant's own name — e.g. "John Doe - CV.pdf" — so downloads are at least identifiable,
 * even though it isn't the literal file the candidate uploaded.
 */
class FixHashedCvFilenames extends Command
{
    protected $signature = 'job-applications:fix-hashed-cv-names {--dry-run : Preview changes without saving them}';

    protected $description = 'Replace hash-looking cv_original_name values with a readable "{Applicant Name} - CV.ext" name';

    public function handle(): int
    {
        $dryRun = (bool) $this->option('dry-run');

        $applications = JobApplication::whereNotNull('cv_path')->get();

        $affected = $applications->filter(fn (JobApplication $app) => $this->looksHashed($app->cv_original_name));

        if ($affected->isEmpty()) {
            $this->info('No hash-looking cv_original_name values found. Nothing to do.');

            return self::SUCCESS;
        }

        $this->info(($dryRun ? '[DRY RUN] ' : '') . "Found {$affected->count()} application(s) with a hash-looking CV filename:");
        $this->newLine();

        $rows = [];

        foreach ($affected as $application) {
            $newName = $this->buildReadableName($application);
            $rows[] = [$application->id, $application->name, $application->cv_original_name, $newName];

            if (! $dryRun) {
                $application->update(['cv_original_name' => $newName]);
            }
        }

        $this->table(['ID', 'Applicant', 'Old (hashed) name', 'New name'], $rows);

        if ($dryRun) {
            $this->newLine();
            $this->comment('Dry run only — no changes were saved. Re-run without --dry-run to apply.');
        } else {
            $this->newLine();
            $this->info('Done — cv_original_name updated for all listed applications.');
        }

        return self::SUCCESS;
    }

    /**
     * Heuristic: a real uploaded filename almost always has an extension and usually contains
     * a space, underscore, or hyphen-separated words. A storage-generated hash is a long run
     * of mixed-case letters/digits with no extension and no word separators.
     */
    private function looksHashed(?string $name): bool
    {
        if ($name === null || $name === '') {
            return true;
        }

        $hasExtension = (bool) preg_match('/\.[a-zA-Z0-9]{2,5}$/', $name);
        $looksLikeRandomToken = (bool) preg_match('/^[A-Za-z0-9]{20,}(\.[a-zA-Z0-9]{2,5})?$/', $name)
            && ! preg_match('/[\s_-]/', $name);

        return ! $hasExtension || $looksLikeRandomToken;
    }

    private function buildReadableName(JobApplication $application): string
    {
        $extension = pathinfo($application->cv_path, PATHINFO_EXTENSION) ?: 'pdf';

        $safeApplicantName = trim(preg_replace('/[^A-Za-z0-9 _-]/', '', $application->name)) ?: 'Applicant';

        return "{$safeApplicantName} - CV.{$extension}";
    }
}
