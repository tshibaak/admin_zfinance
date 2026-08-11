<?php

use App\controllers\ContactController;
use App\controllers\SubscriberController;
use Router\Router;

Router::post('/api/subscribers/store',[SubscriberController::class,'store']);
Router::post('/api/contacts/store',[ContactController::class,'store']);
Router::post('/api/contacts/[i:id]/read',[ContactController::class,'read']);
?>