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
        'position' => 'focalpoint',
    ],
    'feedImageTransform' => [
        'displayName' => 'Feed Image',
        'transforms' => [
            ['width' => 1920, 'ratio' => 16 / 9],
        ],
        'defaults' => $defaults,
        'position' => 'focalpoint',
    ],
    'authorPortrait' => [
        'displayName' => 'Author Portrait',
        'transforms' => [
            ['width' => 256, 'ratio' => 1 / 1],
        ],
        'defaults' => $defaults,
        'position' => 'focalpoint',
    ],
    'newsThumb' => [
        'displayName' => 'NewsThumb',
        'transforms' => [
            ['width' => 580, 'ratio' => 1 / 1],
        ],
        'defaults' => $defaults,
        'position' => 'focalpoint',
    ],
    'articleImageLightbox' => [
        'displayName' => 'Article Image Lightbox',
        'transforms' => [
            ['width' => 1920],
        ],
        'defaults' => $defaults,
        'position' => 'focalpoint',
    ],
    'articleImage' => [
        'displayName' => 'Article Image',
        'transforms' => [
            ['width' => 1920, 'device' => 'desktop'],
            ['width' => 1080, 'device' => 'mobile'],
        ],
        'defaults' => $defaults,
        'position' => 'focalpoint',
    ],
    'articleThumb' => [
        'displayName' => 'Article Thumb',
        'transforms' => [
            ['width' => 1920, 'ratio' => 16 / 9, 'device' => 'desktop'],
            ['width' => 1080, 'ratio' => 4 / 5,  'device' => 'tablet'],
            ['width' => 1080, 'ratio' => 1 / 1,  'device' => 'mobile'],
        ],
        'defaults' => $defaults,
        'position' => 'focalpoint',
    ],
];