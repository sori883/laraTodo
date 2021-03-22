<?php

namespace App\Http\Controllers;

use App\Task;
use Auth;
use App\Http\Requests\TaskRequest;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TaskController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Task::class, 'task');
    }

    public function index()
    {
        $user = Auth::user();
        // インボックスタスクを取得する
        $tasks = $user->tasks->whereNull('project_id')->whereNull('status')->sortByDesc('id');

        return $tasks;
    }

    public function projectTask(string $project_id)
    {
        $user = Auth::user();
        // 選択プロジェクトに属するタスクを取得する
        $tasks = $user->tasks->where('project_id', $project_id)->whereNull('status')->sortByDesc('id');

        return $tasks;
    }

    public function store(TaskRequest $request, Task $task)
    {
        $task->fill($request->all());
        $task->user_id = $request->user()->id;
        $task->save();

        $tasks = $this->index();

        return $tasks;
    }

    public function update(TaskRequest $request, Task $task)
    {
        $task->fill($request->all())->save();
        $tasks = $this->index();

        return $tasks;
    }

    public function destroy(Task $task)
    {
        $task->delete();
        $tasks = $this->index();

        return $tasks;
    }

    public function complite(Task $task)
    {
        $task->status = Carbon::now();
        $task->save();

        $tasks = $this->index();

        return $tasks;
    }

    public function uncomplite(Task $task)
    {
        $task->status = null;
        $task->save();

        $tasks = $this->index();

        return $tasks;
    }
}
