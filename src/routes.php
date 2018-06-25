<?php 

Route::get('laravel/docs/', 'ChungNT\LaravelDocs\LaravelDocsController@index');
Route::get('laravel/docs/{page}', 'ChungNT\LaravelDocs\LaravelDocsController@page');