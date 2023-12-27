<?php

return [
    'model'             => 'User',
    'controller'        => 'UserController',
    'route_name'        => 'users',
    'route_path'        => 'users',
    'route_view'        => 'users',
    'permissions'       => [
        'access'        => 'user_access',
        'create'        => 'user_create',
        'show'          => 'user_show',
        'edit'          => 'user_edit',
        'delete'        => 'user_delete',
    ],
    'singular'          => 'user',
    'plural'            => 'users',
];
