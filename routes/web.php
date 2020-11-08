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

Auth::routes(['verify' => true]);

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::get('/', 'PostProductController@index')->name('home');

Route::post('/reply/store', 'PostCommentController@replyStore')->name('reply.store');



Route::get('/cites','AddressController@getCities')->name('address.getCities');
Route::get('/cities/{code}/districts', 'AddressController@getDistricts')->name('address.getDistricts');
Route::get('/districts/{code}/wards','AddressController@getWards')->name('address.getWards');




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
Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::resource('/comments', 'PostCommentController')->only(['store', 'index']);

    Route::resource('users', 'UserController');
    Route::resource('posts', 'PostProductController')->only(['create', 'store', 'delete']);



    /**
     * Admin group.
     */
    Route::group(['middleware' => ['can:isAdmin', 'verified']], function () {

        Route::group(['prefix' => 'post'], function () {
            Route::put('review', 'PostProductController@review');
        });
        Route::get('/admin/index','AdminController@index')->name('admin.index');
        Route::post('/admin/approvePost', 'PostProductController@approvedProduct')->name('admin.approvePost');
        Route::post('/posts/delete', 'PostProductController@delete')->name('posts.delete');
        Route::post('/admin/posts', 'PostProductController@update')->name('posts.update');

    });

    /**
     * Admin ,Author group.
     */
    Route::group(['middleware' => ['can:isAdmin,isAuthor']], function () {


    });

    /**
     * User group.
     */
    Route::group(['middleware' => ['can:isAdmin,isAuthor,isUser', 'verified']], function () {
        Route::put('/user/updateUser', 'UserController@update')->name('user.updateUser');
    });
});


Route::resource('posts', 'PostProductController')->only(['index', 'show']);




