<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\AnswerTweetLike;

class AnswerTweet extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function answer_tweet_likes()
    {
        return $this->hasMany(AnswerTweetLike::class);
    }
}
