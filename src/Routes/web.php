<?php

use Illuminate\Support\Facades\Route;

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['web', 'auth'])
    ->namespace('ConfrariaWeb\Entrust\Controllers')
    ->group(function () {

        Route::resource('roles', 'RoleController');

    });
