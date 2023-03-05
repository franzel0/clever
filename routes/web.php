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

Route::get('/', function () {
    return view('welcome');
});
//Route::get('/', 'PostController@index');

Auth::routes();

Route::group(['middleware' => 'auth'], function () {

    Route::get('/home', 'PostController@index')->name('home');

    Route::resource('post', 'PostController');

    Route::resource('tag', 'TagController');

    Route::resource('post.comment', 'CommentController');

    Route::get('withTag/{tag}', 'PostController@withTag');

    Route::get('gettag', 'PostController@gettag');

    Route::group(['middleware' => 'can:isAdmin'], function(){
        Route::resource('user', 'UserController');
    });

    Route::get('unpublished', 'PostController@unpublished')->name('unpublished');

    Route::get('tobepublished', 'PostController@tobepublished')->name('tobepublished');

    Route::get('post/{post}/reset', 'PostController@reset')->name('post.reset');

    Route::post('post/search', 'PostController@search')->name('post.search');

    Route::get('pdf/post/{post}', 'PdfController@post')->name('pdf.post');

    // Dieser Bereich ist nur zum Testen
    Route::get('test', function(){
        $tags = \App\Tag::join('post_tag', 'post_tag.tag_id', '=', 'tags.id')
            ->groupBy('tags.id')
            ->get(['tags.id', 'tags.name', DB::raw('count(tags.id) as tag_count')])
            // ->sortBy('tag_count', SORT_NATURAL|SORT_FLAG_CASE|DESC)
            ->sortByDesc('tag_count')
            ->take(5)
            ->sortBy('name');
        $tags1 = \App\Tag::join('post_tag', 'post_tag.tag_id', '=', 'tags.id')
            ->groupBy('tags.id')
            ->get(['tags.id', 'tags.name', DB::raw('count(tags.id) as tag_count')])
            ->take(5);
        return view('test', compact('tags', 'tags1'));
    })->name('test');

});
