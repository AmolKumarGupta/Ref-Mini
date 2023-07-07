<?php

use App\Models\User;

return [
    "icon" => [
        "default" => "fa fa-bell",
        User::class => 'fa fa-user',
    ],

    'color' => [
        "default" => "success",
        User::class => 'info',
    ]
];