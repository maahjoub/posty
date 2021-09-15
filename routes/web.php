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

Route::get('set-locale/{locale}', function ($locale) {
    App::setLocale($locale);
    session()->put('locale', $locale);
    return redirect()->back();
})->middleware('localeViewPath')->name('locale.setting');

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
	'middleware' => 'Mcamara\LaravelLocalization\Middleware\localeSessionRedirect', 'localizationRedirect', 'localeViewPath'
], function()
{
Route::get('/post', function () {
    return view('posty.index');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});
