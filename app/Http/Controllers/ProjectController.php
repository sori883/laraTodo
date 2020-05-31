<?php

namespace App\Http\Controllers;

use App\Project;
use App\Task;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::all()->sortByDesc('created_at');
        $tasks = Task::all()->sortByDesc('created_at');

        return view('Projects.index', ["projects" => $projects]);
    }
}
