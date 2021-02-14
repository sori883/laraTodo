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

    protected $user, $project;

    public function setUp(): void
    {
        parent::setUp();
        $this->project = factory(Project::class)->create();
        $this->user = $this->project->user;
        // ログイン
        $this->actingAs($this->user);
        $this->withoutExceptionHandling();
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

        $response->dump();

        $response
            ->assertStatus(200)
            ->assertJsonCount(2)
            ->assertJsonFragment([
                'title' => $projectTitle
            ]);
    }

    // NG:policy
    public function testUpdateProject(): void
    {
        $projectTitle = 'testUpdateProject';
        $response = $this->json(
            'patch',
            route('projects.update', ['project' => $this->project->id]),
            ['title' => $projectTitle]
        );

        $response
            ->assertStatus(200)
            ->assertJsonCount(2);
    }

    // NG:policy
    public function testDestroyProject(): void
    {
        $response = $this->json(
            'delete',
            route('projects.destroy', ['project' => $this->project->id])
        );

        $response
            ->assertStatus(200)
            ->assertJsonCount(0);
    }
}
