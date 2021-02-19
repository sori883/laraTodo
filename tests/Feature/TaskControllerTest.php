<?php

namespace Tests\Feature;

use App\User;
use App\Project;
use App\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $project;

    public function setUp(): void
    {
        parent::setUp();

        $this->project = factory(Project::class)->create();
        $this->user = $this->project->user;
        $this->actingAs($this->user);
    }
}
