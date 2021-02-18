<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response['tasks'] = Task::orderBy('isDone','DESC')->orderBy('title','ASC')->get();
        $response['itemsLeft'] = Task::where('isDone','=','false')->count();
        return response()->json($response);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = request()->validate([
            'title' => 'required|string|min:1|max:100'
        ]);

        $task = Task::create($data);
        return response()->json($task);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
       $data = request()->validate([
           'isDone' => 'required|boolean'
       ]);
       $task->isDone = $data['isDone'];
       $task->update();
       return $task;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();
    }

    /**
     * Search with filters
     */

    public function search(Request $request)
    {
        $data = request()->validate([
            'isDone' => 'required'
        ]);
        $isDone = $data['isDone'];

        $response['tasks'] = Task::where('isDone','=',$isDone)
                                    ->orderBy('isDone','DESC')->orderBy('title','ASC')->get();
        $response['itemsLeft'] = Task::where('isDone','=','false')->count();
        return response()->json($response);
    }
    
}
