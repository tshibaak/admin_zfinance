<?php $categories = $categories ?? []; ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Catégories — Administration</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
    <?php require dirname(__DIR__, 2) . '/layouts/sidebar.php'; ?>
    <main class="main" id="main-content">
        <header class="header">
            <div><span class="eyebrow">Organisation</span>
                <h1>Catégories</h1>
                <p>Structurez vos articles pour faciliter la navigation de vos lecteurs.</p>
            </div>
            <div class="header-actions"><a class="btn btn-muted" href="<?= \Router\Router::route('/admin/articles') ?>"><i class="fa-solid fa-newspaper" aria-hidden="true"></i> Articles</a><a class="btn" href="<?= \Router\Router::route('/admin/categories/create') ?>"><i class="fa-solid fa-plus" aria-hidden="true"></i> Nouvelle catégorie</a></div>
        </header>
        <section class="table-container users-table" aria-labelledby="categories-table-title">
            <div class="table-heading">
                <div>
                    <h2 id="categories-table-title">Catégories disponibles</h2>
                    <p><?= count($categories) ?> catégorie<?= count($categories) > 1 ? 's' : '' ?> au total</p>
                </div>
            </div>
            <div class="table-scroll" tabindex="0" aria-label="Liste des catégories">
                <table class="responsive-table">
                    <caption class="sr-only">Liste des catégories d'articles</caption>
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nom de la catégorie</th>
                            <th scope="col"><span class="sr-only">Actions</span></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($categories as $category): ?>
                            <tr>
                                <td data-label="#"><?= htmlspecialchars((string) $category->id, ENT_QUOTES, 'UTF-8') ?></td>
                                <td data-label="Catégorie" class="user-name-cell"><i class="fa-solid fa-tag category-tag-icon" aria-hidden="true"></i><?= htmlspecialchars($category->name, ENT_QUOTES, 'UTF-8') ?></td>
                                <td data-label="Actions">
                                    <div class="table-actions">
                                        <a class="icon-button icon-button-view" href="<?= \Router\Router::route('/admin/categories/' . $category->id . '/show') ?>" aria-label="Voir <?= htmlspecialchars($category->name, ENT_QUOTES, 'UTF-8') ?>" title="Voir"><i class="fa-solid fa-eye" aria-hidden="true"></i></a>
                                        <a class="icon-button icon-button-edit" href="<?= \Router\Router::route('/admin/categories/' . $category->id . '/edit') ?>" aria-label="Modifier <?= htmlspecialchars($category->name, ENT_QUOTES, 'UTF-8') ?>" title="Modifier"><i class="fa-solid fa-pen" aria-hidden="true"></i></a>
                                        
                                    </div>
                                </td>

                            </tr>
                        <?php endforeach; ?>
                        <?php if (empty($categories)): ?><tr>
                                <td colspan="3" class="empty-state">Aucune catégorie trouvée. Créez votre première catégorie.</td>
                            </tr><?php endif; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</body>

</html>