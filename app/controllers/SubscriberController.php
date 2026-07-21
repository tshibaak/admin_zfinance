<?php

namespace App\controllers;
use App\models\Subscriber;
use Router\Router;
use App\View;
use Helper\Build\Database;
use Helper\String\Stringy;

class SubscriberController extends Controller
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

        $subscriberModel = new Subscriber();
        View::view('admin.newsletter', [
            'subscribers' => $subscriberModel->findAll(),
        ]);
    }


    public function store()
    {
        $email = ($this->inputs())['email'] ?? "";
       
        if (!Stringy::empty($email)) {
            $this->status(422)->json([
                "status" => "error",
                "message" => "Email manquant"
            ]);
            return;
        }

    
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
           $this->status(422)->json([
                "status" => "error",
                "message" => "Email invalide"
            ]);
            return;
        }

        try {
            $datas = Database::Instance()->prepare("SELECT id FROM subscribers WHERE email = ? ",[$email]);
           
            if ($datas->fetch()) {
                 $this->status(409)->json([
                    "status" => "error",
                    "message" => "Email déjà enregistré"
                ]);
                return;
            }

            Database::Instance()->prepare("INSERT INTO subscribers  (email) VALUES (?)",[ $email]);
         
             $this->status(200)->json([
                "status" => "success",
                "message" => "Email enregistré avec succès",
                "data" => ["email" => $email]
            ]);

        } catch (\PDOException $e) {
           $this->status(500)->json([
                "status" => "error",
                "message" => "Erreur serveur: " . $e->getMessage()
            ]);
        }
    }
}

?>