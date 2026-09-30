<header class="page-topbar">
    <div>
        <p class="page-kicker">Réputation</p>
        <h1 class="page-title">Témoignages</h1>
        <p class="page-subtitle"><?= (int) $total ?> avis client<?= (int) $total > 1 ? 's' : '' ?></p>
    </div>
    <div class="header-actions">
        <a class="btn" href="<?= \Router\Router::route('/admin/temoignages/create') ?>"><i class="fa-solid fa-plus" aria-hidden="true"></i> Nouveau</a>
    </div>
</header>

<section class="filter-bar" aria-label="Recherche témoignages">
    <form class="filter-form" method="get" action="<?= \Router\Router::route('/admin/temoignages') ?>">
        <div class="form-field filter-search">
            <label class="sr-only" for="q">Rechercher</label>
            <input id="q" name="q" type="search" placeholder="Auteur, entreprise, message…" value="<?= htmlspecialchars($filters['q'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
        </div>
        <button class="btn" type="submit"><i class="fa-solid fa-magnifying-glass" aria-hidden="true"></i> Chercher</button>
    </form>
</section>

<section class="crm-panel" aria-labelledby="testimonials-title">
    <div class="crm-panel-head">
        <h2 id="testimonials-title">Avis clients</h2>
    </div>
    <div class="table-scroll" tabindex="0">
        <table class="responsive-table crm-table">
            <thead>
                <tr>
                    <th scope="col">Auteur</th>
                    <th scope="col">Entreprise</th>
                    <th scope="col">Message</th>
                    <th scope="col">Note</th>
                    <th scope="col">Date</th>
                    <th scope="col"><span class="sr-only">Actions</span></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($testimonials as $t): ?>
                    <tr>
                        <td data-label="Auteur">
                            <div class="crm-person">
                                <span class="crm-avatar" aria-hidden="true"><?= htmlspecialchars(strtoupper(substr($t->author ?? '?', 0, 1)), ENT_QUOTES, 'UTF-8') ?></span>
                                <strong><?= htmlspecialchars($t->author ?? '', ENT_QUOTES, 'UTF-8') ?></strong>
                            </div>
                        </td>
                        <td data-label="Entreprise"><?= htmlspecialchars($t->company ?? '—', ENT_QUOTES, 'UTF-8') ?></td>
                        <td data-label="Message" class="message-cell"><?= htmlspecialchars(mb_strimwidth($t->message ?? '', 0, 90, '…'), ENT_QUOTES, 'UTF-8') ?></td>
                        <td data-label="Note">
                            <span class="rating-pill" aria-label="<?= (int) ($t->rating ?? 0) ?> sur 5">
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <i class="fa-<?= $i <= (int) ($t->rating ?? 0) ? 'solid' : 'regular' ?> fa-star" aria-hidden="true"></i>
                                <?php endfor; ?>
                            </span>
                        </td>
                        <td data-label="Date"><?= !empty($t->created_at) ? htmlspecialchars(date('d/m/Y', strtotime($t->created_at)), ENT_QUOTES, 'UTF-8') : '—' ?></td>
                        <td data-label="Actions">
                            <div class="table-actions">
                                <a class="icon-button icon-button-view" href="<?= \Router\Router::route('/admin/temoignages/' . $t->id . '/show') ?>" title="Voir"><i class="fa-solid fa-eye" aria-hidden="true"></i></a>
                                <a class="icon-button icon-button-edit" href="<?= \Router\Router::route('/admin/temoignages/' . $t->id . '/edit') ?>" title="Modifier"><i class="fa-solid fa-pen" aria-hidden="true"></i></a>
                                <form method="post" action="<?= \Router\Router::route('/admin/temoignages/' . $t->id . '/delete') ?>" onsubmit="return confirm('Supprimer ce témoignage ?');">
                                    <button class="icon-button icon-button-delete" type="submit" title="Supprimer"><i class="fa-solid fa-trash" aria-hidden="true"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <?php if (empty($testimonials)): ?>
                    <tr><td colspan="6" class="empty-state">Aucun témoignage pour le moment.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</section>
