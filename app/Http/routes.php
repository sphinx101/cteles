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
    Route::group(['prefix' => 'escuela','namespace' => 'Escuela','middleware'=>'rolpermiso','permisos'=>['control-director','control-docente','control-alumnos']],function(){
        Route::resource('docentes','DocenteController');
    });

    Route::group(['prefix'=>'escuela','namespace'=>'Escuela','middleware'=>'rolpermiso','roles'=>'director'],function(){
        Route::resource('alumnos', 'AlumnoController');
    });

    Route::group(['prefix'=>'escuela/alumnos/ajax','namespace'=>'Escuela','middleware'=>'rolpermiso','roles'=>['director','docente']],function(){

         Route::get('edicion/{id}','AlumnoController@getAlumnoJson'); //
         Route::patch('edicion/{id}','AlumnoController@updateAjax');
    });

   /* Route::group(['prefix'=>'escuela/alumnos/ajax','namespace'=>'Escuela'],function(){
        Route::patch('edicion/{id}','AlumnoController@updateAjax');
    });*/


    Route::get('existeDocente','HomeController@exist');  //solicitud AJAX

});




/*
Route::resource('maestros', 'MaestroController');

Route::get('maestros/{id}/delete', [
    'as' => 'maestros.delete',
    'uses' => 'MaestroController@destroy',
]);
*/



//Route::resource('escuela/alumnos', 'Escuela\AlumnoController');
