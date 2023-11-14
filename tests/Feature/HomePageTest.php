<?php

namespace Tests\Feature;

use Tests\TestCase;

class HomePageTest extends TestCase
{
    /**
     * A 'Home' Page accessibility test.
     */
    public function testHomeScreenCanBeRendered(): void
    {
        $response = $this->get(route('home'))->assertStatus(200);
        $response = $this->get(route('home'))->assertSee(__('Менеджер задач'));
    }
}
