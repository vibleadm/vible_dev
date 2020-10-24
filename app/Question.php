<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use App\QuestionLike;

class Question extends Model
{
    //Post.phpに下記を追記
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function question_likes()
    {
        return $this->hasMany(QuestionLike::class);
    }

}