<?php

define('BASE_PATH', __DIR__);

error_reporting(E_ALL);
ini_set('display_errors', 1);

$path = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');


$routes = [
    ''            => 'slw-webapp-v1/app-page-templates/selectworks.php',
    'index.php'            => 'slw-webapp-v1/app-page-templates/selectworks.php',
    'contact'     => 'slw-webapp-v1/app-modules/contact/contact.php',
    'vacatures'   => 'slw-webapp-v1/app-modules/vacatures/vacatures.php',
    'opdrachten'  => 'slw-webapp-v1/app-modules/opdrachten/opdrachten.php',
    'inschrijven' => 'slw-webapp-v1/app-modules/inschrijven/inschrijfformulier.php',
    'inloggen'    => 'slw-webapp-v1/app-modules/inloggen/inlog-portaal.php',
];

if (array_key_exists($path, $routes)) {
    include __DIR__ . '/' . $routes[$path];
    exit;
}

http_response_code(404);

include __DIR__ . '/slw-webapp-v1/app-controllers/error-controller/404.php';
