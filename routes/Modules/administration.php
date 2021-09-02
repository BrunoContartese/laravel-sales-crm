<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'administration', 'middleware' => 'auth:api'], function () {
    Route::apiResource('users', 'App\Http\Controllers\Administration\UsersController');
    Route::get('users/paginated/index', 'App\Http\Controllers\Administration\UsersController@paginated');
    Route::post('users/{user}/restore', 'App\Http\Controllers\Administration\UsersController@restore');

    Route::apiResource('roles', 'App\Http\Controllers\Administration\RolesController');
    Route::get('roles/paginated/index/{query?}', 'App\Http\Controllers\Administration\RolesController@paginated');
    Route::post('roles/{role}/syncPermissions', 'App\Http\Controllers\Administration\RolesController@syncPermissions');

    Route::get('permissions', 'App\Http\Controllers\Administration\PermissionsController@index');

    Route::post('files', 'App\Http\Controllers\Administration\FilesController@store');

    Route::apiResource('fiscalRoles', 'App\Http\Controllers\Administration\FiscalRolesController')->except(['store', 'update', 'destroy']);
    Route::get('fiscalRoles/paginated/index', 'App\Http\Controllers\Administration\FiscalRolesController@paginated');

    Route::apiResource('companies', 'App\Http\Controllers\Administration\CompaniesController')->except(['store', 'destroy']);
    Route::get('companies/paginated/index', 'App\Http\Controllers\Administration\CompaniesController@paginated');

    Route::apiResource('branchOffices', 'App\Http\Controllers\Administration\BranchOfficesController');
    Route::get('branchOffices/paginated/index', 'App\Http\Controllers\Administration\BranchOfficesController@paginated');
    Route::post('branchOffices/{branchOffice}/restore', 'App\Http\Controllers\Administration\BranchOfficesController@restore');

    Route::apiResource('documentTypes', 'App\Http\Controllers\Administration\DocumentTypesController')->only(['index']);
    Route::get('documentTypes/paginated/index', 'App\Http\Controllers\Administration\DocumentTypesController@paginated');

    Route::apiResource('sellers', 'App\Http\Controllers\Administration\SellersController');
    Route::get('sellers/paginated/index', 'App\Http\Controllers\Administration\SellersController@paginated');
    Route::post('sellers/{seller}/restore', 'App\Http\Controllers\Administration\SellersController@restore');

    Route::apiResource('deliveryZones', 'App\Http\Controllers\Administration\DeliveryZonesController');
    Route::get('deliveryZones/paginated/index', 'App\Http\Controllers\Administration\DeliveryZonesController@paginated');
    Route::post('deliveryZones/{deliveryZone}/restore', 'App\Http\Controllers\Administration\DeliveryZonesController@restore');

    Route::apiResource('customers', 'App\Http\Controllers\Administration\CustomersController');
    Route::get('customers/paginated/index', 'App\Http\Controllers\Administration\CustomersController@paginated');
    Route::post('customers/{deliveryZone}/restore', 'App\Http\Controllers\Administration\CustomersController@restore');


});
