<header class="header">
    <div>
        <span class="eyebrow">Organisation</span>
        <h1>Détail de la catégorie</h1>
        <p>Consultez les informations de classement.</p>
    </div>
    <div class="header-actions">
        <a class="btn btn-muted" href="<?= \Router\Router::route('/admin/categories') ?>">
            <i class="fa-solid fa-arrow-left" aria-hidden="true"></i> Retour aux catégories
        </a>
        <a class="btn" href="<?= \Router\Router::route('/admin/categories/' . $category->id . '/edit') ?>">
            <i class="fa-solid fa-pen" aria-hidden="true"></i> Modifier
        </a>
    </div>
</header>

<section class="category-detail" aria-labelledby="category-name">
    <span class="category-detail-icon"><i class="fa-solid fa-tag" aria-hidden="true"></i></span>
    <div>
        <p class="eyebrow">Catégorie #<?= htmlspecialchars((string) $category->id, ENT_QUOTES, 'UTF-8') ?></p>
        <h2 id="category-name"><?= htmlspecialchars($category->name, ENT_QUOTES, 'UTF-8') ?></h2>
        <p>Cette catégorie permet de regrouper les articles liés au même thème.</p>
    </div>
    <form method="post" action="<?= \Router\Router::route('/admin/categories/' . $category->id . '/delete') ?>" onsubmit="return confirm('Supprimer cette catégorie ?');">
        <button type="submit" class="btn btn-danger">
            <i class="fa-solid fa-trash" aria-hidden="true"></i> Supprimer
        </button>
    </form>
</section>
