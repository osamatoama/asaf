<?php

return [
    'model'                  => 'Product',
    'controller'             => 'ProductController',
    'route_name'             => 'products',
    'route_path'             => 'products',
    'route_view'             => 'products',
    'permissions'            => [
        'access'             => 'product_access',
        'create'             => 'product_create',
        'show'               => 'product_show',
        'edit'               => 'product_edit',
        'delete'             => 'product_delete',
    ],
    'singular'               => 'product',
    'plural'                 => 'products',
];
