<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreBugReportRequest;
use App\Http\Requests\Api\UpdateBugReportRequest;
use App\Interfaces\BugReportServiceInterface;
use App\Models\BugReport;
use Symfony\Component\HttpFoundation\Response;

final class BugReportController extends Controller
{
    // constructor property promotion - nowa funkcjonalnosc 8.1
    public function __construct(
        protected BugReportServiceInterface $service
    ) {}

    public function index()
    {
        $reports = $this->service->listReports();

        return $this->respondSuccess([
            "items" => $reports->items(),
            "meta" => [
                "total" => $reports->total(),
                "per_page" => $reports->perPage(),
                "current_page" => $reports->currentPage(),
                "last_page" => $reports->lastPage(),
            ],
        ], status: Response::HTTP_OK);
    }

    public function store(StoreBugReportRequest $request)
    {
        $report = $this->service->createReport($request->validated());

        $this->respondSuccess($report, status: Response::HTTP_CREATED);
    }

    public function update(UpdateBugReportRequest $request, int $id)
    {
        $report = $this->service->updateReport($id, $request->validated());

        return $this->respondSuccess($report, status: Response::HTTP_OK);
    }

    public function show(int $id)
    {
        $this->respondSuccess(BugReport::findOrFail($id), status: Response::HTTP_OK);
    }

    public function destroy(int $id)
    {
        $this->service->deleteReport($id);

        return response()->noContent();
    }

    // ... closeReport
}
