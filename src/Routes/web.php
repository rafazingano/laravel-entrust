<?php

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['web', 'auth'])
    ->namespace('ConfrariaWeb\Entrust\Controllers')
    ->group(function () {

        /*
        Route::prefix('roles')
            ->name('roles.')
            ->group(function () {


            });
        */
        Route::resource('roles', 'RoleController');

    });
