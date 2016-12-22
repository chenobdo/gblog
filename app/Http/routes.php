<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Blog pages
get('/', function () {
    return redirect('/blog');
});

get('blog', 'BlogController@index');
get('blog/{id}', 'BlogController@showPost');
get('test', 'BlogController@test');

$router->get('contact', 'ContactController@showForm');
Route::post('contact', 'ContactController@sendContactInfo');

get('rss', 'BlogController@rss');

get('sitemap.xml', 'BlogController@siteMap');

// Admin area
get('admin', function () {
    return redirect('/admin/post');
});
$router->group(['namespace' => 'Admin', 'middleware' => 'auth'], function () {
    //Post
    resource('admin/post', 'PostController', ['except' => 'show']);
    //Tag
    resource('admin/tag', 'TagController', ['except' => 'show']);
    //Upload
    get('admin/upload', 'UploadController@index');
    post('admin/upload/file', 'UploadController@uploadFile');
    delete('admin/upload/file', 'UploadController@deleteFile');
    post('admin/upload/folder', 'UploadController@createFolder');
    delete('admin/upload/folder', 'UploadController@deleteFolder');
    //Message
    get('admin/message', 'MessageController@index');
    get('admin/message/paginate', 'MessageController@paginate');
});

// Logging in and out
get('/auth/login', 'Auth\AuthController@getLogin');
post('/auth/login', 'Auth\AuthController@postLogin');
get('/auth/logout', 'Auth\AuthController@getLogout');

//微信
Route::group(['prefix' => '/wechat'], function () {
    Route::post('/', 'WechatController@index');
    Route::get('/login', 'WechatController@login');
});

//swoole
get("/swoole/send", "SwooleController@send");
