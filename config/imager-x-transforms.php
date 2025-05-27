<?php

return [
    'articleStarterImg' => [
        'displayName' => 'Article Aufmacherbild',
        'transforms' => [
            ['width' => 1920, 'ratio' => 16 / 9],
            ['width' => 1080, 'ratio' => 4 / 5],
        ],
        'defaults' => [
            'format' => 'avif'
        ],
    ],
    'articleImage' => [
        'displayName' => 'Article Image',
        'transforms' => [
            ['width' => 1920],
            ['width' => 1080],
        ],
        'defaults' => [
            'format' => 'avif'
        ],
    ],
    'articleThumb' => [
        'displayName' => 'Article Thumb',
        'transforms' => [
            ['width' => 1920, 'ratio' => 1 / 1],
            ['width' => 1080, 'ratio' => 1 / 1],
        ],
        'defaults' => [
            'format' => 'avif'
        ],
    ],
];
