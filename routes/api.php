<?php

use App\controllers\ContactController;
use App\controllers\Controller;
use App\controllers\SubscriberController;
use App\models\ArticleModel;
use App\models\SubscriberModel;
use Router\Router;

Router::post('/api/subscribers/store',[SubscriberController::class,'store']);
Router::post('/api/contacts/store',[ContactController::class,'store']);
Router::post('/api/contacts/[i:id]/read',[ContactController::class,'read']);

// Router::get('/api/test',function(){
// //   $password = "NSIABUNKETE7019#";
// // $hash = password_hash($password, PASSWORD_DEFAULT);

// // echo $hash;
// })

?>