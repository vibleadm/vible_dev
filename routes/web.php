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


/*
Route::get('hello', 'HelloController@index')
    ->middleware(HelloMiddleware::class);
*/
Route::get('hello', 'HelloController@index')->middleware('auth');
Route::post('hello', 'HelloController@post');



Route::get('test', 'HelloController@nayami');

Route::get('hello/add', 'HelloController@add');
Route::post('hello/add', 'HelloController@create');

Route::get('test/add', 'HelloController@nayami_add');
Route::post('test/add', 'HelloController@nayami_create');


Route::get('hello/edit', 'HelloController@edit');
Route::post('hello/edit', 'HelloController@update');

Route::get('hello/show', 'HelloController@show');


Route::get('hello/session', 'HelloController@ses_get');
Route::post('hello/session', 'HelloController@ses_put');
/*
Route::get('hello', function () {
    return '<html><body><h1>HELLO</h1><p>This is sample page.
        </p></body></html>';
});


Route::get('hello', 'HelloController@index');
Route::get('hello/other', 'HelloController@other');
*/

Route::get('person', 'PersonController@index');



Auth::routes();


Route::get('profile', function() {
    // 認証済みのユーザーのみが入れる
})->middleware('auth');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/test/menu', 'Test\MenuController@menu');
Route::get('/test/test', 'Test\MenuController@test');
Route::get('/test/nayami', 'Test\MenuController@nayami');




Route::get('/test/mypage', 'HelloController@show_user')->middleware('auth');
Route::get('/logout', 'Auth\LoginController@logout');
