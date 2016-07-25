<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index');



Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);



Route::group(['prefix' =>'admin','namespace'=>'Admin', 'middleware' => ['rolpermiso','auth'],'roles'=>'supervisor','permisos'=>'control-director'],function(){
    Route::resource('ct', 'CentrotrabajoController');
});



Route::group(['middleware' => 'auth'], function(){
    Route::get('home', 'HomeController@index');
    Route::group(['prefix' => 'escuela','namespace' => 'Escuela','middleware'=>'rolpermiso','permisos'=>'control-docente'],function(){
        Route::resource('docentes','DocenteController');
    });

    Route::get('existeDocente','HomeController@exist');  //solicitud AJAX

});





/*
Route::resource('maestros', 'MaestroController');

Route::get('maestros/{id}/delete', [
    'as' => 'maestros.delete',
    'uses' => 'MaestroController@destroy',
]);
*/



Route::resource('escuela/alumnos', 'Escuela\AlumnoController');
