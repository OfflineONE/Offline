<?php

namespace Tests\Feature;

use App\Activity;
use App\Reply;
use App\Thread;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ActivityTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function it_records_activity_when_a_thread_is_created()
    {
        $this->signIn();

        $thread = create('App\Thread');

        $this->assertDatabaseHas('activities',
       [
           'type' => 'created_thread',
           'user_id' => auth()->id(),
           'subject_id' => $thread->id,
           'subject_type' => 'App\Thread',
       ]);

        $activity = Activity::first();

        $this->assertEquals($activity->subject->id, $thread->id);
    }

    /** @test */
    public function it_records_activity_when_a_reply_is_created()
    {
        $this->signIn();

        $reply = create(Reply::class);

        $this->assertEquals(2, Activity::count());
    }

    /** @test */
    public function it_fetches_a_feed_for_any_user()
    {
        $this->signIn();

        create(Thread::class, ['user_id' => auth()->id()], 4);

        auth()->user()->activity()->find(1)->update(['created_at' => Carbon::now()->subWeek()]);
        auth()->user()->activity()->find(2)->update(['created_at' => Carbon::now()->subWeek()]);

        $feed = Activity::feed(auth()->user(), 50);

//         dd($feed);

        $this->assertTrue($feed->keys()->contains(
            Carbon::now()->format('Y-m-d')
         ));

        $this->assertTrue($feed->keys()->contains(
             Carbon::now()->format('Y-m-d')
         ));
    }
}
