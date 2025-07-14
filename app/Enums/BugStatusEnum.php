<?php

namespace App\Enums;

enum BugStatusEnum: string
{
    case OPEN = "open";
    case IN_PROGRESS = "in_progress";
    case CLOSED = "closed";
}
