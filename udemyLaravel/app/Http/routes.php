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

Route::get('/', function () {
    return view('welcome');
});

//Going to go to the post controller and hit the index function
//Route::get('/post/{name}', 'PostController@index');

//This will create routes with names and http methods of the functions in the PostController class
//Route::resource('posts', 'PostController');

Route::get('/contact', 'PostController@showContactPage');

Route::get('post/{id}/{name}', 'PostController@show_post');


/*
Route::get('/about', function () {
    return "Hi, this is the about page.";
});

Route::get('/contact', function () {
    return "Hi, this is the contact page.";
});

Route::get('/post/{id}', function ($id) {
    return "This is post number " . $id;
});

//Named the routes
Route::get('admin/post/example', array ('as'=>'admin.home', function() {
    $url = route('admin.home');
    //<a href="route(''admin.home)">CLICK HERE</a>
    return "this url is " . $url;
}));
*/