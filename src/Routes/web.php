<?php

use Illuminate\Support\Facades\Route;

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['web', 'auth'])
    ->namespace('ConfrariaWeb\Acl\Controllers')
    ->group(function () {

        Route::prefix('roles')
            ->name('roles.')
            ->group(function () {
                Route::get('datatable', 'RoleController@datatables')->name('datatables');
        });

        Route::prefix('permissions')
            ->name('permissions.')
            ->group(function () {
                Route::get('datatable', 'PermissionController@datatables')->name('datatables');
        });

        Route::resource('roles', 'RoleController');
        Route::resource('permissions', 'PermissionController');
    
    });
