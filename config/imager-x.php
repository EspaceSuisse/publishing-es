<?php

return [
    '*' => [
        'bgColor' => '#ffffff',
        'cacheEnabled' => true,
        'cacheKeyPrefix' => 'imager-x',
        'hashRemoteUrl' => true,
        'cacheDuration' => 2628000, // 1 month
        'filenamePattern' => '{basename}_{transformString|shorthash}_{timestamp}.{extension}',
    ],
];