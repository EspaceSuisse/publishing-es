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
    'feedImageTransform' => [
        'displayName' => 'Feed Image',
        'transforms' => [
            ['width' => 1920, 'ratio' => 16 / 9],
        ],
        'defaults' => [
            'format' => 'avif',
        ],
    ],
    'authorPortrait' => [
        'displayName' => 'Author Portrait',
        'transforms' => [
            ['width' => 100, 'ratio' => 1 / 1],
        ],
        'defaults' => [
            'format' => 'avif',
        ],
    ],
    'articleImageLightbox' => [
        'displayName' => 'Article Image Lightbox',
        'transforms' => [
            ['width' => 1920,],
        ],
        'defaults' => [
            'format' => 'avif',
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
            ['width' => 1080, 'ratio' => 4 / 5, 'device' => 'tablet'],
            ['width' => 1080, 'ratio' => 1 / 1, 'device' => 'mobile'],
        ],
        'defaults' => [
            'format' => 'avif'
        ],
    ],
    'articlePreviewXLThumb' => [
        'displayName' => 'Article Preview XL Thumb',
        'transforms' => [
            ['width' => 1920, 'ratio' => 4 / 5 , 'device' => 'desktop'],
            ['width' => 1080, 'ratio' => 4 / 5, 'device' => 'mobile'],
        ],
        'defaults' => [
            'format' => 'avif'
        ],
    ],
    'articlePreviewSThumb' => [
        'displayName' => 'Article Preview S Thumb',
        'transforms' => [
            ['width' => 1920, 'ratio' => 1 / 1 , 'device' => 'desktop'],
            ['width' => 1080, 'ratio' => 1 / 1, 'device' => 'mobile'],
        ],
        'defaults' => [
            'format' => 'avif'
        ],
    ],
];
