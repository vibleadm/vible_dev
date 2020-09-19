<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use App\Like;

class Post extends Model
{
    public $timestamps = false;
    
    protected $fillable = ['title', 'body', 'summary', 'user_id'];
    
    public function comments() {
      return $this->hasMany('App\Comment');
    }
    

    public function user()
    {
      return $this->belongsTo(User::class);
    }
    
    
    public function likes()
    {
      return $this->hasMany('App\Like','qid');
    }
    
    
    public function like_by()
    {
      return Like::where('user_id', Auth::user()->id)->first();
    }
    
}
