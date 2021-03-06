<?php

namespace App;

trait Favoritable
{
    protected static function bootFavoritable()
    {
        static::deleting(function ($model) {
            $model->favorites->each->delete();
        });
    }

    public function isFavorited()
    {
        return (bool) $this->favorites->where('user_id', auth()->id())->count();
    }

    public function getFavoritesCountAttribute()
    {
        return $this->favorites->count();
    }

    public function favorites()
    {
        return $this->morphMany(Favorite::class, 'favorited');
    }

    public function favorite($UserId)
    {
        $attributes = ['user_id' => $UserId];
        if (! $this->favorites()->where($attributes)->exists()) {
            Reputation::award(auth()->user(), Reputation::REPLY_FAVORITED);

            return $this->favorites()->create($attributes);
        }
    }

    public function unfavorite($UserId)
    {
        $attributes = ['user_id' => $UserId];

        Reputation::reduce(auth()->user(), Reputation::REPLY_FAVORITED);

        $this->favorites()->where($attributes)->get()->each->delete();
    }

    public function getIsFavoritedAttribute()
    {
        return $this->isFavorited();
    }
}
