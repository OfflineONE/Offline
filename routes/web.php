<?php

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


//use Illuminate\Support\Facades\Http;
//
//Route::get('/example', function () {
////    return view('welcome');
//    $response = http::retry(2, 1000)->post('https://jsonplaceholder.typicode.com/posts', [
//        'tata' => 123
//    ]);
//    if ($response->offsetExists('id')) {
//       dd($response->header('Vary'));
//    }
//});


Route::view('/', 'welcome');

Auth::routes(['verify' => true]);

Route::get('/home', 'ProfilesController@show')->name('home');

Route::get('threads/search', 'SearchController@show');

Route::view('scan', 'scan');

Route::get('threads', 'ThreadsController@index')->name('threads');
Route::get('threads/create', 'ThreadsController@create')->middleware('verified');
Route::get('threads/{channel}/{thread}', 'ThreadsController@show');
Route::patch('threads/{channel}/{thread}', 'ThreadsController@update');
Route::delete('threads/{channel}/{thread}', 'ThreadsController@destroy');
Route::post('threads', 'ThreadsController@store')->middleware('verified');
Route::get('threads/{channel}', 'ThreadsController@index');


Route::post('locked-threads/{thread}', 'LockedThreadsController@store')->name('locked-threads.store')->middleware('admin');
Route::delete('locked-threads/{thread}', 'LockedThreadsController@destroy')->name('locked-threads.destroy')->middleware('admin');

Route::post('/threads/{channel}/{thread}/replies', 'RepliesController@store');
Route::get('/threads/{channel}/{thread}/replies', 'RepliesController@index');
Route::patch('/replies/{reply}', 'RepliesController@update');
Route::delete('/replies/{reply}', 'RepliesController@destroy')->name('replies.destroy');

Route::post('/threads/{channel}/{thread}/subscriptions', 'ThreadSubscriptionsController@store')->middleware('auth');
Route::delete('/threads/{channel}/{thread}/subscriptions', 'ThreadSubscriptionsController@destroy')->middleware('auth');

Route::post('/replies/{reply}/favorites', 'FavoritesController@store');
Route::delete('/replies/{reply}/favorites', 'FavoritesController@destroy');

Route::get('/profiles/{user}', 'ProfilesController@show')->name('profile.show');
Route::get('/profiles/{user}/notifications', 'UserNotificationsController@index');
Route::delete('/profiles/{user}/notifications/{notification}', 'UserNotificationsController@destroy');

Route::get('/api/users', 'UsersController@index');
Route::post('/api/users/{user}/avatar', 'api\UserAvatarController@store')->middleware('auth')->name('avatar');

Route::post('/replies/{reply}/best', 'BestRepliesController@store')->name('best-replies.store');


Route::group([
    'prefix' => 'admin',
    'middleware' => 'admin',
    'namespace' => 'Admin'
], function() {
    Route::get('/', 'DashboardController@index')->name('admin.dashboard.index');
    Route::post('/channels', 'ChannelsController@store')->name('admin.channels.store');
    Route::get('/channels', 'ChannelsController@index')->name('admin.channels.index');
    Route::get('/channels/create', 'ChannelsController@create')->name('admin.channels.create');
});
