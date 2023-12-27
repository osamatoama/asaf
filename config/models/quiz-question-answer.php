<?php

return [
    'model'                  => 'QuizQuestionAnswer',
    'controller'             => 'QuizQuestionAnswerController',
    'route_name'             => 'quiz-question-answers',
    'route_path'             => 'quiz-question-answers',
    'route_view'             => 'quiz-question-answers',
    'permissions'            => [
        'access'             => '',
        'create'             => 'quiz_question_create',
        'show'               => 'quiz_question_show',
        'edit'               => 'quiz_question_edit',
        'delete'             => 'quiz_question_delete',
    ],
    'singular'               => 'quiz_question_answer',
    'plural'                 => 'quiz_question_answers',
];
