<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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
Route::get('/post', function () {
    return view('posty.index');
})->name('posts');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
});
