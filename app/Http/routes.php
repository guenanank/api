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

$app->get('token/{key}', function ($key) {
    return Illuminate\Support\Facades\Crypt::encrypt($key);
});

$app->get('password/{key}', function ($key) {
    return Illuminate\Support\Facades\Hash::make($key);
});

$app->group(['middleware' => 'auth', 'namespace' => 'App\Http\Controllers\v1'], function() use($app) {

    $app->group(['namespace' => 'App\Http\Controllers\v1\Gateway'], function() use($app) {
        $app->get('v1/gateway/employee', 'Employee@index');
        $app->get('v1/gateway/employee/{employeeId}', 'Employee@show');

        $app->get('v1/gateway/mediaHowToGet', 'MediaHowToGet@index');
        $app->get('v1/gateway/mediaHowToGet/{mediaHowToGetId}', 'MediaHowToGet@get');
        $app->options('v1/gateway/mediaHowToGet/lists', 'MediaHowToGet@lists');
        
        $app->get('v1/gateway/mediaCategory', 'MediaCategory@index');
        $app->get('v1/gateway/mediaCategory/{mediaCategoryId}', 'MediaCategory@get');
        $app->options('v1/gateway/mediaCategory/lists', 'MediaCategory@lists');
        
        $app->get('v1/gateway/media', 'Media@index');
        $app->get('v1/gateway/media/{mediaId}', 'Media@get');
        $app->options('v1/gateway/media/lists', 'Media@lists');
        $app->options('v1/gateway/media/internal/print/lists', 'Media@internalPrintLists');
        $app->options('v1/gateway/media/internal/digital/lists', 'Media@internalDigitalLists');

        $app->get('v1/gateway/mediaGroup', 'MediaGroup@index');
        $app->get('v1/gateway/mediaGroup/{mediaGroupId}', 'MediaGroup@get');
        $app->options('v1/gateway/mediaGroup/lists', 'MediaGroup@lists');

        $app->get('v1/gateway/publisher', 'Publisher@index');
        $app->get('v1/gateway/publisher/{publisherId}', 'Publisher@get');
        $app->options('v1/gateway/publisher/lists', 'Publisher@lists');
        
        $app->get('v1/gateway/product', 'Product@index');
        $app->options('v1/gateway/product/print', 'Product@listsPrint');
        $app->options('v1/gateway/product/digital', 'Product@listsDigital');
    });

    $app->group(['namespace' => 'App\Http\Controllers\v1\Region'], function() use($app) {
        $app->get('v1/region/province', 'Province@index');
        $app->get('v1/region/province/{provinceId}', 'Province@get');
        $app->options('v1/region/province/lists', 'Province@lists');

        $app->get('v1/region/regency', 'Regency@index');
        $app->get('v1/region/regency/{regencyId}', 'Regency@get');
        $app->options('v1/region/regency/lists', 'Regency@lists');
        $app->get('v1/region/regency/province/{provinceId}', 'Regency@getByProvince');

        $app->get('v1/region/district', 'District@index');
        $app->get('v1/region/district/{districtId}', 'District@get');
        $app->options('v1/region/district/lists', 'District@lists');
        $app->get('v1/region/district/regency/{regencyId}', 'District@getByRegency');

        $app->get('v1/region/village', 'Village@index');
        $app->get('v1/region/village/{villageId}', 'Village@get');
        $app->options('v1/region/village/lists', 'Village@lists');
        $app->get('v1/region/village/district/{districtId}', 'Village@getByDistrict');

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
        $app->get('v1/vehicle/brand/{brandId}', 'Brand@get');
        $app->options('v1/vehicle/brand/lists', 'Brand@lists');
        $app->post('v1/vehicle/brand/bootgrid', 'Brand@bootgrid');
        $app->post('v1/vehicle/brand/store', 'Brand@store');
        $app->patch('v1/vehicle/brand/update/{brandId}', 'Brand@update');
        $app->delete('v1/vehicle/brand/{brnadiId}', 'Brand@destroy');

        $app->get('v1/vehicle/classification', 'Classification@index');
        $app->get('v1/vehicle/classification/{classificationId}', 'Classification@get');
        $app->options('v1/vehicle/classification/lists', 'Classification@lists');
        $app->post('v1/vehicle/classification/bootgrid', 'Classification@bootgrid');
        $app->post('v1/vehicle/classification/store', 'Classification@store');
        $app->patch('v1/vehicle/classification/update/{classificationId}', 'Classification@update');
        $app->delete('v1/vehicle/classification/{classificationId}', 'Classification@destroy');

        $app->get('v1/vehicle/series', 'Series@index');
        $app->get('v1/vehicle/series/{seriesId}', 'Series@get');
        $app->options('v1/vehicle/series/lists', 'Series@lists');
        $app->post('v1/vehicle/series/bootgrid', 'Series@bootgrid');
        $app->post('v1/vehicle/series/store', 'Series@store');
        $app->patch('v1/vehicle/series/update/{seriesId}', 'Series@update');
        $app->delete('v1/vehicle/series/{seriesId}', 'Series@destroy');

        $app->get('v1/vehicle/type', 'Type@index');
        $app->get('v1/vehicle/type/{typeId}', 'Type@get');
        $app->options('v1/vehicle/type/lists', 'Type@lists');
        $app->post('v1/vehicle/type/bootgrid', 'Type@bootgrid');
        $app->post('v1/vehicle/type/store', 'Type@store');
        $app->patch('v1/vehicle/type/update/{typeId}', 'Type@update');
        $app->delete('v1/vehicle/type/{typeId}', 'Type@destroy');

        $app->get('v1/vehicle/vehicle', 'Vehicle@index');
        $app->get('v1/vehicle/vehicle/{vehicleId}', 'Vehicle@get');
        $app->options('v1/vehicle/vehicle/lists', 'Vehicle@lists');
        $app->options('v1/vehicle/vehicle/lists/gmc', 'Vehicle@listsGMC');
        $app->post('v1/vehicle/vehicle/bootgrid', 'Vehicle@bootgrid');
    });
});
