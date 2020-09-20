<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\TweetLike;
use Auth;
use App\Tweet;


class TweetLikesController extends Controller
{
    public function store(Request $request, $tweet_id)
    {
        //ここでlikesテーブルに追加している！
        TweetLike::create(
          array(
            'user_id' => Auth::user()->id,
            'tweet_id' => $tweet_id,
          )
        );

        //$post = Post::findOrFail($postId);
        $post = Tweet::findOrFail($tweet_id);

        return redirect('/test/mypage');

        //return redirect()
          //   ->action('PostsController@show2', $post->id);
    }

    public function destroy($postId, $likeId) {
      //$post = Post::findOrFail($postId);
      $post = Tweet::findOrFail($postId);
      $post->like_by()->findOrFail($likeId)->delete();

      return redirect('/test/mypage');

      //return redirect()
            // ->action('PostsController@show2', $post->id);
    }
}
