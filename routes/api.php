<?php

use App\controllers\ContactController;
use App\controllers\SubscriberController;
use App\controllers\ArticleController;
use Router\Router;

Router::post('/api/subscribers/store',[SubscriberController::class,'store']);
Router::post('/api/contacts/store',[ContactController::class,'store']);
Router::post('/api/contacts/[i:id]/read',[ContactController::class,'read']);
Router::get('/api/v1/articles',[ArticleController::class,'articles']);
?>