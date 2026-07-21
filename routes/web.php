<?php

use App\controllers\AdminController;
use App\controllers\ArticleController;
use App\controllers\AuthController;
use App\controllers\HomeController;
use App\controllers\SubscriberController;
use App\controllers\ContactController;
use App\controllers\UserController;
use App\View;
use Router\Router;

Router::get('/',[HomeController::class,'index']);
Router::post('/login',[AuthController::class,'login']);

Router::get('/admin/dashboard',[AdminController::class,'index']);
Router::get('/admin/contacts',[ContactController::class,'index']);
Router::get('/admin/subscribers',[SubscriberController::class,'index']);
Router::get('/admin/temoignages',[AdminController::class,'testimonials']);
Router::get('/admin/users',[UserController::class,'index']);
Router::get('/admin/articles',[ArticleController::class,'index']);

Router::get('/logout',[AuthController::class,'logout']);

Router::get('/reset-password',function(){
     View::view('password.reset-password');
});

?>
