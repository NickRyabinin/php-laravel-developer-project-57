<?php

namespace Tests\Feature;

use Tests\TestCase;

class HomePageTest extends TestCase
{
    /**
     * A 'Home' Page accessibility test.
     */
    public function test_home_screen_can_be_rendered(): void
    {
        $response = $this->get(route('home'))->assertStatus(200);
        $response = $this->get(route('home'))->assertSee('Менеджер задач');
    }
}
