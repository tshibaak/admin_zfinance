<?php

session_start();

if(empty($_SESSION['admin_logged'])){
    exit;
}

require __DIR__ . "/../../../vendor/autoload.php";

use Helper\Build\Database;

$db = Database::Instance();

$id = (int) $_GET['id'];

$stmt = $db->prepare("DELETE FROM contacts WHERE id = :id");
$stmt->execute([':id' => $id]);

header('Location: contacts.php');
exit;
