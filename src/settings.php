<?php
defined('DS') ? : define('DS', DIRECTORY_SEPARATOR);
defined('ROOT') ? : define('ROOT', dirname(__DIR__) . DS);

if (file_exists(ROOT . '.env')) {
    $dotenv = new Dotenv\Dotenv(ROOT);
    $dotenv->load();
}

return [
    'settings' => [
        'displayErrorDetails' => getenv('APP_DEBUG') === 'true' ? true : false,
        'addContentLengthHeader' => false,
        'determineRouteBeforeAppMiddleware' => true,
        'app' => [
            'name' => getenv('APP_NAME'),
            'url' => getenv('APP_URL'),
            'env' => getenv('APP_ENV'),
        ]
    ]
];
