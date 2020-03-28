<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ParticipateInThreadTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function unauthenticated_users_may_not_add_replies()
    {
        // to get exception add to app/exceptions/handler render method the following line
        // if(app()->environment() === 'testing')throw $exception;
        $this->post('threads/some/1/replies', [])
             ->assertRedirect('login');
    }

    /** @test */
    public function an_authenticated_user_can_participate_in_forum_threads()
    {
//        $this->withExceptionHandling();
        $this->signIn();

        $thread = create('App\Thread');
        $reply = make('App\Reply');

        $this->post($thread->path().'/replies', $reply->toArray());

        $this->assertDatabaseHas('replies', ['body' => $reply->body]);
        $this->assertEquals(1, $thread->fresh()->replies_count);
    }

    /** @test */
    public function a_reply_requires_a_body()
    {
        $this->signIn();

        $thread = create('App\Thread');
        $reply = make('App\Thread', ['body' => null]);

//            dd($reply->toArray());
        $this->postJson($thread->path().'/replies', $reply->toArray())
             ->assertStatus(422);
    }

    /** @test */
    public function unauthorized_users_cannot_delete_replies()
    {
        $reply = create('App\Reply');

        $this->delete("/replies/{$reply->id}")
             ->assertRedirect('login');

        $this->signIn();

        $this->delete("/replies/{$reply->id}")
             ->assertStatus(403);
    }

    /** @test */
    public function authorized_users_can_delete_replies()
    {
        $this->signIn();

        $reply = create('App\Reply',
        [
            'user_id' => auth()->id(),
        ]);

        $this->delete("/replies/{$reply->id}")->assertStatus(302);

        $this->assertDatabaseMissing('replies',
        [
            'id' => $reply->id,
        ]);
        $this->assertEquals(0, $reply->thread->fresh()->replies_count);
    }

    /** @test */
    public function authorized_users_ca_update_replies()
    {
//        $this->withoutExceptionHandling();
        $this->signIn();

        $reply = create('App\Reply',
            [
                'user_id' => auth()->id(),
            ]);

        $change = 'You been changed, fool';
        $this->patch("/replies/{$reply->id}", ['body' => $change]);

        $this->assertDatabaseHas('replies',
        [
            'id'   => $reply->id,
            'body' => $change,
        ]
        );
    }

    /** @test */
    public function replies_that_contain_spam_may_not_be_created()
    {
        $this->withExceptionHandling();

        $this->signIn();

        $thread = create('App\Thread');
        $reply = make('App\Reply', [
            'body' => 'Yahoo Customer Support',
        ]);

        $this->postJson($thread->path().'/replies', $reply->toArray())
        ->assertStatus(422);
    }

    /** @test */
    public function unauthorized_users_cannot_update_replies()
    {
        $reply = create('App\Reply');

        $this->patch("/replies/{$reply->id}")
             ->assertRedirect('login');

        $this->signIn();

        $this->patch("/replies/{$reply->id}")
             ->assertStatus(403);
    }

    /** @test */
    public function a_user_can_just_post_one_reply_per_minute()
    {
        $this->signIn();

        $thread = create('App\Thread');

        $reply = make('App\Reply');

        $this->post($thread->path().'/replies', $reply->toArray())
             ->assertStatus(201);

        $this->post($thread->path().'/replies', $reply->toArray())
            ->assertStatus(429);
    }
}
