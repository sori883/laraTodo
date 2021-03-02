<?php

namespace Tests\Feature;

use App\User;
use App\Project;
use App\Task;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskControllerErrorTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected $project;
    protected $taskProject;
    protected $taskInbox;

    public function setUp(): void
    {
        parent::setUp();

        $this->project = factory(Project::class)->create();
        $this->user = $this->project->user;

        // プロジェクトに属しているタスクと属していないタスクを作成
        $this->taskProject = factory(Task::class)->create([
            'user_id' => $this->user,
            'project_id' => $this->project
        ]);
        $this->taskInbox = factory(Task::class)->create([
            'user_id' => $this->user,
            'project_id' => null
        ]);
    }

    public function testGetInboxTask(): void
    {
        $this->get(route('tasks.index'))
            ->assertStatus(403);
    }

    public function testGetProjectTask(): void
    {
        $response = $this->get(route('tasks.project', $this->taskProject->project->id))
            ->assertStatus(500);
    }

    public function testCreateTask(): void
    {
        $taskTitle = 'testCreateTask';

        $this->json('post', route('tasks.store'), [
            'title' => $taskTitle,
            'limit_at' => Carbon::now()->format('Y/m/d H:i'),
        ])->assertStatus(403);

        $this->assertDatabaseMissing('tasks', [
            'title' => $taskTitle,
            'project_id' => null
        ]);
    }

    public function testUpdateTask(): void
    {

        $this->json('patch', route('tasks.update', $this->taskInbox->id), [
            'title' => $taskTitle,
            'project_id' => null,
            'limit_at' => Carbon::now()->format('Y/m/d H:i'),
        ])->assertStatus(403);

        $this->assertDatabaseMissing('tasks', ['title' => $taskTitle]);
    }

    public function testDestroyTask(): void
    {
        $this->delete(route('tasks.destroy', $this->taskInbox->id))
            ->assertStatus(403);

        $this->assertDatabaseHas('tasks', ['id' => $taskInbox->id]);
    }

}
