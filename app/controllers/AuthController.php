<?php

namespace App\controllers;

use Helper\Build\Database;
use Helper\Log\LogManagement;
use Helper\String\Stringy;
use Router\Router;
use App\View;
use Core\Session;
class AuthController extends Controller
{
    public function index()
    {
      if(Session::sessionExist()){
        $role = $_SESSION['user']['role'];
        $route = $role === "admin" ? Router::route('/admin/users') : Router::route('/admin/dashboard');
        header('Location: '.$route);
      }
       View::view('auth.login');
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        header("Location: ". Router::route('/'));
        exit;
    }

    public function login()
    {
       $database = Database::Instance();
       
       $loginRedirect = Router::route('/');
       $adminRedirect = '';
       
       if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
           header('Location: ' . $loginRedirect);
           exit;
       }
       
       $email = $this->sanitize($_POST['email'] ?? '');
       $pass = $this->sanitize($_POST['password'] ?? '');
       
       if ($email === '' || $pass === '') {
           $_SESSION['message_error'] = 'Veuillez remplir tous les champs.';
           header('Location: ' . $loginRedirect);
           exit;
       }

       if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
           $_SESSION['message_error'] = 'Adresse email invalide.';
           header('Location: ' . $loginRedirect);
           exit;
       }

       if(!Stringy::lengthError($pass, 7, 20)) {
           $_SESSION['message_error'] = 'Le mot de passe doit contenir entre 7 et 20 caractères.';
           header('Location: ' . $loginRedirect);
           exit;
       }
       
       try {
           $stmt = $database->prepare("SELECT users.id,
                        users.name,users.email,users.pass,roles.name as `role` 
                         FROM users INNER JOIN roles 
                         ON users.role_id = roles.id  
                         WHERE email = :email LIMIT 1", [
               ':email' => $email,
           ]);

           $user = $stmt->fetch();
          
     
           if ($user && password_verify($pass, $user['pass'])) 
            {
               $_SESSION['auth'] = true;
               $_SESSION['user'] = $user;
               $adminRedirect = $_SESSION['user']['role'] === "admin" ? Router::route('/admin/users') : Router::route('/admin/dashboard') ;
               header('Location: ' . $adminRedirect);
               exit;
            }
       
           $_SESSION['message_error'] = 'Identifiants invalides.';
           header('Location: ' . $loginRedirect);
           exit;

       } catch (\PDOException $e) {
           $_SESSION['message_error'] = 'Connexion admin indisponible pour le moment.';
           header('Location: ' . $loginRedirect);
           LogManagement::Instance()->error('Database error during admin login: ' . $e->getMessage());
           exit;
       }

    }
}
