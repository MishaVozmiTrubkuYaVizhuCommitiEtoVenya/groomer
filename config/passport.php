<?php

return [
    "master" => [
        "secret" => env("PASSPORT_MASTER_SECRET"),
    ],
    "client" => [
        "secret" => env("PASSPORT_CLIENT_SECRET"),
    ],
];
