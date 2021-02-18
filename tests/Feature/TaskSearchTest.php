<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Task;

class TaskSearchTest extends TestCase
{

    Use RefreshDatabase;
    /**
     * @test
     */
    public function task_search_for_done()
    {
        $this->withoutExceptionHandling();
        $totalTasks = 10;
        $totalDone = 4;
        $this->generateTasks($totalTasks,$totalDone);

        
        $response = $this->get('api/tasks/search?isDone=true');
        $response->assertJsonCount($totalDone,'tasks');
        
    }

    /**
     * @test
     */
    public function task_search_for_not_done()
    {
        $totalTasks = 10;
        $totalDone = 4;
        $totalNotDone = $totalTasks - $totalDone;
        $this->generateTasks($totalTasks,$totalDone);

        
        $response = $this->get('api/tasks/search?isDone=false');
        $response->assertJsonCount($totalNotDone,'tasks');
    }

    /**
     * Generate the tasks based on the needs of test method
     */
    private function generateTasks($total,$totalDone){
        if($totalDone > $total) return 'some mistake must´ve happened';
        $doneCount = 0;
        for($i = 0;$i < $total;$i++){
            $this->post('api/tasks',[
                'title' => 'New title'.$i
            ]);
            $taskId = Task::where('title','=','New title'.$i)->first()->id;
            if($doneCount < $totalDone){
                $this->patch('api/tasks/'.$taskId,[
                    'isDone' => true
                ]);
                $doneCount++;
            }
        }
    }
    

}
