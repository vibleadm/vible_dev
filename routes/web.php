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


Route::get('test', 'PostsController@index');
Route::get('/test/nayami/{id}', 'PostsController@show');
Route::get('/test/mypage/tweet/{id}', 'PostsController@tw_show');


Route::get('test/mypage', 'PostsController@mypage')->middleware('auth');

//名前のリンクから飛んでくるとき用
Route::post('test/mypage', 'PostsController@create')->middleware('auth');
Route::post('test/mypage/tweet', 'PostsController@tw_create')->middleware('auth');


Route::post('/test/nayami/{id}', 'PostsController@nayami_answer')->middleware('auth');
Route::post('/test/mypage/tweet/{id}', 'PostsController@tw_comment')->middleware('auth');



Route::get('test/add', 'PostsController@nayami_add')->middleware('auth');
Route::post('test/add', 'PostsController@nayami_create')->middleware('auth');







Route::get('hello/session', 'UsersController@ses_get');
Route::post('hello/session', 'UsersController@ses_put');
Route::get('/logout', 'Auth\LoginController@logout');

//ホーム画面のLogin,Registerの表示をしてくれる
Route::auth();
