<?php

return [
    'model'             => 'Role',
    'controller'        => 'RoleController',
    'route_name'        => 'roles',
    'route_path'        => 'roles',
    'route_view'        => 'roles',
    'permissions'       => [
        'access'        => 'role_access',
        'create'        => 'role_create',
        'show'          => 'role_show',
        'edit'          => 'role_edit',
        'delete'        => 'role_delete',
    ],
    'singular'          => 'role',
    'plural'            => 'roles',
];
