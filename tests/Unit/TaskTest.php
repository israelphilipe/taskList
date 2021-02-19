<?php

namespace Tests\Unit;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function check_if_only_title_is_required()
    {

        Task::create([
            'title' => 'some title'
        ]);
        $this->assertCount(1,Task::all());
    }
    /**
     * @test
     */
    public function check_if_isDone_attribute_defaults_to_false()
    {
        $task = Task::create([
            'title' => 'some title'
        ]);
        //could do $this->assertTrue(!$task['isDone']), but for easy of understanding decided to go with the following
        $defaultsToFalse = ($task['isDone'] == false);
        $this->assertTrue($defaultsToFalse);
    }

    /**
     * @test
     */
    public function check_if_isDone_attribute_can_be_updated()
    {

        $task = Task::create([
            'title' => 'some title'
        ]);
        //test to true
        $expected = true;
        $actual = $this->updateTask($expected,$task->id);
        $this->assertEquals($expected,$actual);
        //test to false
        $expected = false;
        $actual = $this->updateTask($expected,$task->id);
        $this->assertEquals($expected,$actual);
        
    }

    /**
     * @test
     */
    public function check_if_task_can_be_deleted(){
        $task = Task::create([
            'title' => 'some title'
        ]);
        $count = Task::count();
        $task->delete();
        $newCount = Task::count();
        $removed = $newCount < $count;
        $this->assertTrue($removed);
    }

    private function updateTask($expected,$taskId){
        $task = Task::find($taskId);
        $task->isDone = $expected;
        $task->update();
        $task = Task::find($taskId);
        $actualResult = $task->isDone;
        return $actualResult;
    }
}
