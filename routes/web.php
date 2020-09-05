<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\HelloMiddleware;





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
Route::get('hello', 'HelloController@nayami');
Route::post('hello', 'HelloController@post');


Route::get('hello/add', 'HelloController@add');
Route::post('hello/add', 'HelloController@create');

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

Route::get('/home', 'HomeController@index')->name('home');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
