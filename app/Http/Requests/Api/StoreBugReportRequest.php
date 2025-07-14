<?php

namespace App\Http\Requests\Api;

use App\Enums\BugSeverityEnum;
use App\Enums\BugStatusEnum;
use App\Models\BugBounty;
use App\Models\Researcher;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

final class StoreBugReportRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "project_id" => ["required", "exists:" . BugBounty::class . ",id"],
            "researcher_id" => ["required", "exists:" . Researcher::class . ",id"],
            "title" => ["required", "string", "max:255"],
            "description" => ["required", "string"],
            // php 8.1+
            "severity" => ["required", new Enum(BugSeverityEnum::class)],
            "status" => ["required", new Enum(BugStatusEnum::class)],
        ];
    }
}
