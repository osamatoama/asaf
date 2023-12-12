<?php

return [
    'model'                  => 'Client',
    'controller'             => 'ClientController',
    'route_name'             => 'clients',
    'route_path'             => 'clients',
    'route_view'             => 'clients',
    'permissions'            => [
        'access'             => 'client_access',
        'create'             => '',
        'show'               => 'client_show',
        'edit'               => '',
        'delete'             => '',
    ],
    'singular'               => 'client',
    'plural'                 => 'clients',
];
