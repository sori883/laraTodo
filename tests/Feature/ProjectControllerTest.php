<?php

namespace Tests\Feature;

use App\User;
use App\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProjectControllerTest extends TestCase
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
        $this->actingAs($this->user);
    }


    public function testGetProject(): void
    {
        // 他ユーザのプロジェクトが取得されていないか検証するためプロジェクトを生成
        $projectOther = factory(Project::class)->create();

        $response = $this->get(route('projects.index'));

        $response
            ->assertStatus(200)
            ->assertJsonCount(1)
            ->assertJsonFragment([
                'id' => $this->project->id,
                "deleted_at" => null
            ])
            ->assertJsonMissing([
                'id' => $projectOther->id,
            ]);
    }

    public function testCreateProject(): void
    {
        $projectTitle = 'testCreateProject';
        $response = $this->json('post', route('projects.store'), [
            'title' => $projectTitle,
        ]);

        $response
            ->assertStatus(200)
            ->assertJsonCount(2)
            ->assertJsonFragment([
                'title' => $projectTitle
            ]);
        $this->assertDatabaseHas('projects', ['title' => $projectTitle]);
    }

    public function testUpdateProject(): void
    {
        // 更新するプロジェクト名
        $projectTitle = $this->faker->unique()->realText(10);
        // 更新しないプロジェクトを作成
        $projectOther = factory(Project::class)->create(['user_id' => $this->user->id]);

        $response = $this->json('patch', route('projects.update', $this->project->id), [
            'title' => $projectTitle
        ]);

        $response
            ->assertStatus(200)
            ->assertJsonCount(2)
            ->assertJsonFragment([
                'title' => $projectTitle,
            ])
            ->assertJsonFragment([
                'title' => $projectOther->title,
            ]);
        $this->assertDatabaseHas('projects', ['title' => $projectTitle]);
    }

    public function testDestroyProject(): void
    {
        // 削除されないプロジェクトを作成
        factory(Project::class)->create(['user_id' => $this->user->id]);
        $response = $this->delete(route('projects.destroy', $this->project->id));

        $response
            ->assertStatus(200)
            ->assertJsonCount(1);
        $this->assertSoftDeleted('projects', ['id' => $this->project->id]);
    }
}
