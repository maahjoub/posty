<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Postcontroller;

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
Route::get('', function () {  return view('posty.all'); })->name('posts');
Route::resource('post', Postcontroller::class);

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
});
