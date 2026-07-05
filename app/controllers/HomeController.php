<?php

namespace App\controllers;

use App\View;
use Helper\Build\Database;

class HomeController extends Controller
{
    public function index()
    {
        // View::view('index');
    }

    public function contact(){
    
session_start();

require dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

$db = Database::Instance();

$redirect = '../../public/index.php?q=accueil#zf-contact';

function redirectAccueil()
{
    global $redirect;
    header('Location: ' . $redirect);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirectAccueil();
}

$nom = trim($_POST['nom'] ?? '');
$email = trim($_POST['email'] ?? '');
$telephone = trim($_POST['telephone'] ?? '');
$sujet = trim($_POST['sujet'] ?? '');
$message = trim($_POST['message'] ?? '');

$allowedSubjects = [
    'comptabilite',
    'audit',
    'fiscal',
    'juridique',
    'paie',
    'entrepreneurial',
    'autre',
];

if ($nom === '' || $email === '' || $sujet === '' || $message === '') {
    $_SESSION['message_error_accueil'] = 'Veuillez completer tous les champs obligatoires.';
    redirectAccueil();
}

$validNom = preg_match('/^[a-zA-ZÀ-ÿ\s\'-]{2,120}$/u', $nom);
$validEmail = filter_var($email, FILTER_VALIDATE_EMAIL);
$validTelephone = $telephone === '' || preg_match('/^\+?[0-9\s().-]{7,25}$/', $telephone);
$validSujet = in_array($sujet, $allowedSubjects, true);
$validMessage = strlen($message) >= 5 && strlen($message) <= 3000;

if (!$validNom || !$validEmail || !$validTelephone || !$validSujet || !$validMessage) {
    $_SESSION['message_error_accueil'] = 'Certaines donnees sont invalides. Verifiez le formulaire puis reessayez.';
    redirectAccueil();
}

try {
    $stmt = $db->prepare("
        INSERT INTO contacts (nom, email, telephone, sujet, message)
        VALUES (:nom, :email, :telephone, :sujet, :message)
    ");

    $stmt->execute([
        ':nom' => $nom,
        ':email' => $email,
        ':telephone' => $telephone,
        ':sujet' => $sujet,
        ':message' => $message,
    ]);

    $_SESSION['message_accueil_ok'] = 'Votre message a ete envoye avec succes. Nous vous recontacterons sous 24h ouvrees.';
} catch (\PDOException $e) {
    $_SESSION['message_error_accueil'] = 'Impossible d enregistrer votre message pour le moment.';
}

redirectAccueil();

    }


public function newsletter(){

session_start();

require dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

$db = Database::Instance();

$redirect = '../../public/index.php?q=accueil#zf-contact';

function redirectNewsletter()
{
    global $redirect;
    header('Location: ' . $redirect);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirectNewsletter();
}

$email = trim($_POST['email'] ?? '');

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['message_error_accueil'] = 'Veuillez entrer une adresse email valide.';
    redirectNewsletter();
}

try {
    $stmt = $db->prepare("
        INSERT INTO subscribers (email)
        VALUES (:email)
        ON DUPLICATE KEY UPDATE email = VALUES(email)
    ");
    $stmt->execute([':email' => $email]);

    $_SESSION['message_accueil_ok'] = 'Votre inscription a la newsletter est confirmee.';
} catch (\PDOException $e) {
    $_SESSION['message_error_accueil'] = 'Impossible d enregistrer votre inscription pour le moment.';
}

redirectNewsletter();

    }
}
