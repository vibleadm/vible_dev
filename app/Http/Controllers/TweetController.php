<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Question;
use App\Tweet;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TweetController extends Controller
{
    public function mypage(Request $request)
    {
        $id = Auth::id();
        $items = DB::table('users')->where('id',$id)->first();

        $user = $items->name;
        //$posts = DB::table('tweets')->where('userID',$user)->get();
        $posts = Tweet::where('userID',$user)->get();

        foreach($posts as $post2){
            $like2 = $post2->likes()->where('user_id', Auth::user()->id)->first();
            if($like2 == null){
                //likeまだしていなかったら０を追加
                $like2 = 0;
                $post2->liked =$like2;
            }
            else{
                //すでにlikeしていれば１を追加
                //$like2 = 1;
                $post2->liked =$like2;
            }

            

        }

        return view('test.mypage')->with([
            "user"=>$items,
            "items2" => $posts,
            'myname' => $user,
            'access' => $request->id,
        ]);

    }
}

?>
