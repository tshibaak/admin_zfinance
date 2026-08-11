<?php 
 namespace  App\controllers;

use App\models\Role;
use App\View;
 class RoleController extends Controller{
 
    public function index()
    {
       $roles = new Role();
       View::view('#',['roles' => $roles->all()]);
    }
 }
?>