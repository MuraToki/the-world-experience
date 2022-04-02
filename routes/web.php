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
// Welcome.blade.php => 最初のページ
Route::get('/', function () {
  return view('welcome');
});

// Welcome.blade.php => 最初のページ（英語version）
Route::get('/en', function () {
    return view('wel-eng');
});

//世界体験記とは（Aboutページ）にとぶ
Route::get('/about', function () {
    return view('about');
});

Auth::routes();


Route::group(['middleware' => 'auth'], function () {

//体験記一覧
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//体験記の作成
Route::get('/create', [App\Http\Controllers\HomeController::class, 'create'])->name('create');

//体験記の登録
Route::post('/store', [App\Http\Controllers\HomeController::class, 'store'])->name('store');

//体験記の詳細
Route::get('/detail/{id}', [App\Http\Controllers\HomeController::class, 'detail'])->name('detail');

//それぞれの投稿一覧
Route::get('/show/{user_id}', [App\Http\Controllers\HomeController::class, 'show'])->name('show');

//体験記の削除
Route::post('/post.delete/{id}', [App\Http\Controllers\HomeController::class, 'postdelete'])->name('post.delete');

//検索フォーム
Route::get('/search', [App\Http\Controllers\HomeController::class, 'search'])->name('search');

//コメント作成
Route::get('/comment/create', [App\Http\Controllers\CommentController::class, 'create'])->name('comment.create');

//コメントの登録
Route::post('/comment/store', [App\Http\Controllers\CommentController::class, 'store'])->name('comment.store');

//コメントの削除
Route::post('/delete/{id}', [App\Http\Controllers\CommentController::class, 'commentdelete'])->name('delete');

//コメントの編集
Route::get('/edit/{id}', [App\Http\Controllers\CommentController::class, 'edit'])->name('edit');

//コメントの更新
Route::post('/update', [App\Http\Controllers\CommentController::class, 'update'])->name('update');

//いいね機能
Route::post('posts/{post}/favorites', [App\Http\Controllers\FavoriteController::class, 'store'])->name('favorites');

//いいねを外す機能
Route::post('posts/{post}/unfavorites', [App\Http\Controllers\FavoriteController::class, 'destroy'])->name('unfavorites');
});