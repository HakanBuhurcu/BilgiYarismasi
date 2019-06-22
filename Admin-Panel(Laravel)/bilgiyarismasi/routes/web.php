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
    return view('auth/login');
});

Route::get('/SoruEkle', 'IslemController@get_SoruEkle');
Route::post('/SoruEkle', 'IslemController@post_SoruEkle');
Route::get('/Sorular/{kontrolDegeri}', 'IslemController@get_Sorular');
Route::post('/Sorular/{kontrolDegeri}', 'IslemController@post_Sorular');
Route::get('/SoruDuzenle/{soruno}', 'IslemController@get_SoruDuzenle');
Route::post('/SoruDuzenle/{soruno}', 'IslemController@post_SoruDuzenle');

Route::get('/SezonIslemleri','IslemController@get_SezonIslemleri');
Route::post('/SezonIslemleri','IslemController@post_Sezon');

Route::get('/Oduller', 'IslemController@get_Oduller');
Route::post('/Oduller', 'IslemController@post_Oduller');

Route::get('/Profil', 'IslemController@get_Profil');
Route::post('/Profil', 'IslemController@post_Profil');

Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');

