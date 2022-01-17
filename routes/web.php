<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;

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
    return view('home');
})->name('home');

Route::view('/about', 'about')->name('about');

Route::resource('portfolio', 'App\Http\Controllers\ProductController')
->names('products')
->parameters(['portfolio' => 'product'])->middleware(['auth', 'verified', 'auth.isAdmin']);

Route::view('/contact', 'contact')->name('contact')->middleware(['auth', 'verified']);

Route::post('/contact', 'App\Http\Controllers\MessageController@store')->name('messages.store');

Route::prefix('admin')->middleware(['auth', 'verified', 'auth.isAdmin' ])->name('admin.')->group(function () {
    Route::resource('/users', 'App\Http\Controllers\Admin\UserController');
});
