<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Researcher extends Model
{
    protected $fillable = [
        "name",
        "email"
    ];

    protected $table = "researchers";

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bugReports(): HasMany
    {
        return $this->hasMany(related: BugReport::class);
    }
}
