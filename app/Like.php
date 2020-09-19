<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use kanazaca\CounterCache\CounterCache;
use App\Question;

class Like extends Model
{
    use CounterCache;

    public $counterCacheOptions = [
        'Post' => [
            'field' => 'likes_count',
            //'foreignKey' => 'post_id'
            'foreignKey' => 'qid'
        ]
    ];

    //protected $fillable = ['user_id', 'post_id'];
    protected $fillable = ['user_id', 'qid'];
    
    public function Post()
    {
      //ここの第二引数加えた！！
      //return $this->belongsTo('App\Post');
      return $this->belongsTo('App\Question','qid');
    }
    
    public function User()
    {
      return $this->belongsTo(User::class);
    }
    

}