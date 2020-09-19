<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Question;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    public function index(Request $request)
    {
        //$posts = DB::table('Questions')->get();
        //こいつはオブジェクト
        $posts = Question::all();
        

        //$posts2 = Question::get('qid');

        //$like = array();
        //$like = $posts[1]->likes()->where('user_id', Auth::user()->id)->first();
        //var_dump($like);
        
        foreach($posts as $post2){
            //こいつもオブジェクト
            
            $like = $post2->likes()->where('user_id', Auth::user()->id)->first();
            $post2 ->append($like);
            //var_dump($like);
            echo "\n";
            //$like  = array_merge($like,$like2);
        }
        var_dump($post2);
        
        

        //$post = Question::findorFail($post2); 
        //$like = $like + $post->likes()->where('user_id', Auth::user()->id)->first();

        return view('test.nayami')->with(array('items'=>$posts,'post'=>$like,'like' => $like));
        //return view('test.nayami', ['items' => $posts]);
    }
/*
    public function show($id) {
        $post = DB::table('Question')->where('questionID',$id)->first();
        $post2 = DB::table('ans_Question')->where('questionID',$id)->get();
        return view('test.nayami_detail')->with([
            "item" => $post,
            "items2" => $post2,
        ]);
    }
*/
    public function tw_show($id) {
        $post = DB::table('tweet')->where('tweetID',$id)->first();
        $post2 = DB::table('ans_tweet')->where('tweetID',$id)->get();
        return view('test.tw_detail')->with([
            "item" => $post,
            "items2" => $post2,
        ]);
    }

    public function tw_comment(Request $request)
    {
        $id = Auth::id();
        $items = DB::table('users')->where('id',$id)->first();
        
        $param = [
            'tweetID' => $request->tweetID,
            'userID' => $items->name,
            'main' => $request->main
        ];
        DB::insert('insert into ans_tweet (tweetID,userID,main) values (:tweetID,:userID,:main)', $param);
        return redirect('/test');
    }


    public function mypage(Request $request)
    {
        $id = Auth::id();
        $items = DB::table('users')->where('id',$id)->first();

        $user = $items->name;
        $posts = DB::table('tweet')->where('userID',$user)->get();
        return view('test.mypage')->with([
            "user"=>$items,
            "items2" => $posts,
            'myname' => $user,
            'access' => $request->id,
        ]);

    }

    
/*
    public function create(Request $request)
    {
        $id = Auth::id();
        $items = DB::table('users')->where('id',$id)->first();
        
        $param = [
            'userID' => $items->name,
            'main' => $request->main
        ];
        DB::insert('insert into tweet (userID,main) values (:userID,:main)', $param);
        return redirect('/test/mypage');
    }
*/

    
    public function tw_create(Request $request)
    {
        $id = Auth::id();
        $items = DB::table('users')->where('id',$id)->first();
        
        $param = [
            'userID' => $items->name,
            'main' => $request->main
        ];
        DB::insert('insert into tweet (userID,main) values (:userID,:main)', $param);
        return redirect('/test/mypage');
    }



    public function create(Request $request)
    {
        $id = Auth::id();
        $items = DB::table('users')->where('id',$id)->first();

        $user = $items->name;
        $posts = DB::table('tweet')->where('userID',$request->id)->get();
        return view('test.mypage')->with([
            "user"=>$items,
            "items2" => $posts,
            'myname' => $user,
            'access' => $request->id,
        ]);

    }


    
    public function nayami_answer(Request $request)
    {
        $id = Auth::id();
        $items = DB::table('users')->where('id',$id)->first();
        
        $param = [
            'questionID' => $request->questionID,
            'userID' => $items->name,
            'main' => $request->main
        ];
        DB::insert('insert into ans_Question (questionID,userID,main) values (:questionID,:userID,:main)', $param);
        return redirect('/test');
    }

    public function nayami_add(Request $request)
    {
        return view('test.add');
    }

    public function nayami_create(Request $request)
    {
        $id = Auth::id();
        $items = DB::table('users')->where('id',$id)->first();
        $param = [
            'title' => $request->title,
            'userID' => $items->name,
            'main' => $request->main,
        ];
        DB::table('Question') ->insert($param);
        return redirect('/test');
    }



    public function __construct()
    {
      $this->middleware('auth', array('except' => 'index'));
    }

    public function show2($id) {
        $posts = DB::table('questions')->get();
        //$post = DB::table('posts')->get();
        $post3 = DB::table('posts')->where('id',$id)->get(); // findOrFail 見つからなかった時の例外処理
        $post4 = Question::all();
        //$post = Post::findorFail($id); 
        $post = Question::findorFail($id); 
        $like = $post->likes()->where('user_id', Auth::user()->id)->first();
        //$like = $post->where('user_id', Auth::user()->id)->first();
        //$like = $id;
        return view('test.nayami')->with(array('post3'=>$post3,'post4'=>$post4,'post' => $post, 'like' => $like, 'items'=>$posts));
    }

    public function show3($id) {
        $post = Post::findOrFail($id); // findOrFail 見つからなかった時の例外処理
  
        $like = $post->likes()->where('user_id', Auth::user()->id)->first();
        
        //$like = $post->where('user_id', Auth::user()->id)->first();
        return view('posts.show')->with(array('post' => $post, 'like' => $like));
      }






}
