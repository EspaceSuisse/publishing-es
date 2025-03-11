<?php

return [
    'articleImage' => [
        'displayName' => 'Article Image',
        'transforms' => [
            ['width' => 1920, 'ratio' => 16/10],
            ['width' => 1080, 'ratio' => 4/5],
        ],
        'defaults' => [
            'format' => 'avif'
        ],
    ],
];
