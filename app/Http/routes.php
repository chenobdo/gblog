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

$router->get('contact', 'ContactController@showForm');
Route::post('contact', 'ContactController@sendContactInfo');

get('rss', 'BlogController@rss');

get('sitemap.xml', 'BlogController@siteMap');

// Admin area
get('admin', function () {
    return redirect('/admin/post');
});
$router->group(['namespace' => 'Admin', 'middleware' => 'auth'], function () {
    resource('admin/post', 'PostController', ['except' => 'show']);
    resource('admin/tag', 'TagController', ['except' => 'show']);
    get('admin/upload', 'UploadController@index');
    // 添加如下路由
    post('admin/upload/file', 'UploadController@uploadFile');
    delete('admin/upload/file', 'UploadController@deleteFile');
    post('admin/upload/folder', 'UploadController@createFolder');
    delete('admin/upload/folder', 'UploadController@deleteFolder');
});

// Logging in and out
get('/auth/login', 'Auth\AuthController@getLogin');
post('/auth/login', 'Auth\AuthController@postLogin');
get('/auth/logout', 'Auth\AuthController@getLogout');//2016-01-01
//2016-01-02
//2016-01-03
//2016-01-04
//2016-01-05
//2016-01-06
//2016-01-07
//2016-01-08
//2016-01-09
//2016-01-10
//2016-01-11
//2016-01-12
//2016-01-13
//2016-01-14
//2016-01-15
//2016-01-16
//2016-01-17
//2016-01-18
//2016-01-19
//2016-01-20
//2016-01-21
//2016-01-22
//2016-01-23
//2016-01-24
//2016-01-25
//2016-01-26
//2016-01-27
//2016-01-28
//2016-01-29
//2016-01-30
//2016-01-31
//2016-02-01
//2016-02-02
//2016-02-03
//2016-02-04
//2016-02-05
//2016-02-06
//2016-02-07
//2016-02-08
//2016-02-09
//2016-02-10
//2016-02-11
//2016-02-12
//2016-02-13
//2016-02-14
//2016-02-15
//2016-02-16
//2016-02-17
//2016-02-18
//2016-02-19
//2016-02-20
//2016-02-21
//2016-02-22
//2016-02-23
//2016-02-24
//2016-02-25
//2016-02-26
//2016-02-27
//2016-02-28
//2016-02-29
//2016-03-01
//2016-03-02
//2016-03-03
//2016-03-04
//2016-03-05
//2016-03-06
//2016-03-07
//2016-03-08
//2016-03-09
//2016-03-10
//2016-03-11
//2016-03-12
//2016-03-13
//2016-03-14
//2016-03-15
//2016-03-16
//2016-03-17
//2016-03-18
//2016-03-19
//2016-03-20
//2016-03-21
//2016-03-22
//2016-03-23
//2016-03-24
//2016-03-25
//2016-03-26
//2016-03-27
//2016-03-28
//2016-03-29
//2016-03-30
//2016-03-31
//2016-04-01
//2016-04-02
//2016-04-03
//2016-04-04
//2016-04-05
//2016-04-06
//2016-04-07
//2016-04-08
//2016-04-09
//2016-04-10
//2016-04-11
//2016-04-12
//2016-04-13
//2016-04-14
//2016-04-15
//2016-04-16
//2016-04-17
//2016-04-18
//2016-04-19
//2016-04-20
//2016-04-21
//2016-04-22
//2016-04-23
//2016-04-24
//2016-04-25
//2016-04-26
//2016-04-27
//2016-04-28
//2016-04-29
//2016-04-30
//2016-05-01
//2016-05-02
//2016-05-03
//2016-05-04
//2016-05-05
//2016-05-06
//2016-05-07
//2016-05-08
//2016-05-09
//2016-05-10
//2016-05-11
//2016-05-12
//2016-05-13
//2016-05-14
//2016-05-15
//2016-05-16
//2016-05-17
//2016-05-18
//2016-05-19
//2016-05-20
//2016-05-21
//2016-05-22
//2016-05-23
//2016-05-24
//2016-05-25
//2016-05-26
//2016-05-27
//2016-05-28
//2016-05-29
//2016-05-30
//2016-05-31
//2016-06-01
//2016-06-02
//2016-06-03
//2016-06-04
//2016-06-05
//2016-06-06
//2016-06-07
//2016-06-08
//2016-06-09
//2016-06-10
//2016-06-11
//2016-06-12
//2016-06-13
//2016-06-14
//2016-06-15
//2016-06-16
//2016-06-17
//2016-06-18
//2016-06-19
//2016-06-20
//2016-06-21
//2016-06-22
//2016-06-23
//2016-06-24
//2016-06-25
//2016-06-26
//2016-06-27
//2016-06-28
//2016-06-29
//2016-06-30
//2016-07-01
//2016-07-02
//2016-07-03
//2016-07-04
//2016-07-05
//2016-07-06
//2016-07-07
//2016-07-08
//2016-07-09
//2016-07-10
//2016-07-11
//2016-07-12
//2016-07-13
//2016-07-14
//2016-07-15
//2016-07-16
//2016-07-17
//2016-07-18
//2016-07-19
//2016-07-20
//2016-07-21
//2016-07-22
//2016-07-23
//2016-07-24
//2016-07-25
//2016-07-26
//2016-07-27
//2016-07-28
//2016-07-29
//2016-07-30
//2016-07-31
//2016-08-01
//2016-08-02
//2016-08-03
//2016-08-04
//2016-08-05
//2016-08-06
//2016-08-07
//2016-08-08
//2016-08-09
//2016-08-10
//2016-08-11
//2016-08-12
//2016-08-13
//2016-08-14
//2016-08-15
//2016-08-16
//2016-08-17
//2016-08-18
//2016-08-19
//2016-08-20
//2016-08-21
//2016-08-22
//2016-08-23
//2016-08-24
//2016-08-25
//2016-08-26
//2016-08-27
//2016-08-28
//2016-08-29
//2016-08-30
//2016-08-31
//2016-09-01
//2016-09-02
//2016-09-03
//2016-09-04
//2016-09-05
