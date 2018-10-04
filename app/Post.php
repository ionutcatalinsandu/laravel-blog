<?php

namespace App;

use Carbon\Carbon;

class Post extends Model
{
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function scopeFilter($query, $filters)
    {
        if (empty($filters)) {
            return;
        }

        if ($month = $filters['month']) {
            $query->whereMonth('created_at', Carbon::parse($month)->month);
        }

        if ($year = $filters['year']) {
            $query->whereYear('created_at', $year);
        }
    }

    public static function archives()
    {
        return static::selectRaw('YEAR(created_at) year, MONTHNAME(created_at) month, count(*) published')

        ->groupBy('year', 'month')

        ->orderByRaw('min(created_at) asc')

        ->get()

        ->toArray();
    }

    public function addComment($body)
    {
        $uid = (auth()->check() ? auth()->id() : 0);

        Comment::create([
            'body' => $body,

            'post_id' => $this->id,

            'user_id' => $uid,
        ]);
    }
}
