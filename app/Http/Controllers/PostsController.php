<?php

namespace App\Http\Controllers;

use App\Post;
use App\Like;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class PostsController extends Controller
{

    public function index()
    {
        $data = [];
        // ユーザの投稿の一覧を作成日時の降順で取得
        //withCount('テーブル名')とすることで、リレーションの数も取得できます。
        $posts = Post::withCount('likes')->orderBy('created_at', 'desc')->paginate(10);
        $liked = Like::where('user_id',2)->first();
        $like_model = Like::all();

        /*
        $like = Like::where('post_id', 100)->where('user_id',10)->first();
        if($like){
            var_dump('いいね済み');
        }else{
            var_dump('いいねしてない');
        }
        */

        $post = Post::findOrFail(1);
        //var_dump($post);
        //loadCountとすればリレーションの数を○○_countという形で取得できる（今回の場合はいいねの総数）
        $postLikesCount = $post->loadCount('likes')->likes_count;
        var_dump($postLikesCount);
        
        

        $data = [
                'posts' => $posts,
                'like_model'=>$like_model,
                'liked'=>$liked,
                //'like'=>$like,
            ];

        return view('posts.index', $data);
    }

        public function ajaxlike(Request $request)
    {
        $id = Auth::user()->id;
        $post_id = $request->post_id;
        $like = Like::where('post_id', $post_id)->where('user_id', $id)->first();

        //var_dump('うんこ');
        //var_dump($id);
        //var_dump($post_id);
        $post = Post::findOrFail($post_id);
        //loadCountとすればリレーションの数を○○_countという形で取得できる（今回の場合はいいねの総数）
        //$postLikesCount = $post->loadCount('likes')->likes_count;
        //print($postLikesCount);
        //var_dump($postLikesCount);
        
        // 空でないなら
        if ($like) {
            //likesテーブルのレコードを削除
            //var_dump('うんこifです');
            $like = Like::where('post_id', $post_id)->where('user_id', $id)->delete();
        } else {
            //var_dump('うんこelseです');
            Like::create(['user_id' => $id, 'post_id' => $post_id]);

            /*likesテーブルに新しいレコードを作成する
            $like = new Like;
            $like->post_id = $request->post_id;
            $like->user_id = Auth::user()->id;
            $like->save();
            */
        }

        
        $postLikesCount = $post->loadCount('likes')->likes_count;
        print($postLikesCount);
        

        //一つの変数にajaxに渡す値をまとめる
        //今回ぐらい少ない時は別にまとめなくてもいいけど一応。笑
        $json = [
            'postLikesCount' => $postLikesCount,
        ];
        //下記の記述でajaxに引数の値を返す
        //return response()->json($json);

        
    }
}