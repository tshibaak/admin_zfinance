<header class="page-topbar">
    <div>
        <p class="page-kicker">Organisation</p>
        <h1 class="page-title">Catégories</h1>
        <p class="page-subtitle">Structurez vos articles pour faciliter la navigation.</p>
    </div>
    <div class="header-actions">
        <a class="btn btn-muted" href="<?= \Router\Router::route('/admin/articles') ?>">
            <i class="fa-solid fa-briefcase" aria-hidden="true"></i> Portfolio
        </a>
        <a class="btn" href="<?= \Router\Router::route('/admin/categories/create') ?>">
            <i class="fa-solid fa-plus" aria-hidden="true"></i> Nouvelle catégorie
        </a>
    </div>
</header>

<section class="crm-panel" aria-labelledby="categories-table-title">
    <div class="crm-panel-head">
        <div>
            <h2 id="categories-table-title">Catégories disponibles</h2>
            <p class="page-subtitle" style="margin:4px 0 0"><?= count($categories) ?> catégorie<?= count($categories) > 1 ? 's' : '' ?></p>
        </div>
    </div>
    <div class="table-scroll" tabindex="0" aria-label="Liste des catégories">
        <table class="responsive-table crm-table">
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
                        <td data-label="Catégorie" class="user-name-cell">
                            <i class="fa-solid fa-tag category-tag-icon" aria-hidden="true"></i>
                            <?= htmlspecialchars($category->name, ENT_QUOTES, 'UTF-8') ?>
                        </td>
                        <td data-label="Actions">
                            <div class="table-actions">
                                <a class="icon-button icon-button-view" href="<?= \Router\Router::route('/admin/categories/' . $category->id . '/show') ?>" aria-label="Voir <?= htmlspecialchars($category->name, ENT_QUOTES, 'UTF-8') ?>" title="Voir">
                                    <i class="fa-solid fa-eye" aria-hidden="true"></i>
                                </a>
                                <a class="icon-button icon-button-edit" href="<?= \Router\Router::route('/admin/categories/' . $category->id . '/edit') ?>" aria-label="Modifier <?= htmlspecialchars($category->name, ENT_QUOTES, 'UTF-8') ?>" title="Modifier">
                                    <i class="fa-solid fa-pen" aria-hidden="true"></i>
                                </a>
                                <form method="post" action="<?= \Router\Router::route('/admin/categories/' . $category->id . '/delete') ?>" onsubmit="return confirm('Supprimer cette catégorie ? Les articles liés peuvent être impactés.');">
                                    <button type="submit" class="icon-button icon-button-delete" title="Supprimer" aria-label="Supprimer <?= htmlspecialchars($category->name, ENT_QUOTES, 'UTF-8') ?>">
                                        <i class="fa-solid fa-trash" aria-hidden="true"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <?php if (empty($categories)): ?>
                    <tr>
                        <td colspan="3" class="empty-state">Aucune catégorie trouvée. Créez votre première catégorie.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</section>
