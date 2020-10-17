<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\TweetLike;

class Tweet extends Model
{
  public function user()
  {
      return $this->belongsTo(User::class);
  }

  public function tweet_likes()
  {
      return $this->hasMany(TweetLike::class);
  }
}
