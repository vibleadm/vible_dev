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




//Route::get('/', function () {
//    return view('welcome');
//})->name('toppage');
Route::get('/', 'QuestionController@index')->name('toppage');

Route::delete('test/destroy/{id}', 'QuestionController@nayami_destroy')->name('destroy');
Route::delete('test/mypage/destroy/{id}', 'TweetController@tweet_destroy')->name('tweet.destroy');


Route::get('test', 'QuestionController@index')->name('toppage');
Route::post('/questionlike', 'QuestionController@ajaxlike');





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



Route::get('/logout', 'Auth\LoginController@logout');

//ホーム画面のLogin,Registerの表示をしてくれる
Route::auth();


Route::get('/nayami/{id}', 'QuestionController@detail')->middleware('auth');
Route::post('/nayami/{id}', 'QuestionController@nayami_answer');
Route::post('answerquestionlike', 'QuestionController@answer_question_like');





?>

