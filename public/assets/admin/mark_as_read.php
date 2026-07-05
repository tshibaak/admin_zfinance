<?php
session_start();

if (empty($_SESSION['admin_logged'])) {
    http_response_code(403);
    exit;
}

require __DIR__ . "/../../../vendor/autoload.php";

use Helper\Build\Database;

$db = Database::Instance();

if (!isset($_POST['id'])) {
    exit;
}

$id = (int) $_POST['id'];

$stmt = $db->prepare("UPDATE contacts SET statut = 'lu' WHERE id = ?");
$stmt->execute([$id]);

echo "ok";