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

$app->get('hash/{key}', function ($key) use($app) {
    return Illuminate\Support\Facades\Hash::make($key);
});

$app->group(['middleware' => 'auth', 'prefix' => 'v1', 'namespace' => 'App\Http\Controllers\v1'], function() use($app) {

    $app->group(['namespace' => 'App\Http\Controllers\v1\Gateway'], function() use($app) {
        $app->get('v1/gateway/employee', 'Employee@index');
        $app->get('v1/gateway/employee/{employee}', 'Employee@show');
    });

    $app->group(['namespace' => 'App\Http\Controllers\v1\Region'], function() use($app) {
        $app->get('v1/region/province', 'Province@index');
        $app->get('v1/region/regency', 'Regency@index');
        $app->get('v1/region/district', 'District@index');
        $app->get('v1/region/village', 'Village@index');
        $app->get('v1/region/greaterArea', 'GreaterArea@index');
    });

    $app->group(['namespace' => 'App\Http\Controllers\v1\Vehicle'], function() use($app) {
        $app->get('v1/vehicle/brand', 'Brand@index');
        $app->post('v1/vehicle/brand/lists', 'Brand@lists');
        $app->post('v1/vehicle/brand/bootgrid', 'Brand@bootgrid');

        $app->get('v1/vehicle/classification', 'Classification@index');
        $app->post('v1/vehicle/classification/lists', 'Classification@lists');
        $app->post('v1/vehicle/classification/bootgrid', 'Classification@bootgrid');

        $app->get('v1/vehicle/series', 'Series@index');
        $app->post('v1/vehicle/series/lists', 'Series@lists');
        $app->post('v1/vehicle/series/bootgrid', 'Series@bootgrid');

        $app->get('v1/vehicle/type', 'Type@index');
        $app->post('v1/vehicle/type/lists', 'Type@lists');
        $app->post('v1/vehicle/type/bootgrid', 'Type@bootgrid');

        $app->get('v1/vehicle/vehicle', 'Vehicle@index');
        $app->post('v1/vehicle/vehicle/lists', 'Vehicle@lists');
        $app->post('v1/vehicle/vehicle/bootgrid', 'Vehicle@bootgrid');
    });
});
