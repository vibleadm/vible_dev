<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use kanazaca\CounterCache\CounterCache;
use App\Question;

class Like extends Model
{
    use CounterCache;

    public $counterCacheOptions = [
        //下記のfunctionから参照
        'Question' => [
            //このフィールドがカウントの対象となる（数値であることが条件）
            'field' => 'likes_count',
            //'foreignKey' => 'post_id'
            'foreignKey' => 'qid'
        ]
    ];

    //protected $fillable = ['user_id', 'post_id'];
    protected $fillable = ['user_id', 'qid'];
    

    public function Question()
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
