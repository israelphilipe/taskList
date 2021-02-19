<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Task;

class TaskManagementTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function task_can_be_created()
    {
        $this->withoutExceptionHandling();
        $title = 'A task that needs to be done';
        $response = $this->post('api/tasks',[
            'title' => $title
        ]);

        $response->assertStatus(200);
        //  assertCount(1,Task::all()) também funcionaria
        $this->assertCount(1,Task::where('title','=',$title)->get());
    }

    /** @test */
    public function title_is_required()
    {
        $response = $this->post('api/tasks',[
            'title' => ''
        ]);
        $response->assertSessionHasErrors();
    }

    /** @test */
    public function title_is_less_than_100_characters()
    {
        $title = 'a';
        for($i = 0; $i <= 100; $i++){
            $title.='a';
        }
        $response = $this->post('api/tasks',[
            'title' => $title
        ]);
        $response->assertSessionHasErrors();
    }
    /** @test */
    public function task_can_be_marked_as_done()
    {
        $this->post('api/tasks',[
            'title' => 'some title'
        ]);

        $taskId = Task::first()->id;
        $this->patch('api/tasks/'.$taskId ,[
            'isDone' => true
        ]);

        $this->assertEquals(Task::first()->isDone, true);
    }

    /** @test */
    public function task_can_be_marked_as_not_done()
    {
        $this->post('api/tasks',[
            'title' => 'some title'
        ]);
        $taskId = Task::first()->id;

        $this->patch('api/tasks/'.$taskId ,[
            'isDone' => true
        ]);
        $this->assertEquals(Task::first()->isDone, true);

        $this->patch('api/tasks/'.$taskId ,[
            'isDone' => false
        ]);
        $this->assertEquals(Task::first()->isDone, false);
    }

    /** @test */
    public function task_can_be_deleted()
    {
        $this->post('api/tasks',[
            'title' => 'some title'
        ]);
        $this->assertCount(1, Task::all());
        
        $taskId = Task::first()->id;
        $this->delete('api/tasks/'.$taskId);

        $this->assertCount(0, Task::all());
    }

    /** @test */
    public function task_can_delete_all()
    {
        
        $this->generateTasks(10);
        $this->assertCount(10, Task::all());
        $this->delete('api/tasks/clearAll');
        $this->assertCount(0, Task::all());
    }

    /** @test */
    public function task_can_delete_completed_tasks()
    {
        $this->withoutExceptionHandling();
        $this->generateTasks(10);
        $this->assertCount(10, Task::all());
        $totalDone = 4;
        $tasks = Task::all();
        for($i = 0;$i < $totalDone;$i++){
            $tasks[$i]->isDone = true;
            $tasks[$i]->update();
        }
        $total = count($tasks);
        $expected = $total - $totalDone;
        $this->delete('api/tasks/clearCompleted');
        $this->assertCount($expected, Task::all());
    }


    public function generateTasks($total){
        for($i = 0;$i < $total;$i++){
            $this->post('api/tasks',[
                'title' => 'some title'.$i
            ]);
        }
    }

}
