<?php
namespace App\Tests;
use PHPUnit\Framework\TestCase;
use App\Models\TaskModel;
use App\Models\FileDatabase;

class TaskModelTest extends TestCase {

    public function testGetToDoTasks() {
        
        $connection = $this->createStub(FileDatabase::class);
        $connection->method('getAllRecords')->willReturn([
            ['task' => 'test task 1', 'status' => 'todo'],
            ['task' => 'test task 2', 'status' => 'todo'],
            ['task' => 'test task 3', 'status' => 'done'],
        ]);

        $model = new TaskModel($connection);
        $tasks = $model->getToDoTasks();

        $this->assertSame(2, count($tasks));
        $this->assertSame('test task 1', $tasks[0]['task']);
        $this->assertSame('test task 2', $tasks[1]['task']);
    }

    public function testAddTask() {
        
        $connection = $this->createMock(FileDatabase::class);
        $connection->method('insertRecord')->willReturn(true);

        // We expect the insertRecord method to be called once with the following data array: ['task' => 'test task', 'status' => 'todo']
        $connection->expects($this->once())
                   ->method('insertRecord')
                   ->with($this->equalTo(['task' => 'test task', 'status' => 'todo']));

        $model = new TaskModel($connection);
        $result = $model->addTask('test task');

        $this->assertSame($model, $result);
    }

    public function testGetDoneTasks() {
        $connection = $this->createStub(FileDatabase::class);
        $connection->method('getAllRecords')->willReturn([
            ['task' => 'test task 1', 'status' => 'todo'],
            ['task' => 'test task 2', 'status' => 'done'],
            ['task' => 'test task 3', 'status' => 'done'],
        ]);

        $model = new TaskModel($connection);
        $tasks = $model->getDoneTasks();

        $this->assertSame(2, count($tasks));
        $this->assertSame('test task 2', $tasks[0]['task']);
        $this->assertSame('test task 3', $tasks[1]['task']);
    }

}