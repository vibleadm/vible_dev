<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnswerQuestionLike extends Model
{
    protected $fillable = ['user_id', 'answer_question_id'];
    //Like.phpに下記を追記
     //いいねしているユーザー
     public function user()
    {
        return $this->belongsTo(User::class);
    }

     //いいねしている投稿
    public function post()
    {
        return $this->belongsTo(AnswerQuestion::class);
    }
}
