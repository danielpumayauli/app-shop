<?php

Route::get('/', 'TestController@welcome');
/*
Route::get('/prueba', function () {
    return 'Hola Mundo';
});*/

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/products/{id}', 'ProductController@show');

Route::post('/cart', 'CartDetailController@store');
Route::delete('/cart', 'CartDetailController@destroy');

Route::post('/order', 'CartController@update');

Route::middleware(['auth','admin'])->prefix('admin')->namespace('Admin')->group(function (){

	Route::get('/products', 'ProductController@index'); // Dirige al listado
	Route::get('/products/create', 'ProductController@create'); // Dirige al formulario
	Route::post('/products', 'ProductController@store'); // Registrar formulario
	Route::get('/products/{id}/edit', 'ProductController@edit'); // Dirige al formulario edición y captura id
	Route::post('/products/{id}/edit', 'ProductController@update'); // Actualizar en formulario y captura id
	//Route::post('/products/{id}/delete', 'Admin\ProductController@destroy'); // Formulario para eliminar y captura id
	Route::delete('/products/{id}', 'ProductController@destroy');

	Route::get('/products/{id}/images', 'ImageController@index'); // Listado de imagenes con su formulario
	Route::post('/products/{id}/images', 'ImageController@store'); // Registrar las imagenesdel formulario
	Route::delete('/products/{id}/images', 'ImageController@destroy');
	Route::get('/products/{id}/images/select/{imagen}', 'ImageController@select'); // Destacar
});




// Another verbs: PUT PATCH DELETE