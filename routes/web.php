<?php


use App\controllers\ArticleController;
use App\controllers\CategoryController;
use App\controllers\AuthController;
use App\controllers\SubscriberController;
use App\controllers\ContactController;
use App\controllers\UserController;
use App\controllers\SemiAdminController;
use App\controllers\TestiMonialController;
use Router\Router;

Router::get('/',[AuthController::class,'index']);
Router::post('/login',[AuthController::class,'login']);
Router::get('/admin/dashboard',[SemiAdminController::class,'index']);
Router::get('/admin/contacts',[ContactController::class,'index']);
Router::get('/admin/subscribers',[SubscriberController::class,'index']);
Router::get('/admin/temoignages',[TestiMonialController::class,'index']);
Router::get('/admin/users',[UserController::class,'index']);
Router::get('/admin/users/create',[UserController::class,'create']);
Router::post('/admin/users/store',[UserController::class,'store']);
Router::get('/admin/users/[i:id]/show',[UserController::class,'show']);
Router::get('/admin/users/[i:id]/edit',[UserController::class,'edit']);
Router::post('/admin/users/[i:id]/update',[UserController::class,'update']);
Router::post('/admin/users/[i:id]/delete',[UserController::class,'delete']);
Router::get('/admin/articles',[ArticleController::class,'index']);
Router::get('/admin/articles/create',[ArticleController::class,'create']);
Router::post('/admin/articles/store',[ArticleController::class,'store']);
Router::get('/admin/articles/[i:id]/show',[ArticleController::class,'show']);
Router::get('/admin/articles/[i:id]/edit',[ArticleController::class,'edit']);
Router::post('/admin/articles/[i:id]/update',[ArticleController::class,'update']);
Router::post('/admin/articles/[i:id]/delete',[ArticleController::class,'delete']);
Router::get('/admin/categories',[CategoryController::class,'index']);
Router::get('/admin/categories/create',[CategoryController::class,'create']);
Router::post('/admin/categories/store',[CategoryController::class,'store']);
Router::get('/admin/categories/[i:id]/show',[CategoryController::class,'show']);
Router::get('/admin/categories/[i:id]/edit',[CategoryController::class,'edit']);
Router::post('/admin/categories/[i:id]/update',[CategoryController::class,'update']);
Router::post('/admin/categories/[i:id]/delete',[CategoryController::class,'delete']);
Router::get('/logout',[AuthController::class,'logout']);
?>
