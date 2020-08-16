<?php

namespace App\Http\Controllers;

use App\Project;
use Auth;

use App\Http\Requests\ProjectRequest;
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
        $projects = $user->project->sortByDesc('created_at');

        return $projects;
    }

    public function store(ProjectRequest $request, Project $project){
        $project->fill($request->all());
        $project->user_id = $request->user()->id;
        $project->save();

        $user = Auth::user();
        $projects = $user->project->sortByDesc('created_at');

        return $projects;
    }

    public function update(ProjectRequest $request, Project $project)
    {
        $project->fill($request->all())->save();
        return redirect()->route('projects.index');
    }

    public function destroy(string $project_id)
    {
        $project = Project::where('id', $project_id)->first();
        $project->delete();

        $user = Auth::user();
        $projects = $user->project->sortByDesc('created_at');

        return $projects;
    }

}
