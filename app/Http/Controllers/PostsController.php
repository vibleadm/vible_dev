<?php

namespace App\Http\Controllers;

use App\Post;
use App\Like;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Question;
use App\QuestionLike;
use Illuminate\Support\Facades\DB;

class PostsController extends Controller
{

    public function index()
    {
        $data = [];
        // ユーザの投稿の一覧を作成日時の降順で取得
        //withCount('テーブル名')とすることで、リレーションの数も取得できます。
        $posts = Post::withCount('likes')->orderBy('created_at', 'desc')->paginate(10);
        //$liked = Like::where('user_id',2)->first();
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
        //loadCountとすればリレーションの数を○○_countという形で取得できる（今回の場合はいいねの総数）
        $postLikesCount = $post->loadCount('likes')->likes_count;
        var_dump($postLikesCount);
        
        

        $data = [
                'posts' => $posts,
                'like_model'=>$like_model,
                //'liked'=>$liked,
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
        //これがajaxのdataとして渡される
        print($postLikesCount);
        

        //一つの変数にajaxに渡す値をまとめる
        //今回ぐらい少ない時は別にまとめなくてもいいけど一応。笑
        $json = [
            'postLikesCount' => $postLikesCount,
        ];
        //下記の記述でajaxに引数の値を返す
        //return response()->json($json);

        
    }

    public function index2(Request $request)
    {
        //$posts = DB::table('Questions')->get();
        //こいつはオブジェクト
        //こいつのお尻にlike判定の0/1を追加したい
        $posts = Question::all();
        $postLikesCount = Question::select('likes_count')->get();
        //$post = Question::findOrFail(27); 
        
        $id = Auth::id();
        $whoami = DB::table('users')->where('id',$id)->first();
        //$posts2 = Question::get('qid');

        //$like = $post->likes()->where('user_id', Auth::user()->id)->first();
        //var_dump($like);
        foreach($posts as $post2){
            //likesまでで、そのqidの投稿がどれだけlikesされてるか持ってきてくれる
            $like2 = $post2->likes()->where('user_id', Auth::user()->id)->first();
            if($like2 == null){
                //likeまだしていなかったら０を追加
                $like2 = 0;
                $post2->liked =$like2;
                /*
                echo('<pre>');
                var_dump($post2);
                echo('</pre>');
                */
                
                //$post2 =array_merge(array($post2),$like2);
                //$post2->liked =$like2;

            }
            else{
                //すでにlikeしていれば１を追加
                //$like2 = 1;
                $post2->liked =$like2;
                
                /*
                echo('<pre>');
                var_dump($post2);
                echo('</pre>');
                */

                //$post2->liked =$like2;
            }

            //$posts ->append(array($post2));
            /*
            echo('<pre>');
            var_dump($posts);
            echo('</pre>');
            */
            
        }
        
        return view('test.nayami')->with(array('items'=>$posts,'post2'=>$post2, 'postLikesCount'=>$postLikesCount,'whoami'=>$whoami));
    }
}