<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    public function index(Request $request)
    {
        $posts = DB::table('Question')->get();
        return view('test.nayami', ['items' => $posts]);
    }

    public function show($id) {
        $post = DB::table('Question')->where('questionID',$id)->first();
        $post2 = DB::table('ans_Question')->where('questionID',$id)->get();
        return view('test.nayami_detail')->with([
            "item" => $post,
            "items2" => $post2,
        ]);
    }

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






}
