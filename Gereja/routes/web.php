<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

// $router->group(['middleware' => 'web'], function () use ($router) { 
    
// });
$router->group(['prefix'=>'auth', 'middleware'=>['cors']], function() use ($router){
    $router->get('google', ['uses'=>'GoogleLoginController@redirectToGoogle']);
    $router->get('google/callback', ['uses'=>'GoogleLoginController@handleGoogleCallback']);
});


$router->post('api/login', 'UserLoginController@loginManual');
$router->get('api/google', 'UserLoginController@loginGoogle');
$router->get('api/google/callback', 'UserLoginController@handleGoogle');

$router->get('api/firebase', 'FirebaseController@readFromFirestore');
$router->put('api/firebase/{id}', 'FirebaseController@update');



$router->group(['prefix'=>'api', 'middleware'=>['cors']], function() use ($router){
    $router->get('user/{id}',['uses'=>'CRUDController@show']);
    $router->get('ibadah',['uses'=>'CRUD_Ibadah@index']);
    $router->get('ibadah/{id}',['uses'=>'CRUD_Ibadah@show']);
    $router->get('kegiatan',['uses'=>'CRUD_Kegiatan@index']);
    $router->get('kegiatan/{id}',['uses'=>'CRUD_Kegiatan@show']);
    $router->get('doa',['uses'=>'CRUD_Doa@index']);
    $router->get('doa/{id}',['uses'=>'CRUD_Doa@show']);
    $router->get('renungan',['uses'=>'CRUD_Renungan@index']);
    $router->get('renungan/{id}',['uses'=>'CRUD_Renungan@show']);
});

$router->group(['prefix'=>'api', 'middleware'=>['auth','cors']], function() use ($router){
    $router->get('user',['uses'=>'CRUDController@index']);
    $router->post('user',['uses'=>'CRUDController@create']);
    $router->delete('user/{id}',['uses'=>'CRUDController@destroy']);
    $router->put('user/{id}',['uses'=>'CRUDController@update']);
    $router->put('ibadah/{id}',['uses'=>'CRUD_Ibadah@update']);
    $router->delete('ibadah/{id}',['uses'=>'CRUD_Ibadah@destroy']);
    $router->post('ibadah',['uses'=>'CRUD_Ibadah@create']);
    $router->post('kegiatan',['uses'=>'CRUD_Kegiatan@create']);
    $router->put('kegiatan/{id}',['uses'=>'CRUD_Kegiatan@update']);
    $router->delete('kegiatan/{id}',['uses'=>'CRUD_Kegiatan@destroy']);
    $router->post('doa',['uses'=>'CRUD_Doa@create']);
    $router->put('doa/{id}',['uses'=>'CRUD_Doa@update']);
    $router->delete('doa/{id}',['uses'=>'CRUD_Doa@destroy']);
    $router->post('renungan',['uses'=>'CRUD_Renungan@create']);
    $router->put('renungan/{id}',['uses'=>'CRUD_Renungan@update']);
    $router->delete('renungan/{id}',['uses'=>'CRUD_Renungan@destroy']);
});




