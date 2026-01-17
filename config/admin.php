<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Admin Panel Configuration
    |--------------------------------------------------------------------------
    */

    'name' => 'Muxsol Admin',
    'prefix' => 'admin',
    'middleware' => ['web', 'auth', 'admin'],

    'dashboard' => [
        'widgets' => [
            'stats' => true,
            'recent_activity' => true,
            'quick_actions' => true,
            'analytics_chart' => true,
        ],
    ],

    'pagination' => [
        'per_page' => 15,
        'per_page_options' => [10, 15, 25, 50, 100],
    ],

    'uploads' => [
        'max_size' => 10240, // KB
        'allowed_types' => [
            'image' => ['jpg', 'jpeg', 'png', 'gif', 'svg', 'webp'],
            'document' => ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx'],
            'video' => ['mp4', 'webm', 'ogg'],
            'audio' => ['mp3', 'wav', 'ogg'],
        ],
        'image_optimization' => true,
        'image_quality' => 80,
    ],

    'security' => [
        'max_login_attempts' => 5,
        'lockout_duration' => 15, // minutes
        'password_min_length' => 8,
        'require_uppercase' => true,
        'require_number' => true,
        'require_special_char' => false,
        'session_timeout' => 120, // minutes
    ],

    'backup' => [
        'enabled' => true,
        'auto_backup' => false,
        'frequency' => 'daily', // daily, weekly, monthly
        'retention' => 7, // days
        'disk' => 'local',
    ],
];
