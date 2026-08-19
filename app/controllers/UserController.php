<?php

namespace App\controllers;

use App\models\Role;
use App\View;
use App\models\User;
use Helper\Build\Database;
use Router\Router;
use Helper\String\Stringy;
use Helper\Log\LogManagement;
use Core\Session;
class UserController extends Controller
{
    private function ensureSession(): bool
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        return !empty($_SESSION['auth']);
    }

    public function index()
    {
        if (!$this->ensureSession()) {
            header('Location:'. Router::route('/'));
            exit;
        }

        if(!Session::ensureRole('admin',$_SESSION['user']['role'])){
            \Router\Router::respondWithError(403);
            exit;
        }

        $users = new User();
        $roles = new Role();
        View::view('admin.users.index', [
            'users' => $users->all(),
            'roles' => $roles
        ]);
    }

    public function create(){
      if(!Session::ensureRole('admin',$_SESSION['user']['role'])){
          \Router\Router::respondWithError(403);
          exit;
      }

        $roles = new Role();
        View::view('admin.users.create',['roles' => $roles->all()]);
    }

    public function show($id){
        if(!Session::ensureRole('admin',$_SESSION['user']['role'])){
            \Router\Router::respondWithError(403);
            exit;
        }

        $id = (int) $id['id'];
        $user = new User();
        $account = $user->findBy(['id' => $id], \PDO::FETCH_OBJ);

        if (!$account) {
            \Router\Router::respondWithError(404);
            exit;
        }

        $roles = new Role();
        View::view('admin.users.show', [
            'user' => $account,
            'roleName' => $roles->getRole((int) $account->role_id),
        ]);
    }

    public function edit($id){
        if(!Session::ensureRole('admin',$_SESSION['user']['role'])){
            \Router\Router::respondWithError(403);
            exit;
        }

        $id = (int) $id['id'];
        $user = new User();
        $roles = new Role();

        View::view('admin.users.edit',[
            'user' => $user->findBy(['id' => $id],\PDO::FETCH_OBJ),
            'roles' => $roles->all(),

        ]);
    }

    public function update($id){
        if(!Session::ensureRole('admin',$_SESSION['user']['role'])){
            \Router\Router::respondWithError(403);
            exit;
        }

        $user = new User();
        $role = new Role();

        $id = (int) $id['id'];
        if (!$user->findBy(['id' => $id],\PDO::FETCH_OBJ)) {
            \Router\Router::respondWithError(404);
            exit;
        }

        $role_id = $this->sanitize($_POST['role_id'] ??  "");
        $name = $this->sanitize($_POST['name'] ??  "");
        $email = $this->sanitize($_POST['email'] ??  "");
        $password = $this->sanitize($_POST['password'] ?? "");


        if( $email === '' || $role_id === "" || $name === "") {
            $_SESSION['message_error'] = 'Veuillez remplir tous les champs.';
            header('Location: '.Router::route('/admin/users/'.$id.'/edit'));
            exit;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['message_error'] = 'Indentifiant  invalide.';
            header('Location: ' . Router::route('/admin/users/'.$id.'/edit'));
            exit;
        }

        if(!Stringy::lengthError($password, 7, 20)) {
            $_SESSION['message_error'] = 'Le mot de passe doit contenir entre 7 et 20 caractères.';
            header('Location: ' .Router::route('/admin/users/'.$id.'/edit') );
            exit;
        }

        if(!$role->findBy(['id' => $role_id],\PDO::FETCH_OBJ)) {
            $_SESSION['message_error'] = 'Role invalide.';
            header('Location: ' .Router::route('/admin/users/'.$id.'/edit') );
            exit;
        }

        $user->update([ $role_id, $name, $email, password_hash($password, PASSWORD_DEFAULT), $id]);
        header('Location: ' . Router::route('/admin/users/'.$id.'/show'));
        exit;

    }

    public function delete($id){
        if(!Session::ensureRole('admin',$_SESSION['user']['role'])){
            \Router\Router::respondWithError(403);
            exit;
        }

        $user = new User();
        $id = (int) $id['id'];
        if (!$user->findBy(['id' => $id],\PDO::FETCH_OBJ)) {
            \Router\Router::respondWithError(404);
            exit;
        }

        $user->delete($id);
        header('Location: ' . Router::route('/admin/users'));
        exit;
    }

    public function store(){
        if(!Session::ensureRole('admin',$_SESSION['user']['role'])){
            \Router\Router::respondWithError(403);
            exit;
        }
        $database = Database::Instance();

        $role = $this->sanitize($_POST['role'] ??  "");
        $name = $this->sanitize($_POST['name'] ??  "");
        $email = $this->sanitize($_POST['email'] ??  "");
        $password = $this->sanitize($_POST['password'] ?? "");
        
        if ($email === '' || $password === '' || $role === "" || $name === "") {
           $_SESSION['message_error'] = 'Veuillez remplir tous les champs.';
           header('Location: '.Router::route('/admin/users/create'));
           exit;
       }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
           $_SESSION['message_error'] = 'Adresse email invalide.';
           header('Location: ' . Router::route('/admin/users/create'));
           exit;
       }

        if(!Stringy::lengthError($password, 7, 20)) {
           $_SESSION['message_error'] = 'Le mot de passe doit contenir entre 7 et 20 caractères.';
           header('Location: ' .Router::route('/admin/users/create') );
           exit;
       }

         try {
           $stmt = $database->prepare("SELECT users.*,roles.name as `role` 
                         FROM users INNER JOIN roles 
                         ON users.role_id = roles.id  
                         WHERE email = :email LIMIT 1", [
               ':email' => $email,
           ]);

           $row = $stmt->fetch();
          
           if ($row) 
            {
                $_SESSION['message_error'] = 'Ce compte existe deja.';
                header('Location: ' . Router::route('/admin/users/create') );
                exit;
            }

            else{
                $database->prepare("INSERT INTO users(role_id,name,email,pass) VALUES (?,?,?,?)
                ",[$role,$name,$email,password_hash($password, PASSWORD_DEFAULT)]);
                header('Location: ' . Router::route('/admin/users') );
                exit;
            }

       } catch (\PDOException $e) {
           $_SESSION['message_error'] = 'Erreur creation d un compte admin impossible pour le momemnt .';
           header('Location: ' .Router::route('/admin/users/create'));
           LogManagement::Instance()->error('Database error during admin login: ' . $e->getMessage());
           exit;
       }
    }
}
