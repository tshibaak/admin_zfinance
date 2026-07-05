<?php
session_start();

use Helper\Build\Database;
use Router\Router;

require dirname(__DIR__). DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

Dotenv\Dotenv::createImmutable(dirname(__DIR__))->load();

Router::Instance();
// Database::Instance();

require dirname(__DIR__). DIRECTORY_SEPARATOR . 'routes' . DIRECTORY_SEPARATOR . 'web.php';
require dirname(__DIR__). DIRECTORY_SEPARATOR . 'routes' . DIRECTORY_SEPARATOR . 'api.php';

Router::matcher();