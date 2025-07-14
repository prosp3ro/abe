<?php

namespace App\Interfaces;

use App\Models\BugReport;
use Illuminate\Pagination\LengthAwarePaginator;

interface BugReportServiceInterface
{
    public function listReports(int $perPage = 20): LengthAwarePaginator;
    public function createReport(array $data): BugReport;
    public function updateReport(int $id, array $data): BugReport;
    // public function closeReport(int $id): bool;
    public function deleteReport(int $id): void;
}
