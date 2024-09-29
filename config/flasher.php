<?php // config/flasher.php

return [
    'plugins' => [
        'sweetalert' => [
            'scripts' => [
                '/vendor/flasher/sweetalert2.min.js',
                '/vendor/flasher/flasher-sweetalert.min.js',
            ],
            'styles' => [
                '/assets/vendor/libs/sweetalert2/sweetalert2.css',
            ],
            'options' => [
                // Optional: Add global options here
                'position' => 'center'
            ],
        ],
    ],
];
