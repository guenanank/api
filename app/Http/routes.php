<?php

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

$app->get('/', function () use($app) {
    return $app->version();
});

$app->group(['prefix' => 'v1'], function() use($app) {

    $app->group(['prefix' => 'gateway', 'namespace' => 'App\Http\Controllers\Gateway'], function() use($app) {
        $app->get('employee', 'Employee@index');
        $app->get('employee/{employee}', 'Employee@show');
    });

    $app->group(['prefix' => 'region', 'namespace' => 'App\Http\Controllers\Region'], function() use($app) {

        $app->get('province', 'Province@index');
        $app->get('regency', 'Regency@index');
        $app->get('district', 'District@index');
        $app->get('village', 'Village@index');
        $app->get('greaterArea', 'GreaterArea@index');
    });

    $app->group(['prefix' => 'vehicle', 'namespace' => 'App\Http\Controllers\Vehicle'], function() use($app) {

        $app->get('brand', 'Brand@index');
        $app->post('brand/lists', 'Brand@lists');
        $app->post('brand/bootgrid', 'Brand@bootgrid');

        $app->get('classification', 'Classification@index');
        $app->post('classification/lists', 'Classification@lists');
        $app->post('classification/bootgrid', 'Classification@bootgrid');

        $app->get('series', 'Series@index');
        $app->post('series/lists', 'Series@lists');
        $app->post('series/bootgrid', 'Series@bootgrid');

        $app->get('type', 'Type@index');
        $app->post('type/lists', 'Type@lists');
        $app->post('type/bootgrid', 'Type@bootgrid');

        $app->get('vehicle', 'Vehicle@index');
        $app->post('vehicle/lists', 'Vehicle@lists');
        $app->post('vehicle/bootgrid', 'Vehicle@bootgrid');
    });
});
