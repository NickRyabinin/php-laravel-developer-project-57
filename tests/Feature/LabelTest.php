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
}
