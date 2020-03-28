<?php

namespace Tests\Unit;

use App\Notifications\ThreadWasUpdated;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

/**
 * @property  thread
 */
class ThreadTest extends TestCase
{
    use DatabaseMigrations;

    protected $thread;

    public function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->thread = factory('App\Thread')->create();

//        http::fake([
//            'jsonplaceholder.*' => http::response([
//                'userId' => 123
//            ])
////            'https://jsonplaceholder.typicode.com/post/*' => http::fakeSequence()
////                ->push(
////                 [
////                   'userId' =>  12
////                 ]
////                )->push(
////                 [
////                    'userId' =>  222
////                 ]
////                )
//        ]);
    }

    /** @test */
    public function a_thread_has_a_path()
    {
        $thread = create('App\Thread');

        $this->assertEquals("/threads/{$thread->channel->slug}/{$thread->slug}", $thread->path());
    }

    /** @test */
    public function a_thread_has_a_creator()
    {
        $this->assertInstanceOf('App\User', $this->thread->owner);
    }

    /** @test */
    public function a_thread_has_replies()
    {
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->thread->replies);
    }

    /** @test */
    public function a_thread_can_add_a_reply()
    {
        $this->thread->addReply([
            'body' => 'foo',
            'user_id' => 1,
        ]);

        $this->assertCount(1, $this->thread->replies);
    }

    /** @test */
    public function a_thread_notifies_all_registered_subscribers_when_a_reply_is_added()
    {
        Notification::fake();

//        dd($this->signIn()->thread->subscribe());

        $this
            ->signIn()
            ->thread
            ->subscribe()
            ->addReply([
                'body' => 'foo',
                'user_id' => create(\App\User::class)->id,
            ]);

        Notification::assertSentTo(auth()->user(), ThreadWasUpdated::class);
    }

    /** @test */
    public function a_thread_belongs_to_a_channel()
    {
        $thread = create('App\Thread');

        $this->assertInstanceOf('App\Channel', $thread->channel);
    }

    /** @test */
    public function a_thread_can_be_subscribed_to()
    {
        $thread = create('App\Thread');

        $thread->subscribe($userId = 1);

        $this->assertEquals(

        1,

        $thread->subscriptions()->where('user_id', $userId)->count()
      );
    }

    /** @test */
    public function a_thread_can_be_unsubscribed_from()
    {
        $thread = create('App\Thread');

        $thread->subscribe($userId = 1);

        $thread->unsubscribe($userId);

        $this->assertCount(0, $thread->subscriptions);
    }

    /** @test */
    public function it_knows_if_the_authenticated_user_is_subscribed_to_it()
    {
        $thread = create('App\Thread');

        $this->signIn();

        $this->assertFalse($thread->isSubscribedTo);

        $thread->subscribe();

        $this->assertTrue($thread->isSubscribedTo);
    }

    /** @test */
    public function a_thread_can_check_if_the_authenticated_user_has_read_all_replies()
    {
        $this->signIn();

        $thread = create('App\Thread');

        tap(auth()->user(), fn ($user) => [
            $this->assertTrue($thread->hasUpdatesFor($user)),

            $user->read($thread),

            $this->assertFalse($thread->hasUpdatesFor($user)),
        ]

        );
    }

    /** @test */
    public function if_a_best_reply_is_deleted_then_the_thread_is_properly_updated_to_reflect_that()
    {
        $this->signIn();

        $reply = create('App\Reply', ['user_id' => auth()->id()]);

        $reply->setBestReply();

        $this->deleteJson(route('replies.destroy', $reply));

        $this->assertNull($reply->thread->fresh()->best_reply_id);
    }

    /** @test */
    public function a_thread_body_is_sanitized_automatically()
    {
        $thread = make('App\Thread', ['body' => '<script>alert("BAD")</script><p>This is okay.</p>']);

        $this->assertEquals('<p>This is okay.</p>', $thread->body);
    }

//
//    /** @test */
//    function uselessTest()
//    {
//        $response = http::post('https://jsonplaceholder.typicode.com/posts', [
//
//            'userId' => 322
//
//        ]);
//
//        http::assertSent(function ($request) {
//             return $request->url() == 'https://jsonplaceholder.typicode.com/posts';
//        });
//
//    }

    /** @test */
    public function a_reply_body_is_sanitized_automatically()
    {
        $reply = make('App\Reply', ['body' => '<script>alert("BAD")</script><p>This is okay.</p>']);

        $this->assertEquals('<p>This is okay.</p>', $reply->body);
    }
}
