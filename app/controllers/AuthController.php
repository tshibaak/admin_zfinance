<?php

namespace App\controllers;

use Helper\Build\Database;
use Router\Router;

class AuthController extends Controller
{
    public function logout()
    {
        session_unset();
        session_destroy();
         
        header("Location: ". Router::route('/login'));
        exit;
    }


    public function login()
    {
       require dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

       $db = Database::Instance();
       
       $loginRedirect = '../../public/index.php?q=login';
       $adminRedirect = '../../public/index.php?q=admin';
       
       if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
           header('Location: ' . $loginRedirect);
           exit;
       }
       
       $user = trim($_POST['username'] ?? '');
       $pass = trim($_POST['password'] ?? '');
       
       if ($user === '' || $pass === '') {
           $_SESSION['message_error'] = 'Veuillez remplir tous les champs.';
           header('Location: ' . $loginRedirect);
           exit;
       }
       
       try {
           $stmt = $db->prepare("
               SELECT COUNT(*)
               FROM admin
               WHERE nameAdmin = :nameAdmin
                 AND passAdmin = :passAdmin
           ");
           $stmt->execute([
               ':nameAdmin' => $user,
               ':passAdmin' => $pass,
           ]);
       
           if ((int) $stmt->fetchColumn() > 0) {
               $_SESSION['admin_logged'] = true;
               header('Location: ' . $adminRedirect);
               exit;
           }
       
           $_SESSION['message_error'] = 'Identifiants invalides.';
           header('Location: ' . $loginRedirect);
           exit;
       } catch (\PDOException $e) {
           $_SESSION['message_error'] = 'Connexion admin indisponible pour le moment.';
           header('Location: ' . $loginRedirect);
           exit;
       }

    }
}
