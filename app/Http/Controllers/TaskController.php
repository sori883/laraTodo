<?php

namespace App\Http\Controllers;

use App\Task;

use App\Http\Requests\TaskRequest;
use Illuminate\Http\Request;


class TaskController extends Controller
{

    public function store(TaskRequest $request, Task $task){
        $task->fill($request->all());
        $task->user_id = $request->user()->id;
        $task->save();

        return redirect()->route('projects.index');
    }

    public function destroy(Task $task)
    {
        $task->delete();
    }


}
