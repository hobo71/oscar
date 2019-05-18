<?php

Route::auth();

Route::get('/', 'MainController@index');
Route::get('vehiculos/slide', 'MainController@slide');


