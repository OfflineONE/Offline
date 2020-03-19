<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MentionUsersTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function mentioned_users_in_a_reply_are_notified()
    {
        $this->withoutExceptionHandling();

        $JohnDoe = create('App\User', [
        'name' => 'JohnDoe'
        ]);

        $JaneDoe = create('App\User', [
            'name' => 'JaneDoe'
        ]);

        $this->signIn($JohnDoe);

        $thread = create('App\Thread');

        $reply = make('App\Reply', [
        'body' => 'This a a reply for @JaneDoe. Also @FrankDoe'
        ]);

        $this->postJson($thread->path().'/replies', $reply->toArray());

        $this->assertCount(1, $JaneDoe->notifications);

    }

    /** @test */
    function it_can_detect_all_mentioned_users_in_the_body()
    {
        $reply = new \App\Reply([
            'body' => '@JaneDoe wants to talk to @JohnDoe'
        ]);

        $this->assertEquals(['JaneDoe', 'JohnDoe'], $reply->mentionedUsers());
    }

    /** @test */
    function it_wraps_mentioned_usernames_in_the_body_within_anchor_tags()
    {
        $reply = new \App\Reply([
            'body' => 'Hello @Jane-Doe'
        ]);
        $this->assertEquals(
            'Hello <a href="/profiles/Jane-Doe">@Jane-Doe</a>',
            $reply->body
        );
    }

    /** @test */
    function it_can_fetch_all_mentioned_users_starting_with_the_given_characters()
    {
        create('App\User', ['name' => 'johndoe']);
        create('App\User', ['name' => 'johndoe2']);
        create('App\User', ['name' => 'janedoe']);

        $results = $this->json('GET', '/api/users', ['name' => 'john']);

        $this->assertCount(2, $results->json());
    }
}
