<?php

return [
    'model'                  => 'Quiz',
    'controller'             => 'QuizController',
    'route_name'             => 'quizzes',
    'route_path'             => 'quizzes',
    'route_view'             => 'quizzes',
    'permissions'            => [
        'access'             => 'quiz_access',
        'create'             => '',
        'show'               => 'quiz_show',
        'edit'               => 'quiz_edit',
        'delete'             => '',
    ],
    'singular'               => 'quiz',
    'plural'                 => 'quizzes',
];
