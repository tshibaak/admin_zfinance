<header class="header">
    <div>
        <span class="eyebrow">Articles</span>
        <h1><?= htmlspecialchars($article->title ?: 'Article', ENT_QUOTES, 'UTF-8') ?></h1>
        <p>Aperçu détaillé du contenu sélectionné.</p>
    </div>
    <div class="header-actions">
        <a class="btn btn-muted" href="<?= \Router\Router::route('/admin/articles') ?>">
            <i class="fa-solid fa-arrow-left" aria-hidden="true"></i> Retour
        </a>
        <a class="btn" href="<?= \Router\Router::route('/admin/articles/' . $article->id . '/edit') ?>">
            <i class="fa-solid fa-pen" aria-hidden="true"></i> Modifier
        </a>
    </div>
</header>

<article class="resource-show" aria-labelledby="article-show-title">
    <header class="resource-show-header">
        <div>
            <h2 id="article-show-title"><?= htmlspecialchars($article->title ?: 'Sans titre', ENT_QUOTES, 'UTF-8') ?></h2>
            <p class="resource-meta">
                <?php if (($article->status ?? '') === 'published'): ?>
                    <span class="status-badge status-published">Publié</span>
                <?php else: ?>
                    <span class="status-badge status-pending">Brouillon</span>
                <?php endif; ?>
                <span><?= htmlspecialchars($article->category_name ?? 'Sans catégorie', ENT_QUOTES, 'UTF-8') ?></span>
                <span>Par <?= htmlspecialchars($article->author_name ?? '—', ENT_QUOTES, 'UTF-8') ?></span>
                <?php if (!empty($article->created_at)): ?>
                    <span>Le <?= htmlspecialchars(date('d/m/Y à H:i', strtotime($article->created_at)), ENT_QUOTES, 'UTF-8') ?></span>
                <?php endif; ?>
            </p>
        </div>
        <form method="post" action="<?= \Router\Router::route('/admin/articles/' . $article->id . '/delete') ?>" onsubmit="return confirm('Supprimer cet article ?');">
            <button type="submit" class="btn btn-danger">
                <i class="fa-solid fa-trash" aria-hidden="true"></i> Supprimer
            </button>
        </form>
    </header>

    <?php if (!empty($article->image)): ?>
        <figure class="resource-cover">
            <img src="<?= htmlspecialchars($article->image, ENT_QUOTES, 'UTF-8') ?>" alt="Image de couverture">
        </figure>
    <?php endif; ?>

    <?php if (!empty($article->excerpt)): ?>
        <section class="resource-excerpt" aria-label="Résumé">
            <p><?= nl2br(htmlspecialchars($article->excerpt, ENT_QUOTES, 'UTF-8')) ?></p>
        </section>
    <?php endif; ?>

    <section class="resource-body" aria-label="Contenu">
        <?= nl2br(htmlspecialchars($article->content ?? '', ENT_QUOTES, 'UTF-8')) ?>
    </section>

    <?php if (!empty($article->link)): ?>
        <footer class="resource-footer">
            <a class="btn btn-muted" href="<?= htmlspecialchars($article->link, ENT_QUOTES, 'UTF-8') ?>" target="_blank" rel="noopener noreferrer">
                <i class="fa-solid fa-arrow-up-right-from-square" aria-hidden="true"></i> Ouvrir le lien
            </a>
        </footer>
    <?php endif; ?>
</article>
