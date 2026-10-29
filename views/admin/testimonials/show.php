<header class="page-topbar">
    <div>
        <p class="page-kicker">Réputation</p>
        <h1 class="page-title">Détail du témoignage</h1>
    </div>
    <div class="header-actions">
        <a class="btn btn-muted" href="<?= \Router\Router::route('/admin/temoignages') ?>"><i class="fa-solid fa-arrow-left" aria-hidden="true"></i> Retour</a>
        <a class="btn" href="<?= \Router\Router::route('/admin/temoignages/' . $testimonial->id . '/edit') ?>"><i class="fa-solid fa-pen" aria-hidden="true"></i> Modifier</a>
    </div>
</header>

<article class="resource-show">
    <header class="resource-show-header">
        <div class="crm-person">
            <span class="crm-avatar crm-avatar-lg" aria-hidden="true"><?= htmlspecialchars(strtoupper(substr($testimonial->author ?? '?', 0, 1)), ENT_QUOTES, 'UTF-8') ?></span>
            <span>
                <h2><?= htmlspecialchars($testimonial->author ?? '', ENT_QUOTES, 'UTF-8') ?></h2>
                <p class="resource-meta">
                    <span><?= htmlspecialchars($testimonial->company ?: 'Sans entreprise', ENT_QUOTES, 'UTF-8') ?></span>
                    <span class="rating-pill">
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <i class="fa-<?= $i <= (int) ($testimonial->rating ?? 0) ? 'solid' : 'regular' ?> fa-star" aria-hidden="true"></i>
                        <?php endfor; ?>
                    </span>
                    <?php if (!empty($testimonial->created_at)): ?>
                        <span><?= htmlspecialchars(date('d/m/Y', strtotime($testimonial->created_at)), ENT_QUOTES, 'UTF-8') ?></span>
                    <?php endif; ?>
                </p>
            </span>
        </div>
        <form method="post" action="<?= \Router\Router::route('/admin/temoignages/' . $testimonial->id . '/delete') ?>" onsubmit="return confirm('Supprimer ce témoignage ?');">
            <button class="btn btn-danger" type="submit"><i class="fa-solid fa-trash" aria-hidden="true"></i> Supprimer</button>
        </form>
    </header>
    <section class="resource-excerpt" aria-label="Message">
        <p><?= nl2br(htmlspecialchars($testimonial->message ?? '', ENT_QUOTES, 'UTF-8')) ?></p>
    </section>
</article>
