<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\TaskStatus;

class TaskStatusTest extends TestCase
{
    use RefreshDatabase;

    private User $user;
    private TaskStatus $taskStatus;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->taskStatus = TaskStatus::factory()->make();
    }

    /**
     * A 'task_statuses.index' Page accessibility test.
     */
    public function testTaskStatusesIndexScreenCanBeRendered(): void
    {
        $response = $this->get(route('task_statuses.index'));
        $response->assertStatus(200);
        $response->assertSee(__('Статусы'));
    }

    /**
     * A 'task_statuses.create' page accessibility test.
     */
    public function testTaskStatusesCreateScreenCanBeRenderedForAuthenticatedUser(): void
    {
        $response = $this->actingAs($this->user)->get(route('task_statuses.create'));
        $response->assertStatus(200);
        $response->assertSee(__('Создать статус'));
    }

    public function testTaskStatusesCreateScreenCanNotBeRenderedForGuestUser(): void
    {
        $response = $this->get(route('task_statuses.create'))->assertStatus(403);
    }

    /**
     * A 'task_statuses.store' test.
     */
    public function testTaskStatusesStoreActionCanSaveNewTaskStatusToDatabase(): void
    {
        $response = $this->actingAs($this->user)
            ->post(route('task_statuses.store'), ['name' => $this->taskStatus->name]);
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('task_statuses', ['name' => $this->taskStatus->name]);
        // $this->assertModelExists($this->taskStatus);
        $response->assertRedirect(route('task_statuses.index'));
        $this->get(route('task_statuses.index'))->assertSee($this->taskStatus->name);
    }

    /**
     * A 'task_statuses.edit' page accessibility test.
     */
    public function testTaskStatusesEditScreenCanBeRenderedForAuthenticatedUser(): void
    {
        $this->taskStatus->save();
        $response = $this->actingAs($this->user)
            ->get(route('task_statuses.edit', ['task_status' => $this->taskStatus]));
        $response->assertStatus(200);
        $response->assertSee(__('Изменение статуса'));
    }

    public function testTaskStatusesEditScreenCanNotBeRenderedForGuestUser(): void
    {
        $this->taskStatus->save();
        $response = $this->get(route('task_statuses.edit', ['task_status' => $this->taskStatus]))->assertStatus(403);
    }

    /**
     * A 'task_statuses.update' test.
     */
    public function testTaskStatusesUpdateActionCanPatchExistingTaskStatusInDatabase(): void
    {
        $this->taskStatus->save();
        $newName = TaskStatus::factory()->make()->name;
        $response = $this->actingAs($this->user)
            ->patch(route('task_statuses.update', ['task_status' => $this->taskStatus]), ['name' => $newName]);
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('task_statuses', ['name' => $newName]);
        $response->assertRedirect(route('task_statuses.index'));
        $this->get(route('task_statuses.index'))->assertSee($newName);
    }

    /**
     * A 'task_statuses.destroy' test.
     */
    public function testTaskStatusesDestroyActionCanDeleteExistingTaskStatusInDatabase(): void
    {
        $this->taskStatus->save();
        $response = $this->actingAs($this->user)
            ->delete(route('task_statuses.destroy', ['task_status' => $this->taskStatus]));
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseMissing('task_statuses', ['id' => $this->taskStatus->id]);
        $response->assertRedirect(route('task_statuses.index'));
        $this->get(route('task_statuses.index'))->assertDontSee($this->taskStatus->name);
    }
}
