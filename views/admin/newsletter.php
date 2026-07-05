<?php
if (!isset($subscribers)) {
    $subscribers = [];
}
$subs = $subscribers;
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
<<<<<<< HEAD
    <title>Newsletter</title>
    <link rel="stylesheet" href="../../public/assets/css/admin.css">
=======
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Newsletter - Zfinances Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/admin.css">
>>>>>>> f31fb06 (refactor(dashboard): Modification du dashboard)
</head>

<body>

<div class="sidebar">

    <h2>Zfinances Admin</h2>

    <ul>
        <li><a href="/admin/dashboard">🏠 Dashboard</a></li>
        <li><a href="/admin/contacts">📩 Messages Contact</a></li>
        <li><a class="active" href="/admin/newsletter">📧 Newsletter</a></li>
        <li><a href="/admin/testimonials">⭐ Témoignages</a></li>
        <li><a href="/">↩ Retour au site</a></li>
        <li><a href="/logout">🚪 Déconnexion</a></li>
    </ul>

</div>

<div class="main">

    <div class="header">
        <div>
            <span class="eyebrow">Audience</span>
            <h1>Abonnés newsletter</h1>
            <p>Retrouvez les emails collectés depuis le formulaire d'inscription du site.</p>
        </div>
        <div class="header-actions">
            <a class="btn btn-muted" href="/admin/dashboard">Retour dashboard</a>
        </div>
    </div>

    <div class="table-container">
        <div class="panel-title">
            <div>
                <h2>Liste des abonnés</h2>
                <p><?= count($subs) ?> email(s) inscrit(s).</p>
            </div>
        </div>

        <table>

            <thead>
                <tr>
                    <th>Email</th>
                    <th>Date d'inscription</th>
                </tr>
            </thead>

            <tbody>

            <?php if (empty($subs)): ?>
                <tr>
                    <td class="empty-state" colspan="2">Aucun abonné newsletter pour le moment.</td>
                </tr>
            <?php endif; ?>

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
