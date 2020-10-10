<?php

namespace App\Http\Controllers;

use App\Question;
use App\QuestionLike;
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
        
        $id = Auth::id();
        
        $data = [
            'questions' => $questions,
            'likes'=>$likes,
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
        //$post = DB::table('posts')->get();
        $post3 = DB::table('posts')->where('id',$id)->get(); // findOrFail 見つからなかった時の例外処理
        $answers = DB::table('ans_Question')->where('questionID',$id)->get();
        //$post = Post::findorFail($id); 
        $post = Question::findorFail($id); 
        //$like = $post->likes()->where('user_id', Auth::user()->id)->first();
        //$like = $post->where('user_id', Auth::user()->id)->first();
        //$like = $id;
        return view('test.nayami_detail')->with(array('post3'=>$post3,'answers'=>$answers,'post' => $post, 'items'=>$posts));
    }
}
