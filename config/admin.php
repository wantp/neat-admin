<?php

return [
    'root' => app_path('Modules/Admin'),

    'database' => [
        'connection' => '',

        'tables' => [
            'users' => 'neat_users',
            'roles' => 'neat_roles',
            'permissions' => 'neat_permissions',
            'permission_groups' => 'neat_permission_groups',
            'menus' => 'neat_menus',
            'role_user' => 'neat_role_user',
            'role_permission' => 'neat_role_permission',
            'role_menu' => 'neat_role_menu',
        ]
    ],

    'route' => [
        'prefix' => 'api/admin',
    ],

    'filesystem' => [
        'disk' => 'public',
        'path' => 'admin',
    ]

];