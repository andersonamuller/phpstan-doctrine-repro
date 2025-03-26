<?php

declare(strict_types=1);


return (static fn() => [
    'parameters' => [
        'bootstrapFiles' => [
            __DIR__ . '/vendor/autoload.php',
        ],
        'level' => 'max',
        'paths' => [
            __DIR__ . '/src',
            __DIR__ . '/bootstrap.php',
        ],
    ],
])();
