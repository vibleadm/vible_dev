<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Like;
use Auth;
use App\Question;
use App\Post;

class LikesController extends Controller
{
    public function store(Request $request, $qid)
    {
        //ここでlikesテーブルに追加している！
        Like::create(
          array(
            'user_id' => Auth::user()->id,
            'qid' => $qid,
            'post_id' => 1,
            //'qid' => 1
          )
        );

        //$post = Post::findOrFail($postId);
        $post = Question::findOrFail($qid);

        //return redirect('/test');

        //return redirect()
          //   ->action('PostsController@show2', $post->id);
    }

    public function destroy($postId, $likeId) {
      //$post = Post::findOrFail($postId);
      $post = Question::findOrFail($postId);
      $post->like_by()->findOrFail($likeId)->delete();

      //return redirect('/test');

      //return redirect()
            // ->action('PostsController@show2', $post->id);
    }
}
