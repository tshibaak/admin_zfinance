<?php

use App\controllers\AdminController;
use App\controllers\AuthController;
use App\controllers\HomeController;
use App\View;
use Router\Router;

Router::get('/',[HomeController::class,'index']);
Router::post('/login',[AuthController::class,'login']);

Router::get('/admin/dashboard',[AdminController::class,'index']);
Router::get('/admin/contacts',[AdminController::class,'contacts']);
Router::get('/admin/newsletter',[AdminController::class,'newsletter']);
Router::get('/admin/testimonials',[AdminController::class,'testimonials']);
Router::get('/logout',[AuthController::class,'logout']);
?>
