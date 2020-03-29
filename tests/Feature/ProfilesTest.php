<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ProfilesTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_user_has_a_profile()
    {
        $user = create('App\User');

        $this->get("/profiles/{$user->name}")
             ->assertStatus(200);
    }

    /** @test */
    public function profiles_display_all_threads_created_by_the_associated_user()
    {
        $this->signIn($user = create('App\User'));

        $thread = create('App\Thread', ['user_id' => create('App\User')->id]);

        $this->get("/profiles/{$user->name}")
             ->assertSee($thread->title)
             ->assertSee($thread->body);
    }
}
