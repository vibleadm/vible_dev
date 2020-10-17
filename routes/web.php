<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\HelloMiddleware;
use Illuminate\Auth\Middleware\Authenticate;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




Route::get('/', function () {
    return view('welcome');
});



//↓ajax用おためし
Route::post('/sample2', 'PostsController@sample2');
//↑ここまで

Route::get('test', 'QuestionController@index');
Route::post('/questionlike', 'QuestionController@ajaxlike');


//こいつがあると名前からmypage飛ぶのが妨害される。。
//Route::post('test/{id}', 'PostsController@index');




Route::get('test/mypage', 'TweetController@mypage')->middleware('auth');
Route::get('/test/mypage/tweet/{id}', 'TweetController@detail');
Route::post('/tweetlike', 'TweetController@tweetlike');
Route::post('/answertweetlike', 'TweetController@answer_tweet_like');

//名前のリンクから飛んでくるとき用
Route::post('test/mypage', 'TweetController@gotomypage')->middleware('auth');


Route::post('test/mypage/tweet', 'TweetController@tweet_add')->middleware('auth');

Route::post('/test/mypage/tweet/{id}', 'TweetController@tw_comment')->middleware('auth');



Route::get('test/add', 'QuestionController@nayami_add')->middleware('auth');
Route::post('test/add', 'QuestionController@nayami_create')->middleware('auth');






/*
Route::get('hello/session', 'UsersController@ses_get');
Route::post('hello/session', 'UsersController@ses_put');
*/
Route::get('/logout', 'Auth\LoginController@logout');

//ホーム画面のLogin,Registerの表示をしてくれる
Route::auth();



/*
Route::post('/posts/{post}/likes', 'LikesController@store');
Route::post('/posts/{post}/likes/{like}', 'LikesController@destroy');

Route::post('/tweets/{tweet}/likes', 'TweetLikesController@store');
Route::post('/tweets/{tweet}/likes/{like}', 'TweetLikesController@destroy');
*/

Route::get('/nayami/{id}', 'QuestionController@detail');
//Route::post('/posts/{id}', 'PostsController@show2');
Route::post('/nayami/{id}', 'QuestionController@nayami_answer');
Route::post('answerquestionlike', 'QuestionController@answer_question_like');




/*
Route::get('/', 'PostsController@index')->name('posts.index');

//ログイン中のユーザーのみアクセス可能
//「ajaxlike.jsファイルのurl:'ルーティング'」に書くものと合わせる。
Route::post('/ajaxlike', 'PostsController@ajaxlike');
*/



?>