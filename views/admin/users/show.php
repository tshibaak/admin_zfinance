<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= htmlspecialchars($user?->name, ENT_QUOTES, 'UTF-8') ?> — Utilisateur</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/admin.css">
</head>
<body>
<?php require dirname(__DIR__, 2) . '/layouts/sidebar.php'; ?>

<main class="main" id="main-content">
    <header class="header">
        <div>
            <span class="eyebrow">Utilisateurs</span>
            <h1>Fiche utilisateur</h1>
            <p>Consultez les informations du compte et gérez ses accès.</p>
        </div>
        <div class="header-actions">
            <a class="btn btn-muted" href="<?= \Router\Router::route('/admin/users') ?>"><i class="fa-solid fa-arrow-left" aria-hidden="true"></i> Retour à la liste</a>
            <a class="btn" href="<?= \Router\Router::route('/admin/users/' . $user->id . '/edit') ?>"><i class="fa-solid fa-pen" aria-hidden="true"></i> Modifier</a>
        </div>
    </header>

    <section class="user-profile" aria-labelledby="user-profile-title">
        <div class="user-profile-heading">
            <span class="user-profile-avatar" aria-hidden="true"><?= htmlspecialchars(strtoupper(substr($user->name, 0, 1)), ENT_QUOTES, 'UTF-8') ?></span>
            <div>
                <p class="eyebrow">Compte #<?= htmlspecialchars((string) $user->id, ENT_QUOTES, 'UTF-8') ?></p>
                <h2 id="user-profile-title"><?= htmlspecialchars($user->name, ENT_QUOTES, 'UTF-8') ?></h2>
                <p><?= htmlspecialchars($user->email, ENT_QUOTES, 'UTF-8') ?></p>
            </div>
            <span class="badge <?= $roleName === 'admin' ? 'badge-admin' : 'badge-read' ?>"><?= htmlspecialchars($roleName, ENT_QUOTES, 'UTF-8') ?></span>
        </div>

        <dl class="user-details">
            <div>
                <dt><i class="fa-solid fa-user" aria-hidden="true"></i> Nom complet</dt>
                <dd><?= htmlspecialchars($user->name, ENT_QUOTES, 'UTF-8') ?></dd>
            </div>
            <div>
                <dt><i class="fa-solid fa-envelope" aria-hidden="true"></i> Adresse e-mail</dt>
                <dd><a href="mailto:<?= htmlspecialchars($user->email, ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars($user->email, ENT_QUOTES, 'UTF-8') ?></a></dd>
            </div>
            <div>
                <dt><i class="fa-solid fa-shield-halved" aria-hidden="true"></i> Rôle</dt>
                <dd><?= htmlspecialchars($roleName, ENT_QUOTES, 'UTF-8') ?></dd>
            </div>
            <div>
                <dt><i class="fa-regular fa-calendar" aria-hidden="true"></i> Date de création</dt>
                <dd><?= !empty($user->created_at) ? htmlspecialchars(date('d/m/Y à H:i', strtotime($user->created_at)), ENT_QUOTES, 'UTF-8') : 'Non renseignée' ?></dd>
            </div>
        </dl>
    </section>
</main>
</body>
</html>
