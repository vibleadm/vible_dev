<?php

namespace App\Http\Controllers;

use App\TestPost;
use App\TestLike;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TestPostsController extends Controller
{
    public function index()
    {
        $data = [];
        // ユーザの投稿の一覧を作成日時の降順で取得
        //withCount('テーブル名')とすることで、リレーションの数も取得できます。
        $posts = TestPost::withCount('test_likes')->orderBy('created_at', 'desc')->paginate(10);
        $like_model = new TestLike;

        $data = [
                'posts' => $posts,
                'like_model'=>$like_model,
            ];

        return view('posts.index', $data);
    }

        public function ajaxlike(Request $request)
    {
        $id = Auth::user()->id;
        $post_id = $request->post_id;
        $like = new TestLike;
        $post = TestPost::findOrFail($post_id);
        //loadCountとすればリレーションの数を○○_countという形で取得できる（今回の場合はいいねの総数）
        $postLikesCount = $post->loadCount('test_likes')->likes_count;

        // 空でないなら
        if ($like->like_exist($id, $post_id)) {
            //likesテーブルのレコードを削除
            $like = TestLike::where('post_id', $post_id)->where('user_id', $id)->delete();
        } else {
            //likesテーブルに新しいレコードを作成する
            $like = new TestLike;
            $like->post_id = $request->post_id;
            $like->user_id = Auth::user()->id;
            $like->save();
        }

        //一つの変数にajaxに渡す値をまとめる
        //今回ぐらい少ない時は別にまとめなくてもいいけど一応。笑
        $json = [
            'postLikesCount' => $postLikesCount,
        ];
        //下記の記述でajaxに引数の値を返す
        return response()->json($json);
    }
}
