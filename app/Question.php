<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use App\Like;

class Question extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'qid';


    public function likes()
    {
      //belongsToの第２引数が大事！！
      //return $this->belongsTo('App\Like','qid','qid');
      return $this->hasMany('App\Like','qid');
    }
    
    
    public function like_by()
    {
      return Like::where('user_id', Auth::user()->id)->first();
    }


}
