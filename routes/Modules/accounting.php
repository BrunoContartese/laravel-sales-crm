<?php
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'accounting', 'middleware' => 'auth:api'], function() {

    Route::apiResource('tributes', 'App\Http\Controllers\Accounting\TributesController');
    Route::get('tributes/paginated/index', 'App\Http\Controllers\Accounting\TributesController@paginated');
    Route::post('tributes/{tribute}/restore', 'App\Http\Controllers\Accounting\TributesController@restore');

    Route::apiResource('tributeAliquots', 'App\Http\Controllers\Accounting\TributeAliquotsController');
    Route::get('tributeAliquots/paginated/index', 'App\Http\Controllers\Accounting\TributeAliquotsController@paginated');
    Route::post('tributeAliquots/{tribute}/restore', 'App\Http\Controllers\Accounting\TributeAliquotsController@restore');

    Route::apiResource('priceLists', 'App\Http\Controllers\Accounting\PriceListsController');
    Route::get('priceLists/paginated/index', 'App\Http\Controllers\Accounting\PriceListsController@paginated');
    Route::post('priceLists/{priceList}/restore', 'App\Http\Controllers\Accounting\PriceListsController@restore');
});
