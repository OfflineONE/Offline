<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class HomeTest extends TestCase {

    /** @test */
    public function a_user_can_reach_the_home_screen()
    {
       $this->get('/')->assertStatus(302);
    }
}
