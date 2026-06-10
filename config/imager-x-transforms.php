<?php

$format = 'webp';

$defaults = [
    'format' => $format,
];

return [
    'articleStarterImg' => [
        'displayName' => 'Article Aufmacherbild',
        'transforms' => [
            ['width' => 1920, 'ratio' => 16 / 9, 'device' => 'desktop'],
            ['width' => 1080, 'ratio' => 4 / 5,  'device' => 'mobile'],
        ],
        'defaults' => $defaults,
    ],
    'feedImageTransform' => [
        'displayName' => 'Feed Image',
        'transforms' => [
            ['width' => 1920, 'ratio' => 16 / 9],
        ],
        'defaults' => $defaults,
    ],
    'authorPortrait' => [
        'displayName' => 'Author Portrait',
        'transforms' => [
            ['width' => 100, 'ratio' => 1 / 1],
        ],
        'defaults' => $defaults,
    ],
    'articleImageLightbox' => [
        'displayName' => 'Article Image Lightbox',
        'transforms' => [
            ['width' => 1920],
        ],
        'defaults' => $defaults,
    ],
    'articleImage' => [
        'displayName' => 'Article Image',
        'transforms' => [
            ['width' => 1920, 'device' => 'desktop'],
            ['width' => 1080, 'device' => 'mobile'],
        ],
        'defaults' => $defaults,
    ],
    'articleThumb' => [
        'displayName' => 'Article Thumb',
        'transforms' => [
            ['width' => 1920, 'ratio' => 16 / 9, 'device' => 'desktop'],
            ['width' => 1080, 'ratio' => 4 / 5,  'device' => 'tablet'],
            ['width' => 1080, 'ratio' => 1 / 1,  'device' => 'mobile'],
        ],
        'defaults' => $defaults,
    ],
];