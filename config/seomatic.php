<?php

return [
    '*' => [
        // Include `?section=...` in SEOmatic's unique metadata cache key
        'allowedUrlParams' => [
            'section',
        ],
    ],
];