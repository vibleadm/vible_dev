<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use App\TweetLike;

class Tweet extends Model
{
    public $timestamps = false;
    //tweetsテーブルの主キーをtweetIDに指定
    protected $primaryKey = 'tweetID';


    public function likes()
    {
      //belongsToの第２引数が大事！！
      //return $this->belongsTo('App\Like','qid','qid');
      return $this->hasMany('App\TweetLike','tweet_id');
    }
    
    
    public function like_by()
    {
      return TweetLike::where('user_id', Auth::user()->id)->first();
    }
}

