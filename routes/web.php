<?php

use Illuminate\Support\Facades\Route;

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
//});
Auth::routes();

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::get('/', 'PostController@index')->name('home');


Route::resource('category','CategoryController');

Route::get('profile', function(){
    return view('profile');
});

/* View Composer*/
View::composer(['*'], function($view){

    $user = Auth::user();
    $view->with('user',$user);

});

Route::get('/login/{provider}', 'Auth\LoginController@redirectToProvider')
    ->name('social.login');
Route::get('/login/{provider}/callback', 'Auth\LoginController@handleProviderCallback')
    ->name('social.callback');


/**
 * Authentication group.
 */
Route::group(['middleware' => ['auth']], function () {

    /**
     * Admin group.
     */
    Route::group(['middleware' => ['can:isAdmin']], function () {


        Route::group(['prefix' => 'post'], function () {
            Route::put('review', 'PostController@review');
        });

    });

    /**
     * Admin ,Author group.
     */
    Route::group(['middleware' => ['can:isAdmin, isAuthor']], function () {
        Route::resource('posts', 'PostController');
    });

    /**
     * User group.
     */
    Route::group(['middleware' => ['can:isAdmin, isAuthor, isUser']], function () {

    });
});



