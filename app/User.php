<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\QuestionLike;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];



    //User.phpに下記を追記
    // ユーザーの投稿
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    // ユーザーがいいねしている投稿
    public function likes()
    {
        return $this->hasMany(Like::class);
    }




    public function questions()
    {
        return $this->hasMany(Question::class);
    }
    public function questionlikes()
    {
        return $this->hasMany(QuestionLike::class);
    }




    
    public function answerquestions()
    {
        return $this->hasMany(AnswerQuestion::class);
    }

    // ユーザーがいいねしている投稿
    public function answerquestionlikes()
    {
        return $this->hasMany(AnswerQuestionLike::class);
    }
}
