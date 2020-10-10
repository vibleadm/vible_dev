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

Route::get('/', 'HomeController@index');

//↓ajax用おためし
Route::post('/sample2', 'PostsController@sample2');
//↑ここまで

Route::get('test', 'PostsController@index');

//こいつがあると名前からmypage飛ぶのが妨害される。。
//Route::post('test/{id}', 'PostsController@index');

Route::get('/test/mypage/tweet/{id}', 'PostsController@tw_show');


Route::get('test/mypage', 'TweetController@mypage')->middleware('auth');


//名前のリンクから飛んでくるとき用
Route::post('test/mypage', 'PostsController@gotomypage')->middleware('auth');
Route::post('test/mypage/tweet', 'PostsController@tw_create')->middleware('auth');


//Route::post('/test/nayami/{id}', 'PostsController@nayami_answer')->middleware('auth');
Route::post('/test/mypage/tweet/{id}', 'PostsController@tw_comment')->middleware('auth');



Route::get('test/add', 'PostsController@nayami_add')->middleware('auth');
Route::post('test/add', 'PostsController@nayami_create')->middleware('auth');







Route::get('hello/session', 'UsersController@ses_get');
Route::post('hello/session', 'UsersController@ses_put');
Route::get('/logout', 'Auth\LoginController@logout');

//ホーム画面のLogin,Registerの表示をしてくれる
Route::auth();




Route::post('/posts/{post}/likes', 'LikesController@store');
Route::post('/posts/{post}/likes/{like}', 'LikesController@destroy');

Route::post('/tweets/{tweet}/likes', 'TweetLikesController@store');
Route::post('/tweets/{tweet}/likes/{like}', 'TweetLikesController@destroy');

Route::get('/nayami/{id}', 'PostsController@show2');
//Route::post('/posts/{id}', 'PostsController@show2');
Route::post('/nayami/{id}', 'PostsController@nayami_answer');



Route::get('/question', 'QuestionController@index');
Route::get('ajax',function() {
    return view('message');
 });
 Route::post('laravel/ajax',function() {
    return view('test/nayami');
 });


Route::get('/', 'PostsController@index')->name('posts.index');

//ログイン中のユーザーのみアクセス可能
//「ajaxlike.jsファイルのurl:'ルーティング'」に書くものと合わせる。
Route::post('/ajaxlike', 'PostsController@ajaxlike');



?>