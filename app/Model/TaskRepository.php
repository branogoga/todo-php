<?php

declare(strict_types=1);

namespace App\Model;

interface TaskRepository {
    /** @return array<mixed> */
    public function getAll(): array;

    /** @return array<mixed> */
    public function get(int $id): ?array;

    /**
     * @param array<mixed> $task
     */
    public function insert(array $task): void;

    /**
     * @param array<mixed> $task
     */
    public function update(array $task): void;
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

    public function get(int $id): ?array
    {
        $result = $this->database->query("SELECT * FROM ".\App\Model\TaskTable::TABLE_NAME." WHERE ".\App\Model\TaskTable::ID." = %i", $id)->fetch();
        if($result instanceof \Dibi\Row) {
            $result = $result->toArray();
        }
        return $result;
    }

    public function insert(array $task): void 
    {
        unset($task[\App\Model\TaskTable::ID]);
        $this->database->query("INSERT INTO ".\App\Model\TaskTable::TABLE_NAME." %v", $task);
    }

    public function update(array $task): void
    {
        $id = $task[\App\Model\TaskTable::ID];
        unset($task[\App\Model\TaskTable::ID]);
        $this->database->query("UPDATE ".\App\Model\TaskTable::TABLE_NAME." SET", $task, "WHERE ".\App\Model\TaskTable::ID."=?", $id);
    }
}