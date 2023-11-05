<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Label;

class LabelTest extends TestCase
{
    use RefreshDatabase;

    private User $user;
    private Label $label;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->label = Label::factory()->make();
    }

    /**
     * A 'labels.index' Page accessibility test.
     */
    public function test_labels_index_screen_can_be_rendered(): void
    {
        $response = $this->get(route('labels.index'));
        $response->assertStatus(200);
        $response->assertSee('Метки');
    }

    /**
     * A 'labels.create' page accessibility test.
     */
    public function test_labels_create_screen_can_be_rendered_for_authenticated_user(): void
    {
        $response = $this->actingAs($this->user)->get(route('labels.create'));
        $response->assertStatus(200);
        $response->assertSee('Создать метку');
    }

    public function test_labels_create_screen_can_not_be_rendered_for_guest_user(): void
    {
        $response = $this->get(route('labels.create'))->assertStatus(403);
    }

    /**
     * A 'labels.store' test.
     */
    public function test_labels_store_action_can_save_new_label_to_database(): void
    {
        $response = $this->actingAs($this->user)
            ->post(route('labels.store'), ['name' => $this->label->name, 'description' => $this->label->description]);
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('labels', ['name' => $this->label->name, 'description' => $this->label->description]);
        $response->assertRedirect(route('labels.index'));
        $this->get(route('labels.index'))->assertSee($this->label->name);
    }

    /**
     * A 'labels.edit' page accessibility test.
     */
    public function test_labels_edit_screen_can_be_rendered_for_authenticated_user(): void
    {
        $this->label->save();
        $response = $this->actingAs($this->user)->get(route('labels.edit', ['label' => $this->label]));
        $response->assertStatus(200);
        $response->assertSee('Изменение метки');
    }

    public function test_labels_edit_screen_can_not_be_rendered_for_guest_user(): void
    {
        $this->label->save();
        $response = $this->get(route('labels.edit', ['label' => $this->label]))->assertStatus(403);
    }

    /**
     * A 'labels.update' test.
     */
    public function test_labels_update_action_can_patch_existing_label_in_database(): void
    {
        $this->label->save();
        $newLabelData = Label::factory()->make()->only(['name', 'description']);
        $response = $this->actingAs($this->user)
            ->patch(route('labels.update', ['label' => $this->label]), $newLabelData);
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('labels', $newLabelData);
        $response->assertRedirect(route('labels.index'));
        $this->get(route('labels.index'))->assertSee($newLabelData['name']);
    }

    /**
     * A 'labels.destroy' test.
     */
    public function test_labels_destroy_action_can_delete_existing_label_in_database(): void
    {
        $this->label->save();
        $response = $this->actingAs($this->user)
            ->delete(route('labels.destroy', ['label' => $this->label]));
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseMissing('labels', ['id' => $this->label->id]);
        $response->assertRedirect(route('labels.index'));
        $this->get(route('labels.index'))->assertDontSee($this->label->name);
    }
}
