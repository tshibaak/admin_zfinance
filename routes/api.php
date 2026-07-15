<?php

use App\controllers\Controller;
use App\controllers\SubscriberController;
use App\models\ArticleModel;
use App\models\SubscriberModel;
use Router\Router;

Router::post('/api/subscribers/store',[SubscriberController::class,'store']);
Router::get('/api/test',function(){
//   $password = "123456789";
// $hash = password_hash($password, PASSWORD_DEFAULT);

// echo $hash;
})

?>