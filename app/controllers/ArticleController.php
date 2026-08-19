<?php

namespace App\controllers;

use App\View;
use App\models\Article;
use Router\Router;
use Core\Session;
class ArticleController extends Controller
{
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

        $articles = new Article();
        View::view('admin.articles.index', [
            'articles' => $articles->findAll(),
        ]);
    }

    public function create()
    {
        if (!$this->ensureSession()) {
            header('Location: '.  Router::route('/'));
            exit;
        }

        if(!Session::ensureRole('semi-admin',$_SESSION['user']['role'])){
            \Router\Router::respondWithError(403);
            exit;
        }

        View::view('admin.articles.create');
    }


}
