<?php

return [
    'layout' => env('CW_LAYOUT', 'layouts.app'),
    'views' => env('CW_VIEWS', 'entrust::'),

    'administrator' => [
        'emails' => ['rafazingano@gmail.com', '54545455no@gmail.com'],
    ],

    'user' => 'App\User',
    'users_table' => 'users',

    'role' => 'ConfrariaWeb\Entrust\Models\Role',
    'roles_table' => 'entrust_roles',
    'role_user_table' => 'entrust_role_user',
    'role_foreign_key' => 'role_id',
    'user_foreign_key' => 'user_id',

    'permission' => 'ConfrariaWeb\Entrust\Models\Permission',
    'permissions_table' => 'entrust_permissions',
    'permission_role_table' => 'entrust_permission_role',
    'permission_foreign_key' => 'permission_id',
];
