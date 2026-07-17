<?php
if (!isset($totalContacts)) {
    $totalContacts = 0;
}
if (!isset($totalSubscribers)) {
    $totalSubscribers = 0;
}
if (!isset($totalTestimonials)) {
    $totalTestimonials = 0;
}
if (!isset($unread)) {
    $unread = 0;
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="/public/css/admin.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Admin - Zfinances</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>

<div class="sidebar">

    <h2>Zfinances Admin</h2>

    <ul>
        <li>
            <a class="active" href="<?= \Router\Router::route('/admin/dashboard') ?>">🏠 Dashboard</a>
        </li>

        <li>
            <a href="<?= \Router\Router::route('/admin/contacts') ?>">📩 Messages Contact</a>
        </li>

        <li>
            <a href="<?= \Router\Router::route('/admin/subscribers') ?>">📧 Newsletter</a>
        </li>

        <li>
            <a href="<?= \Router\Router::route('/admin/temoignages') ?>">⭐ Témoignages</a>
        </li>

        <li>
            <a href="https://www.zfinancesdrc.com/">↩ Retour au site</a>
        </li>

        <li>
            <a href="<?= \Router\Router::route('/logout') ?>">🚪 Déconnexion</a>
        </li>
    </ul>

</div>

<div class="main">

    <div class="header">
        <div>
            <span class="eyebrow">Pilotage</span>
            <h1>Tableau de bord</h1>
            <p>Suivez les demandes, les abonnés et les avis reçus depuis le site Zfinances.</p>
        </div>
        <div class="header-actions">
            <a class="btn btn-muted" href="https://www.zfinancesdrc.com/">Voir le site</a>
            <a class="btn" href="<?= \Router\Router::route('/admin/contacts') ?>">Traiter les messages</a>
        </div>
    </div>

    <div class="stats">

        <div class="card">
            <div class="card-icon">📩</div>
            <h3>Messages Contact</h3>
            <div class="number">
                <?= $totalContacts ? $totalContacts : 0 ?>
            </div>
            <p>Demandes envoyées depuis le formulaire.</p>
        </div>

        <div class="card">
            <div class="card-icon">📧</div>
            <h3>Newsletter</h3>
            <div class="number">
                <?= $totalSubscribers ? $totalSubscribers : 0 ?>
            </div>
            <p>Contacts inscrits aux communications.</p>
        </div>

        <div class="card">
            <div class="card-icon">⭐</div>
            <h3>Témoignages</h3>
            <div class="number">
                <?= $totalTestimonials ? $totalTestimonials : 0 ?>
            </div>
            <p>Avis clients publiés ou collectés.</p>
        </div>

        <div class="card">
            <div class="card-icon">●</div>
            <h3>Messages non lus</h3>
            <div class="number">
                <?= $unread ? $unread : 0 ?>
            </div>
            <p>Priorité de traitement pour l'équipe.</p>
        </div>

    </div>

</div>

</body>
</html>
