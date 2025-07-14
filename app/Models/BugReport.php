<?php

namespace App\Models;

use App\Enums\BugSeverity;
use App\Enums\BugSeverityEnum;
use App\Enums\BugStatusEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class BugReport extends Model
{
    protected $fillable = [
        "project_id",
        "researcher_id",
        "title",
        "description",
        "severity",
        "status"
    ];

    protected $table = "bug_reports";

    protected $casts = [
        "severity" => BugSeverityEnum::class,
        "status" => BugStatusEnum::class
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function researcher(): BelongsTo
    {
        return $this->belongsTo(related: Researcher::class, foreignKey: "researcher_id", ownerKey: "id");
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bugBountyProject(): BelongsTo
    {
        return $this->belongsTo(related: BugBounty::class, foreignKey: "project_id", ownerKey: "id");
    }
}
