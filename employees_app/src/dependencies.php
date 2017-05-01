<?php
// DIC configuration

$container = $app->getContainer();

// view renderer
$container['renderer'] = function ($c) {
    $settings = $c->get('settings')['renderer'];
    $twig     = new Slim\Views\Twig($settings['template_path']);
    $twig->getEnvironment()->addGlobal('base_url', $c['request']->getUri()->getBaseUrl());
    return $twig;
};

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger   = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};

// EmployeeController
$container['EmployeeController'] = function($container) {
    return new \App\Controller\EmployeeController($container->get('renderer'));
};
