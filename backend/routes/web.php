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

$router->group(['prefix' => 'v1'], function () use ($router) {

    $router->get('/persons', 'PersonController@index');
    $router->get('/persons/{id}', 'PersonController@show');
    $router->post('/persons', 'PersonController@store');
    $router->put('/persons/{id}', 'PersonController@update');
    $router->delete('/persons/{id}', 'PersonController@destroy');

    $router->get('/contact', 'PersonContactController@index');
    $router->get('/contact/{id}', 'PersonContactController@show');
    $router->post('/contact', 'PersonContactController@store');
    $router->put('/contact/{id}', 'PersonContactController@update');
    $router->delete('/contact/{id}', 'PersonContactController@destroy');

});

