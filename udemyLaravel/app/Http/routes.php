<?php

use Illuminate\Support\Facades\DB;
use App\Post;
use App\User;
use App\Country;

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

/*
|--------------------------------------------------------------------------
| Raw SQL Queries
|--------------------------------------------------------------------------
| Need this: use Illuminate\Support\Facades\DB;
*/

/*
Route::get('/insert', function(){
    DB::insert('INSERT INTO posts(title, content) values(?, ?)', ['PHPO with Laravel', 'Laravel is not a bad PHP framework and has lots of features.']);
});

Route::get('/read', function() {
    $results = DB::select('select * from posts where id = ?', [1]);
    //results come in a array of STD class object.
    //var_dump($results);
    foreach ($results as $result) {
        return $result->title;
    }
});

Route::get('/update', function(){
    $updated = DB::update('UPDATE posts set title = "PHP with Laravel" where id = ?', [1]);
    return $updated;
});

Route::get('/delete', function(){
    $deleted = DB::delete('DELETE FROM posts WHERE id = ?', [1]);
    return $deleted;
});
*/

/*
|--------------------------------------------------------------------------
| Eloquent ORM
|--------------------------------------------------------------------------
*/

Route::get('/read', function(){
    //Pulls all the record from the DB
    $posts = Post::all();
    foreach ($posts as $post) {
        return $post->title;
    }
});

Route::get('/find', function(){
    $post = Post::find(2);
    return $post->title;
});

Route::get('findwhere', function(){
    $posts = Post::where('id', 2)->orderBy('id', 'desc')->take(1)->get();
    return $posts;
});

Route::get('findmore', function(){
    $posts = Post::findOrFail();
    return $posts;
});

//Inserting data with Eloquent
Route::get('/basicinsert', function(){
    $post = new Post;
    $post->title = "New Eloquent title insert";
    $post->content = "Wow check out what eloquent can do at https://laravel.com/docs/5.8/queries";
    //Save can be used to update, but first you will need to find the object to update like $post = new Post::find(1);
    $post->save();
});

//Had to specify in the Post object in the $fillable variable which value are safe to create.
Route::get('/create', function(){
    Post::create(['title'=>'The create method', 'content'=>'Wow I\'m learning a lot about laravel']);
});

//Updating data
Route::get('/update', function(){
    Post::where('id', 2)->where('is_admin', 0)->update(['title'=>'NEW PHP TITLE', 'content'=>'PHP is an ok and powerful programing language.']);
});

//Deleting data
Route::get('/delete', function(){
    $post = Post::find(2);
    $post->delete();
    //below code also works
    //Post::destroy(2);
    //Post::destroy([1,2]);
    //Post::where('is_admin', 0)->delete();
});

//Soft delete / trashing
Route::get('/softdelete', function(){
    Post::find(3)->delete();
});

//Retrieving deleted / trashed records
Route::get('/readsoftdelete', function(){
    //Does not work, need to use withTrashed method
    //$post = Post::find(3);
    //return $post;

    // $post = Post::withTrashed()->where('id', 3)->get();
    // return $post;
    $post = Post::onlyTrashed()->get();
    return $post;
});

//Restoring deleted / trashed items
Route::get('/restoresoftdeletes', function(){
    $posts = Post::onlyTrashed()->restore();
});

//Delete items permanently 
Route::get('/forcedelete', function(){
    Post::onlyTrashed()->forceDelete();
});


/*
|--------------------------------------------------------------------------
| Eloquent Relationships
|--------------------------------------------------------------------------
*/

//One to one relationship
Route::get('/user/{id}/post', function($id){
    User::find(1)->post->content; 
});

Route::get('/post/{id}/user', function($id){
    return Post::find($id)->user->name;
});

//One to many
Route::get('/posts', function(){
    $user = User::find(1);
    foreach($user->posts as $post)
    {
        echo $post->title . "<br>";
    }
});

//Many to many relationship
Route::get('/user/{id}/role', function($id){
    $user = User::find($id)->roles()->orderBy('id', 'desc')->get();
    // foreach ($user->roles as $role) 
    // {
    //     return $role->name;
    // }
    return $user;
});

//Access the pivot/joining table
Route::get('/user/pivot', function(){
    $user = User::find(1);
    foreach ($user->roles as $role) {
        echo $role->pivot->created_at;
    }
});

Route::get('/user/country', function(){
    $country = Country::find(1);
    foreach ($country->posts as $post) 
    {
        return $post->title;
    }
});