<?php

namespace Tests\Feature;

use App\User;
use App\Project;
use App\Task;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected $user;
    protected $project;
    protected $task;
    protected $taskOtherUser;

    public function setUp(): void
    {
        parent::setUp();

        $this->project = factory(Project::class)->create();
        $this->user = $this->project->user;
        $this->task = factory(Task::class)->create([
            'user_id' => $this->user,
            'project_id' => $this->project
        ]);

        $this->actingAs($this->user);

        // 他ユーザのタスク
        $this->taskOtherUser = factory(Task::class)->create(
            ['project_id' => $this->project]
        );

        $this->withoutExceptionHandling();
    }

    public function testGetInboxTask(): void
    {
        // 取得するInboxタスク
        $taskInbox = factory(Task::class)->create([
            'user_id' => $this->user,
            'project_id' => null
        ]);

        $response = $this->get(route('tasks.index'));

        $response
            ->assertStatus(200)
            ->assertJsonCount(1)
            ->assertJsonFragment([
                'id' => $taskInbox->id,
                "deleted_at" => null
            ])
            ->assertJsonMissing([
                'id' => $this->taskOtherUser->id,
            ])
            ->assertJsonMissing([
                'id' => $this->task ->id,
            ]);
    }

    public function testGetProjectTask(): void
    {
        // 取得しないプロジェクトのタスク
        $taskOtherProject = factory(Task::class)->create(['user_id' => $this->user]);

        $response = $this->get(route('tasks.project', $this->task->project->id));

        $response
            ->assertStatus(200)
            ->assertJsonCount(1)
            ->assertJsonFragment([
                'id' => $this->task->id,
                "deleted_at" => null
            ])
            ->assertJsonMissing([
                'id' => $this->taskOtherUser->id,
            ])
            ->assertJsonMissing([
                'id' => $taskOtherProject->id,
            ]);
    }

    public function testCreateInboxTask(): void
    {
        $taskTitle = 'testCreateInboxTask';
        $response = $this->json('post', route('tasks.store'), [
            'title' => $taskTitle,
            'limit_at' => Carbon::now()->format('Y/m/d H:i'),
        ]);

        $response
            ->assertStatus(200)
            ->assertJsonCount(1)
            ->assertJsonFragment([
                'title' => $taskTitle,
                'project_id' => null
            ]);
        $this->assertDatabaseHas('tasks', [
            'title' => $taskTitle,
            'project_id' => null
        ]);
    }

    public function testCreateProjectTask(): void
    {
        $taskTitle = 'testCreateInboxTask';
        $responseCreate = $this->json('post', route('tasks.store'), [
            'title' => $taskTitle,
            'project_id' => $this->project->id,
            'limit_at' => Carbon::now()->format('Y/m/d H:i'),
        ]);

        // プロジェクトのタスクを取得する
        $responseTask = $this->get(route('tasks.project', $this->task->project->id));

        $responseCreate
        ->assertStatus(200)
        ->assertJsonCount(0);

        $responseTask
            ->assertStatus(200)
            ->assertJsonCount(2)
            ->assertJsonFragment([
                'title' => $taskTitle,
                'project_id' => $this->project->id
            ]);
        $this->assertDatabaseHas('tasks', [
            'title' => $taskTitle,
            'project_id' => $this->project->id
        ]);
    }

    public function testUpdateTask(): void
    {
        // 更新するプロジェクト名
        $taskTitle = $this->faker->unique()->realText(10);
        // 更新しないプロジェクトを作成
        $taskOther = factory(Task::class)->create([
            'user_id' => $this->user,
            'project_id' => null
        ]);

        $response = $this->json('patch', route('tasks.update', $this->task->id), [
            'title' => $taskTitle,
            'project_id' => null,
            'limit_at' => Carbon::now()->format('Y/m/d H:i'),
        ]);

        $response
            ->assertStatus(200)
            ->assertJsonCount(2)
            ->assertJsonFragment([
                'title' => $taskTitle,
                'project_id' =>null,
            ])
            ->assertJsonFragment([
                'title' => $taskOther->title,
            ]);
        $this->assertDatabaseHas('tasks', ['title' => $taskTitle]);
    }

    public function testDestroyTask(): void
    {
        // 削除されるタスク
        $taskDelete = factory(Task::class)->create([
            'user_id' => $this->user->id,
            'project_id' => null
        ]);
        // 削除されないタスクを作成
        factory(Task::class)->create([
            'user_id' => $this->user->id,
            'project_id' => null
        ]);

        $response = $this->delete(route('tasks.destroy', $taskDelete->id));

        $response
            ->assertStatus(200)
            ->assertJsonCount(1);
        $this->assertSoftDeleted('tasks', ['id' => $taskDelete->id]);
    }
}
