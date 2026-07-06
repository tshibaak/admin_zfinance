<?php
if (!isset($testimonials)) {
    $testimonials = [];
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8"> return $this->connexion->query($request);
    <title>Témoignages</title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Témoignages - Zfinances Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>

<div class="sidebar">

    <h2>Zfinances Admin</h2>

    <ul>
        <li><a href="<?= \Router\Router::route('/admin/dashboard') ?>">🏠 Dashboard</a></li>
        <li><a href="<?= \Router\Router::route('/admin/contacts') ?>">📩 Messages Contact</a></li>
        <li><a href="<?= \Router\Router::route('/admin/newsletter') ?>">📧 Newsletter</a></li>
        <li><a class="active" href="<?= \Router\Router::route('/admin/testimonials') ?>">⭐ Témoignages</a></li>
        <li><a href="https://www.zfinancesdrc.com/">↩ Retour au site</a></li>
        <li><a href="<?= \Router\Router::route('/logout') ?>">🚪 Déconnexion</a></li>
    </ul>

</div>

<div class="main">

    <div class="header">
        <div>
            <span class="eyebrow">Réputation</span>
            <h1>Témoignages publics</h1>
            <p>Centralisez les retours clients et les notes affichées dans l'écosystème Zfinances.</p>
        </div>
        <div class="header-actions">
            <a class="btn btn-muted" href="<?= \Router\Router::route('/admin/dashboard') ?>">Retour dashboard</a>
        </div>
    </div>

    <div class="table-container">
        <div class="panel-title">
            <div>
                <h2>Avis clients</h2>
                <p><?= count($testimonials) ?> témoignage(s) enregistré(s).</p>
            </div>
        </div>

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

            <?php if (empty($testimonials)): ?>
                <tr>
                    <td class="empty-state" colspan="5">Aucun témoignage pour le moment.</td>
                </tr>
            <?php endif; ?>

            <?php foreach($testimonials as $testimonial): ?>

                <tr>
                    <td><?= htmlspecialchars($testimonial['author']) ?></td>
                    <td><?= htmlspecialchars($testimonial['company']) ?></td>
                    <td class="message-cell"><?= nl2br(htmlspecialchars($testimonial['message'])) ?></td>
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