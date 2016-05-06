<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::group(['middleware' => ['web']], function () {
    // your routes here

Route::get('/', 'MainpagesController@index');
Route::get('/show/{page}', 'PagesController@index');
//Route::get('timeline', 'PagesController@timeline')->name('timeline');
//Route::get('contacts', 'PagesController@contacts')->name('contacts');
	

Route::resource('items', 'ItemsController');
Route::get('collections/items/{id}', 'CollectionsController@items')->name('collections.items');

Route::resource('collections', 'CollectionsController');

Route::group(['prefix' => 'admin'], function () 
{
	Route::get('/', 'CollectionController@index');

	Route::resource('collection', 'CollectionController');

	Route::resource('item', 'ItemController');
	
	Route::post('main-page/ajax', 'MainpageController@ajax')->name('admin.main-page.ajax');

	Route::resource('main-page', 'MainpageController');

	Route::post('page-manager/ajax', 'PageManagerController@ajax')->name('admin.page-manager.ajax');

	Route::resource('page-manager', 'PageManagerController');

});

Route::get('images/{path}', function(League\Glide\Server $server, $path){
	//dd($server);
	$server->outputImage($path, $_GET);
});

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

});