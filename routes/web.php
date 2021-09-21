<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Postcontroller;
use App\Http\Controllers\FrontController;

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

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
	'middleware' => 'Mcamara\LaravelLocalization\Middleware\localeSessionRedirect', 'localizationRedirect', 'localeViewPath'
], function()
{
Route::post('ckeditor/image_upload', 'App\Http\Controllers\CKEditorController@upload')->name('upload');
Route::get('', [FrontController::class, 'AllPost'])->name('allposts');
Route::resource('post', Postcontroller::class);

Auth::routes();
Route::get('/search/', 'App\Http\Controllers\FrontController@search')->name('search');
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('single/{id}', [FrontController::class, 'Show'])->name('single');
});
Route::get('/', 'App\Http\Controllers\TestController@index');
Route::post('single/{post}/likes', 'App\Http\Controllers\PostLikesController@store')->name('post.like');
Route::delete('single/{post}/likes', 'App\Http\Controllers\PostLikesController@destroy')->name('post.like');
