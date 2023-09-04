<?php

return [
    'client_id'     => env('SALLA_CLIENT_ID'),
    'client_secret' => env('SALLA_CLIENT_SECRET'),
    'urls'          => [
        'merchant_info_url' => env('SALLA_MERCHANT_INFO_URL'),
        'categories_list'   => env('SALLA_LIST_CATEGORIES'),
        'products_list'     => env('SALLA_LIST_PRODUCTS'),
    ],
];
