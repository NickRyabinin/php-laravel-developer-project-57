<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Task;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    private User $user;
    private Task $task;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->task = Task::factory()->make();
    }

    /**
     * A 'tasks.index' Page accessibility test.
     */
    public function test__tasks_index_screen_can_be_rendered(): void
    {
        $response = $this->get(route('tasks.index'));
        $response->assertStatus(200);
        $response->assertSee('Задачи');
    }

    /**
     * A 'tasks.create' page accessibility test.
     */
    public function test_tasks_create_screen_can_be_rendered_for_authenticated_user(): void
    {
        $response = $this->actingAs($this->user)->get(route('tasks.create'));
        $response->assertStatus(200);
        $response->assertSee('Создать задачу');
    }

    public function test_tasks_create_screen_can_not_be_rendered_for_guest_user(): void
    {
        $response = $this->get(route('tasks.create'))->assertStatus(403);
    }

    /**
     * A 'tasks.store' test.
     */
    public function test_tasks_store_action_can_save_new_task_to_database(): void
    {
        $response = $this->actingAs($this->user)
            ->post(route('tasks.store'),
                [
                    'name' => $this->task->name,
                    'description' => $this->task->description,
                    'status_id' => $this->task->status_id,
                    'assigned_to_id' => $this->task->assigned_to_id,
                ]);
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('tasks',
            [
                'name' => $this->task->name,
                'description' => $this->task->description,
                'status_id' => $this->task->status_id,
                'assigned_to_id' => $this->task->assigned_to_id,
            ]);
        $response->assertRedirect(route('tasks.index'));
        $this->get(route('tasks.index'))->assertSee($this->task->name);
    }
}
