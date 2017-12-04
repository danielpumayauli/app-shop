<?php

Route::get('/', 'TestController@welcome');
/*
Route::get('/prueba', function () {
    return 'Hola Mundo';
});*/

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin/products', 'ProductController@index'); // Listado
Route::get('/admin/products/create', 'ProductController@create'); // Crear
Route::post('/admin/products', 'ProductController@store'); // Crear