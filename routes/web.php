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

Route::get('/', 'HomeController@index')->name('landing');

Route::get('/cikk/{slug}', 'ArticleController@view')->name('view.article');

Auth::routes();


Route::prefix('admin')->middleware('admin')->group(function () {
	Route::get('/', 'Admin\AdminController@index')->name('admin.index');

	Route::get('/cikkek', 'Admin\ArticleController@index')->name('admin.cikkek');

	Route::get('/uj-cikk', 'Admin\ArticleController@create')->name('admin.ujcikk');
	Route::get('/cikk-szerkesztese/{key}', 'Admin\ArticleController@create2')->name('admin.cikk.szerkesztes');
	Route::post('/save-article/{key}', 'Admin\ArticleController@save')->name('admin.save.article');



	Route::post('/cikk/{articleId}/torles', 'Admin\ArticleController@delete')->name('admin.cikk.torles');

	Route::post('/cikk-fenykep/{imgId}/torles', 'Admin\ArticleController@deleteImage')->name('admin.fenykep-torlese');
	
	Route::post('/uploadimages/{key}', 'Admin\ArticleController@uploadimages')->name('admin.upload.images');
	Route::get('/getimages/{key}', 'Admin\ArticleController@getImages')->name('admin.get.images');
	Route::post('/setasthumbnail/{imgId}', 'Admin\ArticleController@setAsThumbnail')->name('admin.set.thumbnail.image');
	Route::post('/setasgallery/{imgId}', 'Admin\ArticleController@setAsGallery')->name('admin.set.gallery.image');

});


Route::get('/ip', function() {
	//dd(Request::ip());
	$ip = '109.122.113.183'; // the IP address to query
	$query = @unserialize(file_get_contents('http://ip-api.com/php/'.$ip));
	dd($query);
	if($query && $query['status'] == 'success') {
	  echo 'Hello visitor from '.$query['country'].', '.$query['city'].'!';
	} else {
	  echo 'Unable to get location';
	}
});


Route::get('/add-visitor/{code}', 'HomeController@addVisitor');