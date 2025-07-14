<?php

namespace App\Services;

use App\Interfaces\BugReportServiceInterface;
use App\Models\BugReport;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;

class BugReportService implements BugReportServiceInterface
{
    public function __construct() {}

    public function listReports(int $perPage = 20): LengthAwarePaginator
    {
        $key = "bug_reports_page_" . request("page", 1);

        return Cache::remember($key, now()->addMinutes(5), fn() => BugReport::with(["bugBountyProject", "researcher"])->paginate($perPage));
    }

    public function createReport(array $data): BugReport
    {
        $report = BugReport::create($data);

        // event, powiadomienia, etc

        Cache::flush();
        return $report;
    }

    public function updateReport(int $id, array $data): BugReport
    {

        $report = BugReport::findOrFail($id);
        $report->update($data);

        // event, powiadomienia, etc

        Cache::flush();
        return $report;
    }

    // public function closeReport(int $id): bool
    // {
    //     $report = BugReport::findOrFail($id);
    //     $report->status = "closed";
    //     // $report->closed_at = now();
    //
    //     Cache::flush();
    //
    //     return $report->save();
    // }

    public function deleteReport(int $id): void
    {
        $report = BugReport::findOrFail($id);
        $report->delete();

        Cache::flush();
    }
}
