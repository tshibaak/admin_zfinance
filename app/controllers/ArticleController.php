<?php

namespace App\controllers;

use App\View;
use App\models\ContactModel;
use App\models\Subscriber;
use App\models\TestimonialModel;
use Router\Router;

class ArticleController extends Controller
{
    private function ensureAdminSession(): bool
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        return !empty($_SESSION['admin_logged']);
    }


    public function index()
    {
        if (!$this->ensureAdminSession()) {
            header('Location: '.  Router::route('/'));
            exit;
        }

        $articles = new \App\models\Article();
        View::view('admin.articles.index', [
            'articles' => $articles->findAll(),
        ]);
    }
}
