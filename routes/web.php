<?php

use App\controllers\AdminController;
use App\controllers\ArticleController;
use App\controllers\AuthController;
use App\controllers\SubscriberController;
use App\controllers\ContactController;
use App\controllers\UserController;
use Router\Router;

Router::get('/',[AuthController::class,'index']);
Router::post('/login',[AuthController::class,'login']);
Router::get('/admin/dashboard',[AdminController::class,'index']);
Router::get('/admin/contacts',[ContactController::class,'index']);
Router::get('/admin/subscribers',[SubscriberController::class,'index']);
Router::get('/admin/temoignages',[TestiMonialController::class,'index']);
Router::get('/admin/users',[UserController::class,'index']);
Router::get('/admin/users/create',[UserController::class,'create']);
Router::post('/admin/users/store',[UserController::class,'store']);
Router::get('/admin/users/[i:id]/show',[UserController::class,'show']);
Router::get('/admin/articles',[ArticleController::class,'index']);
Router::get('/logout',[AuthController::class,'logout']);
?>
