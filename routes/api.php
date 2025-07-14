<?php

use App\Http\Controllers\Api\BugBountyController;
use App\Http\Controllers\Api\BugReportController;
use App\Http\Controllers\Api\ResearcherController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get("/user", function (Request $request) {
    return $request->user();
})->middleware("auth:sanctum");

Route::prefix("v1")->group(function () {
    Route::apiResource("bug-reports", BugReportController::class);
    Route::apiResource("researchers", ResearcherController::class);
    Route::apiResource("bug-bounties", BugBountyController::class);
});
