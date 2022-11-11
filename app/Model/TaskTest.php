<?php 

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class TaskTest extends TestCase
{
    public function testCreateTaskFromArray(): void
    {
        $task = \App\Model\Task::fromArray([
            \App\Model\TaskTable::ID => 1,
            \App\Model\TaskTable::TITLE => "Awesome title",
            \App\Model\TaskTable::CREATED_AT => date("Y-m-d H:i:s"),
            \App\Model\TaskTable::COMPLETED_AT => null,
        ]);
        $this->assertTrue($task instanceof \App\Model\Task);
        $this->assertEquals(1, $task->id);
        $this->assertEquals("Awesome title", $task->title);
        $this->assertIsString($task->created_at);//TODO: Check datetime format
        $this->assertEquals(null, $task->completed_at);
    }

    public function testExportTaskToArray(): void
    {
        $task = new \App\Model\Task(1, "Awesome title", "2020-05-17 16:46:29", null);
        $data = $task->toArray();
        $this->assertIsArray($data);
        $this->assertEquals(1, $data[\App\Model\TaskTable::ID]);
        $this->assertEquals("Awesome title", $data[\App\Model\TaskTable::TITLE]);
        $this->assertEquals("2020-05-17 16:46:29", $data[\App\Model\TaskTable::CREATED_AT]);
        $this->assertEquals(null, $data[\App\Model\TaskTable::COMPLETED_AT]);
    }

    public function testCompleteSetsCompletionDateIfNotSetBefore(): void
    {
        $task = new \App\Model\Task(1, "Awesome title", "2020-05-17 16:46:29", null);
        $task->complete();
        $this->assertIsString($task->completed_at);
    }


    public function testCompleteLetsCompletionDateUnchangedIfAlreadyCompleted(): void
    {
        $task = new \App\Model\Task(1, "Awesome title", "2020-05-17 16:46:29", "2020-05-18 17:49:31");
        $task->complete();
        $this->assertEquals("2020-05-18 17:49:31", $task->completed_at);
    }
}