<?php

use App\Http\Controllers\BlogController;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
});

Route::prefix('/blog')->name('blog.')->controller(BlogController::class)->group(function () {

    Route::get('/', 'index')->name('index');

    Route::get('/new', 'create')->name('create');
    Route::post('/new', 'store');

    Route::get('{post}/edit', 'edit')->name('edit');
    //Route::post('{post}/edit', 'update');
    //avec 'patch':
    Route::patch('{post}/edit', 'update');

    //destroy
    //Route::get('{post}/delete', 'delete')->name('delete');

    Route::get('/{slug}-{post}', 'show')->where([
        'post' => '[0-9]+',
        'slug' => '[a-z0-9\-]+'
    ])->name('show');
});
