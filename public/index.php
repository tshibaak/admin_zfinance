<?php
session_start();


use Helper\Build\Database;
use Router\Router;

require dirname(__DIR__). DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

Dotenv\Dotenv::createImmutable(dirname(__DIR__))->load();

$origin = $_SERVER['HTTP_ORIGIN'] ?? '';

$allowedOrigins = array_filter([
    rtrim($_ENV['FRONT_APP'] ?? '', '/'),
    rtrim($_ENV['FRONT_SOUS_APP'] ?? '', '/'),
    rtrim($_ENV['FRONT_LOCAL'] ?? '', '/'),
    rtrim($_ENV['FRONT_LOCAL_IP'] ?? '', '/'),
]);

if (in_array($origin, $allowedOrigins, true)) {
    header("Access-Control-Allow-Origin: $origin");
    header("Vary: Origin");
    header("Access-Control-Allow-Credentials: true");
}

header("Access-Control-Allow-Methods: GET, POST, PUT, PATCH, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With, Accept");
header("Access-Control-Max-Age: 86400");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit;
}
Router::Instance();
Database::Instance();

require dirname(__DIR__). DIRECTORY_SEPARATOR . 'routes' . DIRECTORY_SEPARATOR . 'web.php';
require dirname(__DIR__). DIRECTORY_SEPARATOR . 'routes' . DIRECTORY_SEPARATOR . 'api.php';

Router::matcher();