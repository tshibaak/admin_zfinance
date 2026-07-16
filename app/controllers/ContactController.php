<?php

 namespace  App\controllers;

 use App\models\ContactModel;
 use Router\Router;
 use App\View;
 use Helper\Build\Database;

 class ContactController extends Controller 
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
            header('Location:'. Router::route('/'));
            exit;
        }

        $contacts = new ContactModel();
        $pendings = count($contacts->findBy(['statut' => 'non_lu']));
   
    
        View::view('admin.contacts', [
            'contacts' => $contacts->findAll(),
            'pendings' => $pendings
        ]);
    }

   public function store()
   {
    $datas = $this->inputs(); 

    $required = ['name', 'email', 'sujet', 'message'];
    foreach ($required as $field) {
        if (empty($datas[$field])) {
            $this->status(422)->json([
                "status" => "error",
                "message" => "Le champ '$field' est obligatoire"
            ]);
        }
    }

    $email = filter_var($datas['email'], FILTER_SANITIZE_EMAIL);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $this->status(422)->json(
         [
            "status" => "error",
            "message" => "Email invalide"
        ]);
        return;
    }

    try {
     
        Database::Instance()->prepare(
            "INSERT INTO contacts (name, email, phone, sujet, message) VALUES (?, ?, ?, ?, ?)",
            [
                $datas['name'],
                $email,
                $datas['phone'] ?? null,
                $datas['sujet'],
                $datas['message']
            ]
        );

        $this->status(201)->json([
            "status" => "success",
            "message" => "Contact enregistré avec succès",
            "data" => [
                "name" => $datas['name'],
                "email" => $email,
                "sujet" => $datas['sujet']
            ]
        ]);
        return;

    } catch (\PDOException $e) {
        $this->status(500)->json(
        [
            "status" => "error",
            "message" => "Erreur serveur: " . $e->getMessage()
        ]);
         return;
    }
  }

public function read(mixed $id)
{
    $id = (int)$id['id'];
    try {
     
        if (empty($id) || !is_numeric($id)) {
            $this->status(422)->json([
                "status" => "error",
                "message" => "ID invalide"
            ]);
            return;
        }

        $updated = Database::Instance()->prepare(
            "UPDATE contacts SET statut = 'lu' WHERE id = ?",
            [$id]
        );

        if ($updated->rowCount() === 0) {
            $this->status(404)->json([
                "status" => "error",
                "message" => "Message introuvable"
            ]);
            return;
        }

        $this->status(200)->json([
            "status" => "success",
            "message" => "Message marqué comme lu",
            "data" => ["id" => $id]
        ]);
         return;

    } catch (\PDOException $e) {
        $this->status(500)->json([
            "status" => "error",
            "message" => "Erreur serveur: " . $e->getMessage()
        ]);
         return;
    }
}

 }
?>