<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;

class TaskController extends Controller
{

    public function store(Task $task){
        return redirect()->route('projects.index');
    }

}
