<?php

namespace App\controllers;

use App\models\Role;
use App\View;
use App\models\User;
use Router\Router;

class UserController extends Controller
{
    private function ensureAdminSession(): bool
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        return !empty($_SESSION['admin_logged']);
    }

    public function index()
    {
        if (!$this->ensureAdminSession()) {
            header('Location:'. Router::route('/'));
            exit;
        }
         
          $users = new User();
          $roles = new Role();
          View::view('admin.users.index', [
              'users' => $users->all(),
              'roles' => $roles
          ]);
    }
}