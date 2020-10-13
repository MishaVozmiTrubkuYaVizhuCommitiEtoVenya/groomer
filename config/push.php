<?php

return [
    'apple' => [
        'key_id' => 'AAAABBBBCC', // The Key ID obtained from Apple developer account
        'team_id' => 'DDDDEEEEFF', // The Team ID obtained from Apple developer account
        'app_bundle_id' => 'com.app.Test', // The bundle ID for app obtained from Apple developer account
        'private_key_path' => __DIR__ . '/private_key.p8', // Path to private key
        'private_key_secret' => null // Private key secret
    ],
    'android' => []
];
