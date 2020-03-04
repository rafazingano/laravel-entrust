<?php

return [
    'layout' => env('CW_LAYOUT', 'layouts.app'),
    'views' => env('CW_VIEWS', 'entrust::'),

    'user' => 'App\User',
    'users_table' => 'users',
    'user_foreign_key' => 'user_id',

    'role' => 'ConfrariaWeb\Entrust\Models\Role',
    'roles_table' => 'entrust_roles',
    'role_user_table' => 'entrust_role_user',
    'role_foreign_key' => 'role_id',

    'permission' => 'ConfrariaWeb\Entrust\Models\Permission',
    'permissions_table' => 'entrust_permissions',
    'permission_role_table' => 'entrust_permission_role',
    'permission_foreign_key' => 'permission_id',

    'permission' => 'ConfrariaWeb\Entrust\Models\Permission',
    'permissions_table' => 'entrust_permissions',
    'permission_role_table' => 'entrust_permission_role',
    'permission_foreign_key' => 'permission_id',

    'form' => [
        /*
         * Campos adicionais que podemos criar para serem salvos como "settings" no sistema
         */
        'settings' => [
            'color' => [
                'type' => 'color',
                'name' => 'color',
                'placeholder' => 'Cor do perfil',
                'label' => 'Cor do perfil',
            ],
            'icon' => [
                'type' => 'icon',
                'name' => 'icon',
                'placeholder' => 'Icone do perfil',
                'label' => 'Icone do perfil',
            ],
        ]
    ],
];
