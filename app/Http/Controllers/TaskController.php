<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Http\Requests\TaskRequest;
class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Task[]\Illuminate\Database\Eloquent\Coolection
     */
    public function index()
    {
        return Task::orderByDesc("id")->get();
    }
    /**
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * 
     */
    public function store(TaskRequest $request)
    {
        $task = Task::create($request->all());
        return $task
            ? response()->json($task, 201)
            : response()->json([], 500); 
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(TaskRequest $request, Task $task)
    {
        $task->title = $request->title;
        return $task->update()
            ? response()->json($task)
            : response()->json([], 500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Task $task)
    {
        return $task->delete()
            ? response()->json($task)
            : response()->json([], 500);
    }
}
