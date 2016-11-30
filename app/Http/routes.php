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

$app->get('hash/{key}', function ($key) {
    return Illuminate\Support\Facades\Hash::make($key);
});

$app->group(['middleware' => 'auth', 'namespace' => 'App\Http\Controllers\v1'], function() use($app) {

    $app->group(['namespace' => 'App\Http\Controllers\v1\Gateway'], function() use($app) {
        $app->get('v1/gateway/employee', 'Employee@index');
        $app->get('v1/gateway/employee/{employeeId}', 'Employee@show');

        $app->get('v1/gateway/media', 'Media@index');
        $app->get('v1/gateway/media/{mediaId}', 'Media@get');
        $app->post('v1/gateway/media/bootgrid', 'Media@bootgrid');
        $app->options('v1/gateway/media/lists', 'Media@lists');

        $app->get('v1/gateway/mediaGroup', 'MediaGroup@index');
        $app->get('v1/gateway/mediaGroup/{mediaGroupId}', 'MediaGroup@get');
        $app->options('v1/gateway/mediaGroup/lists', 'MediaGroup@lists');

        $app->get('v1/gateway/publisher', 'Publisher@index');
        $app->get('v1/gateway/publisher/{publisherId}', 'Publisher@get');
        $app->options('v1/gateway/publisher/lists', 'Publisher@lists');
    });

    $app->group(['namespace' => 'App\Http\Controllers\v1\Region'], function() use($app) {
        $app->get('v1/region/province', 'Province@index');
        $app->post('v1/region/province/lists', 'Province@lists');

        $app->get('v1/region/regency', 'Regency@index');
        $app->options('v1/region/regency/lists', 'Regency@lists');

        $app->get('v1/region/district', 'District@index');
        $app->get('v1/region/district/lists', 'District@lists');

        $app->get('v1/region/village', 'Village@index');
        $app->get('v1/region/village/lists', 'Village@lists');

        $app->get('v1/region/greaterArea', 'GreaterArea@index');
        $app->get('v1/region/greaterArea/{greaterAreaId}', 'GreaterArea@get');
        $app->post('v1/region/greaterArea/bootgrid', 'GreaterArea@bootgrid');
        $app->post('v1/region/greaterArea/store', 'GreaterArea@store');
        $app->patch('v1/region/greaterArea/update/{greaterAreaId}', 'GreaterArea@update');
        $app->delete('v1/region/greaterArea/{greaterAreaId}', 'GreaterArea@destroy');
        $app->options('v1/region/greaterArea/lists', 'GreaterArea@lists');
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
