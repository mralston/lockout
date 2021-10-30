<?php

return [
    'max_attempts_user' => env('LOCKOUT_MAX_ATTEMPTS_USER', 10),
    'max_attempts_ip' => env('LOCKOUT_MAX_ATTEMPTS_IP', 20),
    'lockout_duration_user' => env('LOCKOUT_DURATION_USER', null),
    'lockout_duration_ip' => env('LOCKOUT_DURATION_IP', null),
    'error_code' => env('LOCKOUT_ERROR_CODE', '403'),
    'error_message' => env('LOCKOUT_ERROR_MESSAGE', 'Account Locked'),
    'username_field' => env('LOCKOUT_USERNAME_FIELD'),
];
