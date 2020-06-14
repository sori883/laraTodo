<?php

namespace App\Http\Controllers;

use App\Project;
use App\Task;
use Auth;

use App\Http\Requests\ProjectRequest;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $projects = $user->project->sortByDesc('created_at');
        // プロジェクトに属していないタスクをinboxタスクとして取得
        $tasks = $user->tasks->whereNull('project_id')->sortByDesc('created_at');

        return view('projects.index', [
            'projects' => $projects,
            'tasks' => $tasks
        ]);
    }

    public function show(Project $project)
    {
        $user = Auth::user();

        $projects = $user->project->sortByDesc('created_at');
        $tasks = $project->task->sortByDesc('created_at');

        return view('projects.index', [
            'projects' => $projects,
            'tasks' => $tasks
        ]);
    }

    public function store(ProjectRequest $request, Project $project){
        $project->fill($request->all());
        $project->user_id = $request->user()->id;
        $project->save();

        return redirect()->route('projects.index');
    }

}
