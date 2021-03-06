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


});
