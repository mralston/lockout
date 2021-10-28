<?php

return [
    'max_attempts_user' => env('MAX_LOGIN_ATTEMPTS_USER', 10),
    'max_attempts_ip' => env('MAX_LOGIN_ATTEMPTS_IP', 20),
    'lockout_duration_user' => env('LOCKOUT_DURATION_USER', null),
    'lockout_duration_ip' => env('LOCKOUT_DURATION_IP', null),
];
