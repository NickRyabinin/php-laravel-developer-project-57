<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Task;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    private User $user;
    private Task $task;
    private array $taskData;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->task = Task::factory()->make();
        $this->taskData = [
            'name' => $this->task->name,
            'description' => $this->task->description,
            'status_id' => $this->task->status_id,
            'assigned_to_id' => $this->task->assigned_to_id,
        ];
    }

    /**
     * A 'tasks.index' Page accessibility test.
     */
    public function testTasksIndexScreenCanBeRendered(): void
    {
        $response = $this->get(route('tasks.index'));
        $response->assertStatus(200);
        $response->assertSee(__('Задачи'));
    }

    /**
     * A 'tasks.create' page accessibility test.
     */
    public function testTasksCreateScreenCanBeRenderedForAuthenticatedUser(): void
    {
        $response = $this->actingAs($this->user)->get(route('tasks.create'));
        $response->assertStatus(200);
        $response->assertSee(__('Создать задачу'));
    }

    public function testTasksCreateScreenCanNotBeRenderedForGuestUser(): void
    {
        $this->get(route('tasks.create'))->assertStatus(403);
    }

    /**
     * A 'tasks.store' test.
     */
    public function testTasksStoreActionCanSaveNewTaskToDatabase(): void
    {
        $response = $this->actingAs($this->user)
            ->post(route('tasks.store'), $this->taskData);
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('tasks', $this->taskData);
        $response->assertRedirect(route('tasks.index'));
        $this->get(route('tasks.index'))->assertSee($this->task->name);
    }

    /**
     * A 'tasks.show' page accessibility test.
     */
    public function testTasksShowScreenCanBeRendered(): void
    {
        $this->task->save();
        $response = $this->get(route('tasks.show', ['task' => $this->task]));
        $response->assertStatus(200);
        $response->assertSee(__('Просмотр задачи'));
    }

    /**
     * A 'tasks.edit' page accessibility test.
     */
    public function testTasksEditScreenCanBeRenderedForAuthenticatedUser(): void
    {
        $this->task->save();
        $response = $this->actingAs($this->user)->get(route('tasks.edit', ['task' => $this->task]));
        $response->assertStatus(200);
        $response->assertSee(__('Изменение задачи'));
    }

    public function testTasksEditScreenCanNotBeRenderedForGuestUser(): void
    {
        $this->task->save();
        $this->get(route('tasks.edit', ['task' => $this->task]))->assertStatus(403);
    }

    /**
     * A 'tasks.update' test.
     */
    public function testTasksUpdateActionCanPatchExistingTaskInDatabase(): void
    {
        $this->task->save();
        $newTaskData = Task::factory()->make()->only(['name', 'description', 'status_id', 'assigned_to_id']);
        $response = $this->actingAs($this->user)
            ->patch(route('tasks.update', ['task' => $this->task]), $newTaskData);
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('tasks', $newTaskData);
        $response->assertRedirect(route('tasks.index'));
        $this->get(route('tasks.index'))->assertSee($newTaskData['name']);
    }

    /**
     * A 'tasks.destroy' test.
     */
    public function testTasksDestroyActionCanDeleteExistingTaskInDatabase(): void
    {
        $this->task->save();
        $response = $this->actingAs($this->user)
            ->delete(route('tasks.destroy', ['task' => $this->task]));
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseMissing('tasks', ['id' => $this->task->id]);
        $response->assertRedirect(route('tasks.index'));
        $this->get(route('tasks.index'))->assertDontSee($this->task->name);
    }
}
