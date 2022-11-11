<?php

declare(strict_types=1);

namespace App\Model;

final class TaskTable {
    public const    TABLE_NAME = "tasks";

    public const    ID = "task_id";
    public const    TITLE = "task_title";
    public const    CREATED_AT = "task_created_at";
    public const    COMPLETED_AT = "task_completed_at";    
}

