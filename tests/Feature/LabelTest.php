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
    public function testLabelsIndexScreenCanBeRendered(): void
    {
        $response = $this->get(route('labels.index'));
        $response->assertStatus(200);
        $response->assertSee(__('Метки'));
    }

    /**
     * A 'labels.create' page accessibility test.
     */
    public function testLabelsCreateScreenCanBeRenderedForAuthenticatedUser(): void
    {
        $response = $this->actingAs($this->user)->get(route('labels.create'));
        $response->assertStatus(200);
        $response->assertSee(__('Создать метку'));
    }

    public function testLabelsCreateScreenCanNotBeRenderedForGuestUser(): void
    {
        $this->get(route('labels.create'))->assertStatus(403);
    }

    /**
     * A 'labels.store' test.
     */
    public function testLabelsStoreActionCanSaveNewLabelToDatabase(): void
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
    public function testLabelsEditScreenCanBeRenderedForAuthenticatedUser(): void
    {
        $this->label->save();
        $response = $this->actingAs($this->user)->get(route('labels.edit', ['label' => $this->label]));
        $response->assertStatus(200);
        $response->assertSee(__('Изменение метки'));
    }

    public function testLabelsEditScreenCanNotBeRenderedForGuestUser(): void
    {
        $this->label->save();
        $this->get(route('labels.edit', ['label' => $this->label]))->assertStatus(403);
    }

    /**
     * A 'labels.update' test.
     */
    public function testLabelsUpdateActionCanPatchExistingLabelInDatabase(): void
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
    public function testLabelsDestroyActionCanDeleteExistingLabelInDatabase(): void
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
