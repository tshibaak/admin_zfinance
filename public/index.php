<?php
session_start();

// $page = strtolower(trim($_GET['q'] ?? 'accueil'));

// switch ($page) {
//     case 'admin':
//     case 'dashboard':
//         if (!empty($_SESSION['admin_logged'])) {
//             header('Location: assets/admin/dashboard.php');
//         } else {
//             header('Location: assets/admin/login.php');
//         }
//         exit;

//     case 'login':
//         header('Location: assets/admin/login.php');
//         exit;

//     case 'logout':
//         header('Location: assets/admin/logout.php');
//         exit;

//     case 'accueil':
//     case 'home':
//     case '':
//         require __DIR__ . '/assets/pages/index.php';
//         break;

//     default:
//         http_response_code(404);
//         require __DIR__ . '/assets/pages/index.php';
//         break;
// }

use Helper\Build\Database;
use Router\Router;

require dirname(__DIR__). DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

Dotenv\Dotenv::createImmutable(dirname(__DIR__))->load();

Router::Instance();
Database::Instance();

require dirname(__DIR__). DIRECTORY_SEPARATOR . 'routes' . DIRECTORY_SEPARATOR . 'web.php';
require dirname(__DIR__). DIRECTORY_SEPARATOR . 'routes' . DIRECTORY_SEPARATOR . 'api.php';

Router::matcher();