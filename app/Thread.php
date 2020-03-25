<?php

namespace App;

use App\Providers\ThreadHasNewReply;
use App\Providers\ThreadReceivedNewReply;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Laravel\Scout\Searchable;

class Thread extends Model
{
    use RecordsActivity;
    use Searchable;

    protected $guarded = [];
    protected $with = ['owner', 'channel'];
    protected $appends = ['isSubscribedTo'];

    protected $casts = [
        'locked' => 'boolean'
    ];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($thread) {
            $thread->replies->each->delete();

            Reputation::reduce($thread->owner, Reputation::THREAD_WAS_PUBLISHED);
        });

        static::created(function ($thread) {
            $thread->update(['slug' => $thread->title]);

            Reputation::award($thread->owner, Reputation::THREAD_WAS_PUBLISHED);
        });
    }

        public function path()
        {
            return "/threads/{$this->channel->slug}/{$this->slug}";
        }

        public function replies()
        {
            return $this->hasMany(Reply::class);
        }

        public function getReplyCountAttribute()
        {
           return $this->replies()->count();
        }

        public function owner()
        {
            return $this->belongsTo(User::class, 'user_id');
        }

        public function addReply($reply)
        {
            $reply = $this->replies()->create($reply);

            event(new ThreadReceivedNewReply($reply));


            return $reply;
        }

        public function channel()
        {
            return $this->belongsTo(Channel::class);
        }

        public function scopeFilter($query, $filters)
        {
            return $filters->apply($query);
        }


        public function subscribe($userId = null)
        {
            $this->subscriptions()->create([
                'user_id' => $userId ?: auth()->id(),
            ]);

            return $this;
        }

        public function unsubscribe($userId = null)
        {
            $this->subscriptions()
                 ->where('user_id', $userId ?: auth()->id())
                 ->delete();
        }

        public function subscriptions()
        {
            return $this->hasMany(ThreadSubscription::class);
        }

        public function getIsSubscribedToAttribute()
        {
            return $this->subscriptions()
                        ->where('user_id', auth()->id())
                        ->exists();
        }

        public function hasUpdatesFor($user)
        {
            $key =  $user->visitedThreadCacheKey($this);

            return $this->updated_at > cache($key);

        }

        public function getRouteKeyName()
        {
            return 'slug';
        }

        public function setSlugAttribute($value)
        {
            $slug = Str::slug($value);

            if (static::whereSlug($slug)->exists()) {
                $slug = "{$slug}-" . $this->id;
            }

            $this->attributes['slug'] = $slug;
        }

        public function toSearchableArray()
        {
            return $this->toArray() + ['path' => $this->path()];
        }

        public function getBodyAttribute($body)
        {
            return \Purify::clean($body);
        }
}
