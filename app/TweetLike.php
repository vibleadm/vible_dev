<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Tweet;

class TweetLike extends Model
{
    protected $fillable = ['user_id', 'tweet_id'];
    //Like.phpに下記を追記
     //いいねしているユーザー
     public function user()
    {
        return $this->belongsTo(User::class);
    }

     //いいねしている投稿
    public function post()
    {
        return $this->belongsTo(Tweet::class);
    }
}
