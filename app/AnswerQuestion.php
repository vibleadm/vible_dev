<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\AnswerQuestionLike;

class AnswerQuestion extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function answer_question_likes()
    {
        return $this->hasMany(AnswerQuestionLike::class);
    }
}
