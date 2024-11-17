<?php

return [
    'server_key' => env('MIDTRANS_SERVER_KEY'),
    'client_key' => env('MIDTRANS_CLIENT_KEY'),
    'merchant_id' => env('MIDTRANS_MERCHANT_ID'),
    'is_production' => env('MIDTRANS_IS_PRODUCTION', false),
    'url' => env('MIDTRANS_URL', 'https://api.sandbox.midtrans.com'),
    'is_sanitized' => true,
    'is_3ds' => true,
];
