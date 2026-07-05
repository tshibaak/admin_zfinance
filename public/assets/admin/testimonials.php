<?php

session_start();

if(empty($_SESSION['admin_logged'])){
    header('Location: login.php');
    exit;
}

require __DIR__ . "/../../../vendor/autoload.php";

use Helper\Build\Database;

$db = Database::Instance();

$testimonials = $db->query("SELECT * FROM testimonials ORDER BY created_at DESC")->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Témoignages</title>
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
        <h1>Témoignages Publics</h1>
    </div>

    <div class="table-container">

        <table>

            <thead>
                <tr>
                    <th>Auteur</th>
                    <th>Entreprise</th>
                    <th>Message</th>
                    <th>Note</th>
                    <th>Date</th>
                </tr>
            </thead>

            <tbody>

            <?php foreach($testimonials as $testimonial): ?>

                <tr>
                    <td><?= htmlspecialchars($testimonial['author']) ?></td>
                    <td><?= htmlspecialchars($testimonial['company']) ?></td>
                    <td><?= nl2br(htmlspecialchars($testimonial['message'])) ?></td>
                    <td>⭐ <?= (int)$testimonial['rating'] ?>/5</td>
                    <td><?= htmlspecialchars($testimonial['created_at']) ?></td>
                </tr>

            <?php endforeach; ?>

            </tbody>

        </table>

    </div>

</div>

</body>
</html>
