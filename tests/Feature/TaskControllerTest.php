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
    protected $taskProject;
    protected $taskInbox;
    protected $taskProjectOtherUser;
    protected $taskInboxOtherUser;

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

        // 他ユーザのタスク
        $this->taskProjectOtherUser = factory(Task::class)->create(
            ['project_id' => $this->project]
        );
        $this->taskInboxOtherUser = factory(Task::class)->create(
            ['project_id' => $this->project]
        );

        $this->actingAs($this->user);
    }

    public function testGetInboxTask(): void
    {
        $response = $this->get(route('tasks.index'));

        $response
            ->assertStatus(200)
            ->assertJsonCount(1)
            ->assertJsonFragment([
                'id' => $this->taskInbox->id,
                "deleted_at" => null
            ])
            ->assertJsonMissing([
                'id' => $this->taskProjectOtherUser->id,
                'id' => $this->taskProject ->id
            ]);
    }

    public function testGetProjectTask(): void
    {
        // 取得しないプロジェクトのタスク
        $taskOtherProject = factory(Task::class)->create(['user_id' => $this->user]);

        $response = $this->get(route('tasks.project', $this->taskProject->project->id));

        $response
            ->assertStatus(200)
            ->assertJsonCount(1)
            ->assertJsonFragment([
                'id' => $this->taskProject->id,
                "deleted_at" => null
            ])
            ->assertJsonMissing([
                'id' => $this->taskProjectOtherUser->id,
                'id' => $taskOtherProject->id
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
            ->assertJsonCount(2)
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
        $responseTask = $this->get(route('tasks.project', $this->taskProject->project->id));

        // タスク登録が正常か確認
        $responseCreate->assertStatus(200);
        $this->assertDatabaseHas('tasks', [
            'title' => $taskTitle,
            'project_id' => $this->project->id
        ]);

        // 登録したタスクが取得出来ているか確認
        $responseTask
            ->assertStatus(200)
            ->assertJsonCount(2)
            ->assertJsonFragment([
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

        $response = $this->json('patch', route('tasks.update', $this->taskInbox->id), [
            'title' => $taskTitle,
            'project_id' => null,
            'limit_at' => Carbon::now()->format('Y/m/d H:i'),
        ]);

        $response
            ->assertStatus(200)
            ->assertJsonCount(2)
            ->assertJsonFragment([
                'title' => $taskTitle,
                'project_id' => null,
            ])
            ->assertJsonFragment([
                'title' => $taskOther->title,
            ]);
        $this->assertDatabaseHas('tasks', ['title' => $taskTitle]);
    }

    public function testDestroyTask(): void
    {
        // 削除されないタスクを作成
        $taskNotDelete = factory(Task::class)->create([
            'user_id' => $this->user->id,
            'project_id' => null
        ]);

        $response = $this->delete(route('tasks.destroy', $this->taskInbox->id));

        $response
            ->assertStatus(200)
            ->assertJsonCount(1)
            ->assertJsonFragment([
                'title' => $taskNotDelete->title,
            ]);
        $this->assertSoftDeleted('tasks', ['id' => $this->taskInbox->id]);
        $this->assertDatabaseHas('tasks', ['id' => $taskNotDelete->id]);
    }

    public function testCompliteTask(): void
    {
        $compliteData = Carbon::create(2001, 5, 21, 12);
        Carbon::setTestNow($compliteData);

        $response =  $this->json('patch', route('tasks.complite', $this->taskInbox->id));

        $response
            ->assertStatus(200)
            ->assertJsonCount(0);
        $this->assertDatabaseHas('tasks', ['status' => Carbon::Now()]);
    }

    public function testUnCompliteTask(): void
    {
        $task = factory(Task::class)->create([
            'status' => Carbon::now()
        ]);

        $response = $this->json('patch', route('tasks.complite', $task->id));

        $response
            ->assertStatus(200)
            ->assertJsonCount(1)
            ->assertJsonFragment([
                'status' => null
            ]);
        $this->assertDatabaseHas('tasks', ['status' => null]);
    }
}
