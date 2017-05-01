<?php
return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header
        'view' => 'TwigView',
        // Renderer settings
        'renderer' => [
            'template_path' => APP_ROOT.'/templates/'
        ],
        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' => APP_ROOT.'/logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],
    ],
];
