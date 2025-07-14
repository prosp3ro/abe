<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use App\Enums\BugSeverityEnum;
use App\Enums\BugStatusEnum;
use App\Models\BugBounty;
use App\Models\Researcher;
use Illuminate\Validation\Rules\Enum;

final class UpdateBugReportRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "project_id" => ["sometimes", "exists:" . BugBounty::class . ",id"],
            "researcher_id" => ["sometimes", "exists:" . Researcher::class . ",id"],
            "title" => ["sometimes", "string", "max:255"],
            "description" => ["sometimes", "string"],
            // php 8.1+
            "severity" => ["sometimes", new Enum(BugSeverityEnum::class)],
            "status" => ["sometimes", new Enum(BugStatusEnum::class)],
        ];
    }
}
