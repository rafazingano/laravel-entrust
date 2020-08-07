<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth:api'])
    ->name('api.')
    ->prefix('api')
    ->group(function () {
        Route::name('entrusts.')
            ->prefix('entrusts')
            ->namespace('ConfrariaWeb\Entrust\Controllers')
            ->group(function () {

                Route::name('roles.')
                    ->prefix('roles')
                    ->group(function () {
                        Route::get('datatable', 'RoleController@datatable')->name('datatable');
                        Route::get('select2', 'RoleController@select2')->name('select2');
                    });
/*
                Route::name('permissions.')
                    ->prefix('permissions')
                    ->group(function () {
                        Route::get('datatable', 'PermissionController@datatable')->name('datatable');
                        Route::get('select2', 'PermissionController@select2')->name('select2');
                    });
*/

            });
    });
