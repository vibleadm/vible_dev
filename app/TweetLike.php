<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use kanazaca\CounterCache\CounterCache;
use App\Tweet;

class TweetLike extends Model
{
    use CounterCache;
    public $counterCacheOptions = [
        //下記のfunctionから参照
        'Tweet' => [
            //このフィールドがカウントの対象となる（数値であることが条件）
            'field' => 'likes_count',
            //'foreignKey' => 'post_id'
            'foreignKey' => 'tweetID'
        ]
    ];

    //protected $fillable = ['user_id', 'post_id'];
    protected $fillable = ['user_id', 'tweet_id'];
    

    public function Tweet()
    {
      //ここの第二引数加えた！！
      //return $this->belongsTo('App\Post');
      return $this->belongsTo('App\Tweet','tweet_id');
    }
    
    public function User()
    {
      return $this->belongsTo(User::class);
    }
}

