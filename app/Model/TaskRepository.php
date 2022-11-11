<?php

declare(strict_types=1);

namespace App\Model;

use Nette;


final class TaskTable {
    public const    TABLE_NAME = "tasks";

    public const    ID = "task_id";
    public const    TITLE = "task_title";
    public const    CREATED_AT = "task_created_at";
    public const    COMPLETED_AT = "task_completed_at";    
}

interface TaskRepository {
    /** @return array<mixed> */
    public function getAll(): array;
}

final class DatabaseTaskRepository implements TaskRepository
{
    private \Dibi\Connection $database;

	public function __construct(\Dibi\Connection $database)
	{
        $this->database = $database;
	}

    public function getAll(): array
    {
        return $this->database->query("SELECT * FROM ".\App\Model\TaskTable::TABLE_NAME." ORDER BY ".\App\Model\TaskTable::CREATED_AT)->fetchAll();        
    }
}