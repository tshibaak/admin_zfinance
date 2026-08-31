<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= htmlspecialchars($category->name, ENT_QUOTES, 'UTF-8') ?> — Catégorie</title>
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
            <div><span class="eyebrow">Organisation</span>
                <h1>Détail de la catégorie</h1>
                <p>Consultez les informations de classement.</p>
            </div>
            <div class="header-actions"><a class="btn btn-muted" href="<?= \Router\Router::route('/admin/categories') ?>"><i class="fa-solid fa-arrow-left" aria-hidden="true"></i> Retour aux catégories</a><a class="btn" href="<?= \Router\Router::route('/admin/categories/' . $category->id . '/edit') ?>"><i class="fa-solid fa-pen" aria-hidden="true"></i> Modifier</a></div>
        </header>
        <section class="category-detail" aria-labelledby="category-name"><span class="category-detail-icon"><i class="fa-solid fa-tag" aria-hidden="true"></i></span>
            <div>
                <p class="eyebrow">Catégorie #<?= htmlspecialchars((string) $category->id, ENT_QUOTES, 'UTF-8') ?></p>
                <h2 id="category-name"><?= htmlspecialchars($category->name, ENT_QUOTES, 'UTF-8') ?></h2>
                <p>Cette catégorie permet de regrouper les articles liés au même thème.</p>
            </div>
        </section>
    </main>
</body>

</html>