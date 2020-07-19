<?php

use App\Gallery;
use App\Http\Controllers\GalleryController;
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
Auth::routes();
Route::get('/', function () { return view('welcome'); });
Route::get('/home', 'HomeController@index')->name('home');


Route::get('/profile', 'ProfileController@index')->name('profile');
Route::post('profile', 'ProfileController@update')->name('profile.update');

Route::get('/gallery', 'GalleryController@index')->name('gallery');
Route::post('/gallery','GalleryController@store')->name('gallery.upload');
Route::delete('/gallery/{id}','GalleryController@delete')->name('gallery.delete');
Route::delete('/gallery', 'GalleryController@bulkdelete')->name('gallery.bulkdelete');



