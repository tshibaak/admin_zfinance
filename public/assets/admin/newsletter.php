<?php

session_start();

if(empty($_SESSION['admin_logged'])){
    header('Location: login.php');
    exit;
}

require __DIR__ . "/../../../vendor/autoload.php";

use Helper\Build\Database;

$db = Database::Instance();

$subs = $db->query("SELECT * FROM subscribers ORDER BY created_at DESC")->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Newsletter</title>
    <link rel="stylesheet" href="assets/css/admin.css">
</head>

<body>

<div class="sidebar">

    <h2>ADMIN</h2>

    <ul>
        <li><a href="dashboard.php">🏠 Dashboard</a></li>
        <li><a href="contacts.php">📩 Messages Contact</a></li>
        <li><a href="newsletter.php">📧 Newsletter</a></li>
        <li><a href="testimonials.php">⭐ Témoignages</a></li>
        <li><a href="../../index.php?q=accueil">↩ Retour au site</a></li>
        <li><a href="logout.php">🚪 Déconnexion</a></li>
    </ul>

</div>

<div class="main">

    <div class="header">
        <h1>Abonnés Newsletter</h1>
    </div>

    <div class="table-container">

        <table>

            <thead>
                <tr>
                    <th>Email</th>
                    <th>Date d'inscription</th>
                </tr>
            </thead>

            <tbody>

            <?php foreach($subs as $sub): ?>

                <tr>
                    <td><?= htmlspecialchars($sub['email']) ?></td>
                    <td><?= htmlspecialchars($sub['created_at']) ?></td>
                </tr>

            <?php endforeach; ?>

            </tbody>

        </table>

    </div>

</div>

</body>
</html>
