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
    public function test__task_statuses_index_screen_can_be_rendered(): void
    {
        $response = $this->get(route('task_statuses.index'));
        $response->assertStatus(200);
        $response->assertSee('Статусы');
    }

    /**
     * A 'task_statuses.create' page accessibility test.
     */
    public function test_task_statuses_create_screen_can_be_rendered_for_authenticated_user(): void
    {
        $response = $this->actingAs($this->user)->get(route('task_statuses.create'));
        $response->assertStatus(200);
        $response->assertSee('Создать статус');
    }

    public function test_task_statuses_create_screen_can_not_be_rendered_for_guest_user(): void
    {
        $response = $this->get(route('task_statuses.create'))->assertStatus(403);
    }

    /**
     * A 'task_statuses.store' test.
     */
    public function test_task_statuses_store_action_can_save_new_task_status_to_database(): void
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
    public function test_task_statuses_edit_screen_can_be_rendered_for_authenticated_user(): void
    {
        $this->taskStatus->save();
        $response = $this->actingAs($this->user)->get(route('task_statuses.edit', ['task_status' => $this->taskStatus]));
        $response->assertStatus(200);
        $response->assertSee('Изменение статуса');
    }

    public function test_task_statuses_edit_screen_can_not_be_rendered_for_guest_user(): void
    {
        $this->taskStatus->save();
        $response = $this->get(route('task_statuses.edit', ['task_status' => $this->taskStatus]))->assertStatus(403);
    }

    /**
     * A 'task_statuses.update' test.
     */
    public function test_task_statuses_update_action_can_patch_existing_task_status_in_database(): void
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
    public function test_task_statuses_destroy_action_can_delete_existing_task_status_in_database(): void
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
