<?php

return [
    'articleStarterImg' => [
        'displayName' => 'Article Aufmacherbild',
        'transforms' => [
            ['width' => 1920, 'ratio' => 16 / 9, 'device' => 'desktop'],
            ['width' => 1080, 'ratio' => 4 / 5, 'device' => 'mobile'],
        ],
        'defaults' => [
            'format' => 'avif'
        ],
    ],
    'articleImage' => [
        'displayName' => 'Article Image',
        'transforms' => [
            ['width' => 1920, 'device' => 'desktop'],
            ['width' => 1080, 'device' => 'mobile'],
        ],
        'defaults' => [
            'format' => 'avif',
        ],
    ],
    'articleThumb' => [
        'displayName' => 'Article Thumb',
        'transforms' => [
            ['width' => 1920, 'ratio' => 16 / 9, 'device' => 'desktop'],
            ['width' => 1080, 'ratio' => 4 / 5, 'device' => 'mobile'],
        ],
        'defaults' => [
            'format' => 'avif'
        ],
    ],
];
