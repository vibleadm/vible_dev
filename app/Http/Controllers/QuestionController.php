<?php

namespace App\Http\Controllers;

use App\Question;
use App\QuestionLike;
use App\User;
use App\AnswerQuestion;
use App\AnswerQuestionLike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    public function index()
    {
        $data = [];
        //$questions = Question::all();
        $likes = QuestionLike::all();
        //いいね数まで含めた変数　question_likes_count
        $questions = Question::withCount('question_likes')->orderBy('created_at', 'desc')->paginate(10);
        
        //こいつがやりたいことだった。。。
        $users = Question::with('user:id,name')->get();
        
        $data = [
            'questions' => $questions,
            'likes'=>$likes,
            'users' => $users,
        ];

        
        return view('test.nayami',$data);
    }



    public function ajaxlike(Request $request)
    {
        //var_dump('うんこ');
        $id = Auth::user()->id;
        $question_id = $request->question_id;
        //var_dump($question_id);
        
        $like = QuestionLike::where('question_id', $question_id)->where('user_id', $id)->first();
        $question = Question::findOrFail($question_id);

        if ($like) {
            //likesテーブルのレコードを削除
            $like = QuestionLike::where('question_id', $question_id)->where('user_id', $id)->delete();
        } else {
            QuestionLike::create(['user_id' => $id, 'question_id' => $question_id]);
        }

        $questionLikesCount = $question->loadCount('question_likes')->question_likes_count;
        //これがajaxのdataとして渡される
        print($questionLikesCount);    
    }

    public function nayami_add(Request $request)
    {
        return view('test.add');
    }

    public function nayami_create(Request $request)
    {
        $id = Auth::id();
        //$items = DB::table('users')->where('id',$id)->first();
        $param = [
            'title' => $request->title,
            'user_id' => $id,
            'content' => $request->main,
            //いいね数初期化設定する
            //'likes_count' => 0,
        ];
        DB::table('Questions') ->insert($param);
        return redirect('/test');
    }

    public function detail($id) {
        $posts = DB::table('questions')->get();
        $answer_questions = AnswerQuestion::withCount('answer_question_likes')->orderBy('created_at', 'desc')->where('question_id',$id)->paginate(10);
        $answers = DB::table('answer_questions')->where('question_id',$id)->get();
        
        //名前表示用
        $users = AnswerQuestion::with('user:id,name')->where('question_id',$id)->get();
        
        $question = Question::findorFail($id); 
        $likes = AnswerQuestionLike::all();
        return view('test.nayami_detail')->with(array('answer_questions'=>$answer_questions,'answers'=>$answers,'question' => $question, 'likes'=>$likes, 'users'=>$users));
    }

    public function nayami_answer(Request $request)
    {
        $id = Auth::id();
        $items = DB::table('users')->where('id',$id)->first();
        var_dump($request->question_id);
        var_dump($request->content);
        
        $param = [
            'question_id' => $request->question_id,
            'user_id' => $id,
            'content' => $request->content
        ];
        DB::insert('insert into answer_questions (question_id, user_id, content) values (:question_id,:user_id,:content)', $param);
        //return redirect('/test');
        return back();
    }

    public function answer_question_like(Request $request)
    {
        //var_dump('うんこ');
        //var_dump($request->answer_question_id);

        
        $id = Auth::user()->id;
        $answer_question_id = $request->answer_question_id;
        //var_dump($question_id);
        
        $like = AnswerQuestionLike::where('answer_question_id', $answer_question_id)->where('user_id', $id)->first();
        $answer_question = AnswerQuestion::findOrFail($answer_question_id);

        if ($like) {
            //likesテーブルのレコードを削除
            $like = AnswerQuestionLike::where('answer_question_id', $answer_question_id)->where('user_id', $id)->delete();
        } else {
            AnswerQuestionLike::create(['user_id' => $id, 'answer_question_id' => $answer_question_id]);
        }

        $answerquestionLikesCount = $answer_question->loadCount('answer_question_likes')->answer_question_likes_count;
        //これがajaxのdataとして渡される
        print($answerquestionLikesCount);  
        
    }


    
}
