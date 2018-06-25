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
Route::get('/privateposts', ['uses' => 'SitesController@privateposts', 'as' => 'privateposts'])->middleware('auth');
Route::post('/searchingredirect', ['uses' => 'UIcontroller@searchingredirect', 'as' => 'searchingredirect']);
Route::get('/error', ['uses' => 'SitesController@error', 'as' => 'error']);
Route::get('/searchermethod', ['uses' => 'ajaxmethods@searchermethod']);
Route::post('/pollvotemethod', ['uses' => 'ajaxmethods@pollvotemethods']);
Route::post('/editprofile', ['uses' => 'UIcontroller@editprofile', 'as' => 'editprofile']);
Route::post('/changepicture', ['uses' => 'UIcontroller@changepicture', 'as' => 'changepicture']);
Route::get('/myprofile', ['uses' => 'SitesController@myprofile', 'as' => 'myprofile'])->middleware('auth');
Route::post('/reportingmethod', ['uses' => 'UIcontroller@reportingmethod', 'as' => 'reportingmethod']);
Route::post('/report', ['uses' => 'UIcontroller@report', 'as' => 'report']);
Route::post('/postlikingnodislike', ['uses' => 'ajaxmethods@postlikingnodislike']);
Route::post('/postnodisliking', ['uses' => 'ajaxmethods@postnodisliking']);
Route::post('/postdislikeandlike', ['uses' => 'ajaxmethods@postdislikeandlike']);
Route::post('/postdislikenolike', ['uses' => 'ajaxmethods@postdislikenolike']);
Route::post('/postnoliking', ['uses' => 'ajaxmethods@postnoliking']);
Route::post('/postlikinganddislike', ['uses' => 'ajaxmethods@postlikinganddislike']);
Route::post('/nodisliking', ['uses' => 'ajaxmethods@nodisliking']);
Route::post('/dislikeandlike', ['uses' => 'ajaxmethods@dislikeandlike']);
Route::post('/dislikenolike', ['uses' => 'ajaxmethods@dislikenolike']);
Route::post('/noliking', ['uses' => 'ajaxmethods@noliking']);
Route::post('/likinganddislike', ['uses' => 'ajaxmethods@likinganddislike']);
Route::post('/likingnodislike', ['uses' => 'ajaxmethods@likingnodislike']);
Route::post('/addreply', ['uses' => 'UIcontroller@addreply', 'as' => 'addreply']);
Route::get('/category/{category}/{page?}', ['uses' => 'SitesController@category', 'as' => 'category']);
Route::post('/addingpostmethod', ['uses' => 'UIcontroller@addingpostmethod', 'as' => 'addingpostmethod']);
Route::get('/addpost', ['uses' => 'SitesController@addpost', 'as' => 'addpost'])->middleware('auth');
Route::get('/post/{id}/{page?}', ['uses' => 'SitesController@post', 'as' => 'post']);
Auth::routes();
Route::get('/{page?}',['uses' => 'HomeController@index', 'as' => 'home']);
Route::get('/home',function(){
  return redirect('/');
});
