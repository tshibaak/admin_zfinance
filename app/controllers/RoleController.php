<?php 
 namespace  App\controllers;

use App\models\Role;
use App\View;
use Override;

 class RoleController extends ContactController{
 
    public function index()
    {
       $roles = new Role();
       View::view('#',['roles' => $roles->all()]);
    }
 }
?>