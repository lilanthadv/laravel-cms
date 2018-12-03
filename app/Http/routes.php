<?php

//Route::get('/posts/{id}', 'PostController@index');
// Route::resource('posts', 'PostController');

Route::get('contact', 'PostController@contact');

Route::get('post/{id}', 'PostController@showPost');

use App\Country;
use App\Image;
use App\Tag;
use App\Video;
use \Illuminate\Support\Facades\DB as DB;
use App\Post as Post;
use App\User as User;
use App\Role as Role;

Route::get('/insert', function () {

    DB::insert('INSERT INTO posts (title, content) VALUES (?,?)', ['Play Game', 'Code 4 is a the my favorite Game']);
});

Route::get('/read', function () {
    $posts = DB::select('SELECT * FROM posts WHERE id = ?', [1]);
    dd($posts[0]->title);
});

Route::get('/update', function () {
    $update = DB::update('update posts set title= ? where  id= ?', ['Today Is rain day', 1]);
    dd($update);
});

Route::get('/delete', function () {
    $delete = DB::delete('delete from posts where id=?', [1]);
    dd($delete);
});

/*
|--------------------------------------------------------------------------
| Eloquent / ORM
|--------------------------------------------------------------------------
*/

Route::get('/read-model', function () {
    $posts = Post::all();
    dd($posts);

});

Route::get('/find', function (){
    $post = Post::find(4);
    dd($post);
});

Route::get('/find-where', function () {
    $post = Post::where('id', 4)
        ->orderBy('id', 'desc')
        ->take(1)
        ->get();

    return $post;
});

Route::get('/create', function () {

    $post = Post::create([
        'title' => 'Eloquent',
        'content' => 'Eloquent is cool thing in laravel'
    ]);

});

Route::get('/update-eloquent', function () {
    $post = Post::where('id', 4)
        ->where('is_admin', 1)
        ->update([
            'title' => 'New Eloquent Update Title',
            'content' => 'New Eloquent Update Content'
        ]);
});

Route::get('/delete-eloquent', function (){
    $post = Post::find(4);
    $post->delete();
});

Route::get('/destroy-eloquent', function () {
    $post = Post::destroy(5);
});


Route::get('/soft-delete', function (){
    $post = Post::find(11);
    $post->delete();

    return Post::all();
});

Route::get('/read-soft-delete', function (){
    $posts = Post::onlyTrashed()->get();
    return $posts;
});

Route::get('/restore-soft-delete', function(){
    $posts = Post::onlyTrashed()->restore();
    return $posts;
});

Route::get('/force-delete-trash', function(){
    $posts = Post::onlyTrashed()->forcedelete();
    return $posts;
});

/*
|--------------------------------------------------------------------------
| Eloquent Relationship
|--------------------------------------------------------------------------
*/
// ONE-to-ONE Relationship
Route::get('/user/{id}/post', function ($id){
    $user = User::find($id);
    return $user->post;
});

// Inverse Relationship
Route::get('/post/{id}/user', function ($id){
    $post = Post::find($id);
    return $post->user;
});

// ONE-to-Many Relationship
    Route::get('/user/{id}/posts', function ($id){
    $user = User::find($id);
    return $user->posts;
});

//  Many to Many Relationship
    Route::get('/user/{id}/roles', function ($id){
        $user = User::find($id);
        return $user->roles;
    });

//  Many to Many Relationship Inverse
Route::get('/role/{id}/users', function ($id){
    $role = Role::find($id);
    return $role->users;
});

//  Many to Many Relationship Pivot
Route::get('/user/{id}/pivot', function ($id){
    $user = User::find($id);
    foreach ($user->roles as $role){
        echo $role->pivot->created_at;
    }
});

//  Has Many Through Relationship
Route::get('/country/{id}/posts', function ($id){
    $country = Country::find($id);
    return $country->posts;
});

// Polymorphic ONE-to-ONE Relationship
Route::get('/user/{id}/image', function ($id) {
    $user = User::find($id);
    return $user->image;
});

Route::get('/post/{id}/image', function ($id) {
    $post = Post::find($id);
    return $post->image;
});

// Polymorphic ONE-to-ONE Inverse Relationship
Route::get('/image/{id}', function ($id) {
    $image = Image::find($id);
    return $image->imageable;
});

// Polymorphic ONE-to-Many Relationship
Route::get('/user/{is}/images', function ($id){
    $user = User::find($id);
    return $user->images;
});

Route::get('/post/{id}/images', function ($id){
    $post = Post::find($id);
    return $post->images;
});

// Polymorphic Many-to-Many Relationship
Route::get('/post/{id}/tags', function ($id){
    $post = Post::find($id);
    return $post->tags;
});
Route::get('/video/{id}/tags', function ($id){
    $video = Video::find($id);
    return $video->tags;
});

// Polymorphic Many-to-Many Relationship get tags
Route::get('/tag/{id}/video', function ($id){
    $tag = Tag::find($id);
    return $tag->videos;
});

Route::get('/tag/{id}/post', function ($id){
    $tag = Tag::find($id);
    return $tag->posts;
});

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

/*Route::group(['middleware' => ['web']], function () {
    //
});*/
