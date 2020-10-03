<?php

namespace App\Http\Controllers;

use App\Task;
use Auth;

use App\Http\Requests\TaskRequest;
use Illuminate\Http\Request;


class TaskController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        // インボックスタスクを取得する
        $tasks = $user->tasks->whereNull('project_id')->sortByDesc('id');

        return $tasks;
    }

    public function projectTask(string $project_id)
    {
        $user = Auth::user();
        // 選択プロジェクトに属するタスクを取得する
        $tasks = $user->tasks->where('project_id', $project_id)->sortByDesc('id');

        return $tasks;
    }

    public function store(TaskRequest $request, Task $task){
        $task->fill($request->all());
        $task->user_id = $request->user()->id;
        $task->save();

        return redirect()->route('projects.index');
    }

    public function destroy(string $task_id)
    {
        $task = Task::where('id', $task_id)->first();
        $task->delete();

        $user = Auth::user();
        $tasks = $user->tasks->whereNull('project_id')->sortByDesc('id');

        return $tasks;
    }


}
