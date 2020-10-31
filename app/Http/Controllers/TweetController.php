<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TweetLike;
use App\AnswerTweetLike;
use App\AnswerTweet;
use App\Tweet;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TweetController extends Controller
{
    public function mypage(Request $request)
    {
        $id = Auth::id();
        $users = DB::table('users')->where('id',$id)->first();

        $myname = $users->name;
        //$posts = DB::table('tweets')->where('userID',$user)->get();
        //$tweets = Tweet::where('user_id',$id)->get();
        $likes = TweetLike::all();
        $tweets = Tweet::withCount('tweet_likes')->orderBy('created_at', 'desc')->where('user_id',$id)->paginate(100);



        return view('test.mypage')->with([
            "users"=>$users,
            "tweets" => $tweets,
            'myname' => $myname,
            'access' => $myname,
            'likes' => $likes,
        ]);

    }


    public function detail($id) {
        $tweet = DB::table('tweets')->where('id',$id)->first();
        //$answer_tweets = DB::table('answer_tweets')->where('tweet_id',$id)->get();
        $answer_tweets = AnswerTweet::withCount('answer_tweet_likes')->orderBy('created_at', 'desc')->where('tweet_id',$id)->paginate(10);
        $likes = AnswerTweetLike::all();

        $users = AnswerTweet::with('user:id,name')->get();

        return view('test.tw_detail')->with([
            "tweet" => $tweet,
            "answer_tweets" => $answer_tweets,
            "likes" => $likes,
            "users" => $users,
        ]);
    }

    public function tweet_add(Request $request)
    {
        $id = Auth::id();
        $users = DB::table('users')->where('id',$id)->first();
        
        $param = [
            'user_id' => $id,
            'content' => $request->content,
        ];
        //DB::insert('insert into tweet (userID,main) values (:userID,:main)', $param);
        DB::table('tweets') ->insert($param);
        //return back();
        //return redirect()->route('gotomypage', ['access' => $users->name]);
        
        $myname = $users->name;
        $tweets = Tweet::withCount('tweet_likes')->orderBy('created_at', 'desc')->where('user_id',$id)->paginate(100);
        $likes = TweetLike::all();
        return view('test.mypage')->with([
            "users"=>$users,
            "tweets" => $tweets,
            'myname' => $myname,
            'likes' => $likes,
            'access' => $users->name,
        ]);
        
    }


    public function tw_comment(Request $request)
    {
        $id = Auth::id();
        $items = DB::table('users')->where('id',$id)->first();
        
        $param = [
            'tweet_id' => $request->tweet_id,
            'user_id' => $id,
            'content' => $request->content
        ];
        DB::insert('insert into answer_tweets (tweet_id,user_id,content) values (:tweet_id,:user_id,:content)', $param);
        //return redirect('/test');
        return back();
    }










    public function tweetlike(Request $request)
    {
        //var_dump('うんこ');

        
        $id = Auth::user()->id;
        $tweet_id = $request->tweet_id;
        
        $like = TweetLike::where('tweet_id', $tweet_id)->where('user_id', $id)->first();
        $tweet = Tweet::findOrFail($tweet_id);

        if ($like) {
            //likesテーブルのレコードを削除
            $like = TweetLike::where('tweet_id', $tweet_id)->where('user_id', $id)->delete();
        } else {
            TweetLike::create(['user_id' => $id, 'tweet_id' => $tweet_id]);
        }

        $tweetLikesCount = $tweet->loadCount('tweet_likes')->tweet_likes_count;
        //これがajaxのdataとして渡される
        print($tweetLikesCount);   
        
    }


    public function answer_tweet_like(Request $request)
    {
        //var_dump('うんこ');
        //var_dump($request->answer_question_id);

        
        $id = Auth::user()->id;
        $answer_tweet_id = $request->answer_tweet_id;
        //var_dump($question_id);
        
        $like = AnswerTweetLike::where('answer_tweet_id', $answer_tweet_id)->where('user_id', $id)->first();
        $answer_tweet = AnswerTweet::findOrFail($answer_tweet_id);

        if ($like) {
            //likesテーブルのレコードを削除
            $like = AnswerTweetLike::where('answer_tweet_id', $answer_tweet_id)->where('user_id', $id)->delete();
        } else {
            AnswerTweetLike::create(['user_id' => $id, 'answer_tweet_id' => $answer_tweet_id]);
        }

        $answertweetLikesCount = $answer_tweet->loadCount('answer_tweet_likes')->answer_tweet_likes_count;
        //これがajaxのdataとして渡される
        print($answertweetLikesCount);    
    }


    public function gotomypage(Request $request)
    {
        $id = Auth::id();
        $users = DB::table('users')->where('id',$id)->first();
        $tweet_user = DB::table('users')->where('name',$request->id)->first();
        $myname = $users->name;
        $tweets = Tweet::withCount('tweet_likes')->orderBy('created_at', 'desc')->where('user_id',$tweet_user->id)->paginate(100);
        $likes = TweetLike::all();

        return view('test.mypage')->with([
            "users"=>$users,
            "tweets" => $tweets,
            'myname' => $myname,
            'likes' => $likes,
            'access' => $request->id,
        ]);
    }

    public function tweet_destroy($id)
    {
    #削除処理
    $greeting = Tweet::findOrFail($id);
    $greeting->delete();
    
    #greetingsテーブルのレコードを全件取得
    $data = Tweet::all();
    return back();
    }
}

?>
