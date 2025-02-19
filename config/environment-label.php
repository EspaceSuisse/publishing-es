<?php

use craft\helpers\App;

return [
    'showLabel' => true,
    'labelText' => App::env('CRAFT_ENV_LABEL_TEXT') . "Das ist NICHT die Live Site - ENV: {{ craft.app.env }}",
    'labelColor' => App::env('CRAFT_ENV_CP_LABEL_BG'),
    'textColor' => App::env('CRAFT_ENV_CP_LABEL_COLOR'),
    'targetSelector' => '#global-header:before',
];