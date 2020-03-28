<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class BestReplyTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_thread_owner_can_mark_a_reply_as_the_best_reply()
    {
        $this->signIn();

        $thread = create('App\Thread', [
            'user_id' => auth()->id(),
        ]);

        $replies = create('App\Reply', [
            'thread_id' =>  $thread->id,
            'user_id'   =>  auth()->id(),
        ], 2);

        $this->assertFalse($replies[1]->isBest());

        $this->assertFalse($replies[0]->isBest());

//       dd(json_encode($replies[1]->id));

        $this->postJson(route('best-replies.store', $replies[1]->id));

        $this->assertTrue($replies[1]->fresh()->isBest());
    }

    /** @test */
    public function only_the_owner_of_the_thread_can_mark_a_reply_as_best()
    {
        $this->signIn();

        $thread = create('App\Thread', ['user_id' => auth()->id()]);

        $replies = create('App\Reply', ['thread_id' => $thread->id], 2);

        $this->signIn(create('App\User'));

        $this->postJson(route('best-replies.store', [$replies[1]->id]))->assertStatus(403);

        $this->assertFalse($replies[1]->fresh()->isBest());
    }
}
