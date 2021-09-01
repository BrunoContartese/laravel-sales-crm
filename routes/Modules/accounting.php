<?php
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'accounting', 'middleware' => 'auth:api'], function() {
    Route::apiResource('priceLists', 'App\Http\Controllers\Accounting\PriceListsController');
    Route::get('priceLists/paginated/index', 'App\Http\Controllers\Accounting\PriceListsController@paginated');
    Route::post('priceLists/{user}/restore', 'App\Http\Controllers\Accounting\PriceListsController@restore');
});
