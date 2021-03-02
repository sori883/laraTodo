<?php

namespace Tests\Feature;

use App\User;
use App\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProjectControllerErrorTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected $user;
    protected $project;

    public function setUp(): void
    {
        parent::setUp();

        $this->project = factory(Project::class)->create();
        $this->user = $this->project->user;
    }

    public function testGetProject(): void
    {
        $this->get(route('projects.index'))
            ->assertStatus(403);
    }

    public function testCreateProject(): void
    {
        $projectTitle = 'testCreateProject';

        $this->json('post', route('projects.store'), [
            'title' => $projectTitle,
        ])->assertStatus(403);

        $this->assertDatabaseMissing('projects', ['title' => $projectTitle]);
    }

    public function testUpdateProject(): void
    {
        // 更新するプロジェクト名
        $projectTitle = $this->faker->unique()->realText(10);

        $this->json('patch', route('projects.update', $this->project->id), [
            'title' => $projectTitle
        ])->assertStatus(403);

        $this->assertDatabaseMissing('projects', ['title' => $projectTitle]);
    }

    public function testDestroyProject(): void
    {
        $this->delete(route('projects.destroy', $this->project->id))
            ->assertStatus(403);

        $this->assertDatabaseHas('projects', ['id' => $this->project->id]);
    }
}
