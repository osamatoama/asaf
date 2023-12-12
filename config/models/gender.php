<?php

return [
    'model'                  => 'Gender',
    'controller'             => 'GenderController',
    'route_name'             => 'genders',
    'route_path'             => 'genders',
    'route_view'             => 'genders',
    'permissions'            => [
        'access'             => 'gender_access',
        'create'             => '',
        'show'               => 'gender_show',
        'edit'               => '',
        'delete'             => '',
    ],
    'singular'               => 'gender',
    'plural'                 => 'genders',
];
