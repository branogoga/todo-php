<?php

declare(strict_types=1);

namespace App\Model;

final class Task
{
    public function __construct(
        public readonly int $id, 
        public readonly string $title, 
        public readonly string $created_at, 
        public ?string $completed_at
        ) 
    {
    }

    /**
     * @param array<mixed> $data
     */
    static function fromArray(array $data): Task
    {
        return new Task(
            (int)$data[\App\Model\TaskTable::ID],
            (string)$data[\App\Model\TaskTable::TITLE],
            (string)$data[\App\Model\TaskTable::CREATED_AT],
            (string)$data[\App\Model\TaskTable::COMPLETED_AT],
        );
    }

    /** @return array<mixed> */
    public function toArray(): array
    {
        return [
            TaskTable::ID => $this->id,
            TaskTable::TITLE => $this->title,
            TaskTable::CREATED_AT => $this->created_at,
            TaskTable::COMPLETED_AT => $this->completed_at,
        ];
    }

    public function complete(): void
    {
        if(!$this->completed_at)
        {
            $this->completed_at = date("Y-m-d H:i:s");
        }
    }
}

