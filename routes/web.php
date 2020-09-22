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

Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
Route::get('email/verify/{id}', 'Auth\VerificationController@verify')->name('verification.verify');
Route::get('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');


Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::get('/', 'PostProductController@index')->name('home.index')->middleware('verified');

Route::post('/comments/store', 'PostCommentController@store')->name('comments.store');
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
Route::group(['middleware' => ['auth']], function () {
    Route::resource('users', 'UserController');
    Route::resource('posts', 'PostProductController')->only(['create', 'store', 'delete']);



    /**
     * Admin group.
     */
    Route::group(['middleware' => ['can:isAdmin']], function () {

        Route::group(['prefix' => 'post'], function () {
            Route::put('review', 'PostProductController@review');
        });
        Route::get('/admin/index','AdminController@index')->name('admin.index');
        Route::post('/admin/approvePost', 'AdminController@approvePost')->name('admin.approvePost');
        Route::post('/admin/updatePost', 'AdminController@updatePost')->name('admin.updatePost');
        Route::post('/posts/delete', 'PostProductController@delete')->name('posts.delete');

    });

    /**
     * Admin ,Author group.
     */
    Route::group(['middleware' => ['can:isAdmin,isAuthor']], function () {


    });

    /**
     * User group.
     */
    Route::group(['middleware' => ['can:isAdmin,isAuthor,isUser']], function () {

    });
});


Route::resource('posts', 'PostProductController')->only(['index', 'show'])->middleware('verified');




