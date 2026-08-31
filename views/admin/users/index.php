<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Utilisateurs - Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body class="antialiased bg-gray-50">

<?php require dirname(__DIR__,2) . '/layouts/sidebar.php'; ?>

<main class="main">
    <div class="header">
        <div>
            <span class="eyebrow">Utilisateurs</span>
            <h1>Liste des utilisateurs</h1>
            <p>Gestion des comptes utilisateurs enregistrés.</p>
        </div>
          <div class="header-actions">
            <a class="btn btn-muted" href="<?= \Router\Router::route('/admin/users/create') ?>">Nouvel administrateur</a>
        </div>
    </div>

    <section class="table-container users-table" aria-labelledby="users-table-title">
        <div class="table-heading">
            <div>
                <h2 id="users-table-title">Comptes enregistrés</h2>
                <p><?= count($users) ?> utilisateur<?= count($users) > 1 ? 's' : '' ?> au total</p>
            </div>
        </div>
        <div class="table-scroll" tabindex="0" aria-label="Faites défiler horizontalement pour afficher toutes les colonnes">
            <table class="responsive-table">
                <caption class="sr-only">Liste des utilisateurs et actions disponibles</caption>
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Email</th>
                        <th scope="col">Rôle</th>
                        <th scope="col">Inscrit le</th>
                        <th scope="col"><span class="sr-only">Actions</span></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td data-label="#"><?= htmlspecialchars($user->id) ?></td>
                            <td data-label="Nom" class="user-name-cell"><?= htmlspecialchars(($user?->name)) ?></td>
                            <td data-label="Email"><a class="table-email" href="mailto:<?= htmlspecialchars($user->email) ?>"><?= htmlspecialchars($user->email) ?></a></td>
                            <td data-label="Rôle"><span class="badge <?= $roles->getRole($user->role_id) === 'admin' ? 'badge-admin' : 'badge-read' ?>"><?= htmlspecialchars($roles->getRole($user?->role_id)) ?></span></td>
                            <td data-label="Inscrit le"><?= htmlspecialchars($user?->created_at) ?></td>
                            <td data-label="Actions">
                                <div class="table-actions">
                                    <a title="Voir <?= htmlspecialchars($user->name) ?>" aria-label="Voir <?= htmlspecialchars($user->name) ?>" class="icon-button icon-button-view" href="<?= \Router\Router::route('/admin/users/'.$user->id.'/show') ?>"><i class="fa-solid fa-eye" aria-hidden="true"></i></a>
                                <?php if ($roles->getRole($user->role_id) != 'admin' || (\Core\Session::ensureRole('admin', $_SESSION['user']['role']) && \Core\Session::userId() == $user->id)): ?>
                                    <a title="Modifier <?= htmlspecialchars($user->name) ?>" aria-label="Modifier <?= htmlspecialchars($user->name) ?>" class="icon-button icon-button-edit" href="<?= \Router\Router::route('/admin/users/'.$user->id.'/edit') ?>"><i class="fa-solid fa-pen-to-square" aria-hidden="true"></i></a>
                                <?php endif; ?>

                                <?php if (\Core\Session::ensureRole('admin', $_SESSION['user']['role']) && \Core\Session::userId() != $user->id && $roles?->getRole($user->role_id) != 'admin'): ?>
                                    <form action="<?= \Router\Router::route('/admin/users/'.$user->id.'/delete') ?>" method="POST">
                                        <button title="Supprimer <?= htmlspecialchars($user->name) ?>" aria-label="Supprimer <?= htmlspecialchars($user->name) ?>" type="submit" class="icon-button icon-button-delete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');"><i class="fa-solid fa-trash" aria-hidden="true"></i></button>
                                    </form>
                                <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <?php if (empty($users)): ?>
                        <tr>
                            <td colspan="6" class="empty-state">Aucun utilisateur trouvé.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </section>

</main>

</body>
</html>
