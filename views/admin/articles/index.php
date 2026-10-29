<header class="page-topbar">
    <div>
        <p class="page-kicker">Portfolio</p>
        <h1 class="page-title">Articles</h1>
        <p class="page-subtitle">Gérez dynamiquement les contenus publiés sur le site.</p>
    </div>
    <div class="header-actions">
        <a class="btn btn-muted" href="<?= \Router\Router::route('/admin/categories') ?>">
            <i class="fa-solid fa-tags" aria-hidden="true"></i> Catégories
        </a>
        <a class="btn" href="<?= \Router\Router::route('/admin/articles/create') ?>">
            <i class="fa-solid fa-plus" aria-hidden="true"></i> Nouvel article
        </a>
    </div>
</header>

<section class="filter-bar" aria-label="Filtres des articles">
    <form class="filter-form" method="get" action="<?= \Router\Router::route('/admin/articles') ?>">
        <div class="form-field filter-search">
            <label for="q" class="sr-only">Rechercher</label>
            <input id="q" name="q" type="search" placeholder="Rechercher un titre, un résumé…" value="<?= htmlspecialchars($filters['q'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
        </div>
        <div class="form-field">
            <label for="status" class="sr-only">Statut</label>
            <select id="status" name="status">
                <option value="">Tous les statuts</option>
                <option value="pending" <?= ($filters['status'] ?? '') === 'pending' ? 'selected' : '' ?>>Brouillon</option>
                <option value="published" <?= ($filters['status'] ?? '') === 'published' ? 'selected' : '' ?>>Publié</option>
            </select>
        </div>
        <div class="form-field">
            <label for="category_id" class="sr-only">Catégorie</label>
            <select id="category_id" name="category_id">
                <option value="">Toutes les catégories</option>
                <?php foreach ($categories as $category): ?>
                    <option value="<?= (int) $category->id ?>" <?= ((string) ($filters['category_id'] ?? '') === (string) $category->id) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($category->name, ENT_QUOTES, 'UTF-8') ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <button class="btn" type="submit"><i class="fa-solid fa-filter" aria-hidden="true"></i> Filtrer</button>
        <?php if (!empty($filters['q']) || !empty($filters['status']) || !empty($filters['category_id'])): ?>
            <a class="btn btn-muted" href="<?= \Router\Router::route('/admin/articles') ?>">Réinitialiser</a>
        <?php endif; ?>
    </form>
</section>

<section class="crm-panel" aria-labelledby="articles-table-title">
    <div class="crm-panel-head">
        <div>
            <h2 id="articles-table-title">Liste des articles</h2>
            <p class="page-subtitle" style="margin:4px 0 0"><?= count($articles) ?> résultat<?= count($articles) > 1 ? 's' : '' ?></p>
        </div>
    </div>
    <div class="table-scroll" tabindex="0" aria-label="Liste des articles">
        <table class="responsive-table crm-table">
            <caption class="sr-only">Articles du portfolio</caption>
            <thead>
                <tr>
                    <th scope="col">Ordre</th>
                    <th scope="col">Titre</th>
                    <th scope="col">Catégorie</th>
                    <th scope="col">Statut</th>
                    <th scope="col">Auteur</th>
                    <th scope="col">Date</th>
                    <th scope="col"><span class="sr-only">Actions</span></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($articles as $article): ?>
                    <tr>
                        <td data-label="Ordre">
                            <div class="reorder-controls">
                                <form method="post" action="<?= \Router\Router::route('/admin/articles/' . $article->id . '/reorder') ?>">
                                    <input type="hidden" name="direction" value="up">
                                    <button type="submit" class="icon-button icon-button-muted" title="Monter" aria-label="Monter l’article">
                                        <i class="fa-solid fa-arrow-up" aria-hidden="true"></i>
                                    </button>
                                </form>
                                <span class="sort-order-value"><?= (int) $article->sort_order ?></span>
                                <form method="post" action="<?= \Router\Router::route('/admin/articles/' . $article->id . '/reorder') ?>">
                                    <input type="hidden" name="direction" value="down">
                                    <button type="submit" class="icon-button icon-button-muted" title="Descendre" aria-label="Descendre l’article">
                                        <i class="fa-solid fa-arrow-down" aria-hidden="true"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                        <td data-label="Titre" class="user-name-cell">
                            <?= htmlspecialchars($article->title ?: 'Sans titre', ENT_QUOTES, 'UTF-8') ?>
                        </td>
                        <td data-label="Catégorie">
                            <?= htmlspecialchars($article->category_name ?? '—', ENT_QUOTES, 'UTF-8') ?>
                        </td>
                        <td data-label="Statut">
                            <?php if (($article->status ?? '') === 'published'): ?>
                                <span class="status-badge status-published">Publié</span>
                            <?php else: ?>
                                <span class="status-badge status-pending">Brouillon</span>
                            <?php endif; ?>
                        </td>
                        <td data-label="Auteur"><?= htmlspecialchars($article->author_name ?? '—', ENT_QUOTES, 'UTF-8') ?></td>
                        <td data-label="Date">
                            <?= !empty($article->created_at) ? htmlspecialchars(date('d/m/Y', strtotime($article->created_at)), ENT_QUOTES, 'UTF-8') : '—' ?>
                        </td>
                        <td data-label="Actions">
                            <div class="table-actions">
                                <a class="icon-button icon-button-view" href="<?= \Router\Router::route('/admin/articles/' . $article->id . '/show') ?>" title="Voir" aria-label="Voir l’article">
                                    <i class="fa-solid fa-eye" aria-hidden="true"></i>
                                </a>
                                <a class="icon-button icon-button-edit" href="<?= \Router\Router::route('/admin/articles/' . $article->id . '/edit') ?>" title="Modifier" aria-label="Modifier l’article">
                                    <i class="fa-solid fa-pen" aria-hidden="true"></i>
                                </a>
                                <form method="post" action="<?= \Router\Router::route('/admin/articles/' . $article->id . '/delete') ?>" onsubmit="return confirm('Supprimer cet article ?');">
                                    <button type="submit" class="icon-button icon-button-delete" title="Supprimer" aria-label="Supprimer l’article">
                                        <i class="fa-solid fa-trash" aria-hidden="true"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <?php if (empty($articles)): ?>
                    <tr>
                        <td colspan="7" class="empty-state">Aucun article trouvé. Créez votre premier contenu.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</section>
