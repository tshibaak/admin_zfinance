<?php

namespace App\controllers;

use App\controllers\Controller;
use App\models\TestimonialModel;
use App\View;
use Router\Router;
use Core\Session;

// controlleur des temoignages
class TestiMonialController extends Controller{

    private function ensureSession(): bool
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        return !empty($_SESSION['auth']);
    }
    
    public function index()
    {
        if (!$this->ensureSession()) {
            header('Location: '.  Router::route('/'));
            exit;
        }

        if(!Session::ensureRole('semi-admin',$_SESSION['user']['role'])){
            \Router\Router::respondWithError(403);
            exit;
        }

        /**
         * listes des temoiganges
        */ 
        $testimonials = new TestimonialModel();
        View::view('admin.testimonials',compact('testimonials'));
    }
}
?>