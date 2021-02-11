<?php

namespace App\Http\Controllers;

use App\Project;
use Auth;
use App\Http\Requests\ProjectRequest;
use Barryvdh\Debugbar\Twig\Extension\Debug;
use Illuminate\Http\Request;

class ProjectController extends Controller
{

    public function __construct()
    {
        // $this->authorizeResource(Project::class, 'project');
    }

    public function index()
    {
        $user = Auth::user();
        $projects = $user->project->sortByDesc('id');

        return $projects;
    }

    public function store(ProjectRequest $request, Project $project)
    {
        $project->fill($request->all());
        $project->user_id = $request->user()->id;
        $project->save();

        $projects = $this->index();

        return $projects;
    }

    public function update(ProjectRequest $request, string $project_id)
    {
        $project = Project::where('id', $project_id)->first();
        $project->fill($request->all())->save();

        $projects = $this->index();

        return $projects;
    }

    public function destroy(string $project_id)
    {
        $project = Project::where('id', $project_id)->first();
        $project->delete();

        $projects = $this->index();

        return $projects;
    }
}
