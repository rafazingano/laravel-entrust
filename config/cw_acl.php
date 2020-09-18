<?php

return [
    'layout' => env('CW_LAYOUT', 'layouts.app'),
    'views' => env('CW_VIEWS', 'acl::'),

    'administrator' => [
        'emails' => ['rafazingano@gmail.com', '54545455no@gmail.com'],
    ],

    'user' => 'App\Models\User',
    'users_table' => 'users',

    'role' => 'ConfrariaWeb\Acl\Models\Role',
    'roles_table' => 'acl_roles',
    'role_user_table' => 'acl_role_user',
    'role_foreign_key' => 'role_id',
    'user_foreign_key' => 'user_id',

    'permission' => 'ConfrariaWeb\Acl\Models\Permission',
    'permissions_table' => 'acl_permissions',
    'permission_role_table' => 'acl_permission_role',
    'permission_foreign_key' => 'permission_id',
];
