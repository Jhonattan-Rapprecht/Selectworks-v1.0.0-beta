<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);


/*
|--------------------------------------------------------------------------
| BASE PATH (filesystem)
|--------------------------------------------------------------------------
*/
define('BASE_PATH', realpath(__DIR__));

/*
|--------------------------------------------------------------------------
| BASE URL (browser path)
|--------------------------------------------------------------------------
| This is the folder your project lives in.
| If you move to production root, set it to ''.
*/
define('BASE_URL', '');


/*
|--------------------------------------------------------------------------
| Database connection and initialization - self-healing on every request
|--------------------------------------------------------------------------
*/

require BASE_PATH . '/slw-webapp-v1/app-db/initDB.php';



/*
|--------------------------------------------------------------------------
| Extract the request path
|--------------------------------------------------------------------------
*/
$path = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');


/*
|--------------------------------------------------------------------------
| Route definitions
|--------------------------------------------------------------------------
*/
$routes = [
    ''            => 'slw-webapp-v1/app-page-templates/selectworks.php',
    'index.php'   => 'slw-webapp-v1/app-page-templates/selectworks.php',

    'business'    => 'slw-webapp-v1/app-page-templates/business/business.php',
    'zzp'         => 'slw-webapp-v1/app-page-templates/zzp/zzp.php',
    'particulier' => 'slw-webapp-v1/app-page-templates/particulier/particulier.php',
    'diensten'    => 'slw-webapp-v1/app-page-templates/diensten/diensten.php',

    'vacatures'   => 'slw-webapp-v1/app-modules/vacatures/vacatures.php',
    'opdrachten'  => 'slw-webapp-v1/app-modules/opdrachten/opdrachten.php',
    'inschrijven' => 'slw-webapp-v1/app-modules/inschrijven/inschrijfformulier.php',
    'inloggen'    => 'slw-webapp-v1/app-modules/inloggen/inlog-portaal.php',
];

/*
|--------------------------------------------------------------------------
| Route matching
|--------------------------------------------------------------------------
*/
if (array_key_exists($path, $routes)) {
    include BASE_PATH . '/' . $routes[$path];
    exit;
}

/*
|--------------------------------------------------------------------------
| 404 fallback
|--------------------------------------------------------------------------
*/
http_response_code(404);
include BASE_PATH . '/slw-webapp-v1/app-controllers/error-controller/404.php';
