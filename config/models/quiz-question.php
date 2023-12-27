<?php

return [
    'model'                  => 'QuizQuestion',
    'controller'             => 'QuizQuestionController',
    'route_name'             => 'quiz-questions',
    'route_path'             => 'quiz-questions',
    'route_view'             => 'quiz-questions',
    'permissions'            => [
        'access'             => '',
        'create'             => 'quiz_question_create',
        'show'               => 'quiz_question_show',
        'edit'               => 'quiz_question_edit',
        'delete'             => 'quiz_question_delete',
    ],
    'singular'               => 'quiz_question',
    'plural'                 => 'quiz_questions',
];
