<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

final class BugBounty extends Model
{
    protected $fillable = [
        "name",
        "description",
        "url",
        "active"
    ];

    protected $table = "bug_bounties";

    protected $casts = [
        "active" => "boolean",
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reports(): HasMany
    {
        return $this->hasMany(related: BugBounty::class);
    }
}
