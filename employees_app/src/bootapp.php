<?php
// Configuramos la ruta base de la app
if (!defined('APP_ROOT')) {
    $spl = new SplFileInfo(__DIR__.'/..');
    define('APP_ROOT', $spl->getRealPath());
}

// Autoload
require_once APP_ROOT.'/vendor/autoload.php';

//EmployeeController
require APP_ROOT.'/src/App/Controller/EmployeeController.php';

// Instanciamos la app con las configuraciones del settings.php
$settings = require APP_ROOT.'/src/settings.php';
$app      = new \Slim\App($settings);

// Cargamos las dependencias
require APP_ROOT.'/src/dependencies.php';

// Cargamos los middleware
require APP_ROOT.'/src/middleware.php';

// Registramos las rutas
require APP_ROOT.'/src/routes.php';
