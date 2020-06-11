<?php

namespace App\Http\Controllers;

use App\Project;
use App\Task;
use Auth;
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

    public function store(Project $project){
        $user = Auth::user();

        $projects = $user->project->sortByDesc('created_at');
        $tasks = $project->task->sortByDesc('created_at');

        return view('projects.index', [
            'projects' => $projects,
            'tasks' => $tasks
        ]);
    }

}
