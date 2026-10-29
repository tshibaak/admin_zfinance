<header class="page-topbar">
    <div>
        <p class="page-kicker">Audience</p>
        <h1 class="page-title">Abonnés newsletter</h1>
        <p class="page-subtitle"><?= (int) $total ?> inscrit<?= (int) $total > 1 ? 's' : '' ?></p>
    </div>
    <div class="header-actions">
        <a class="btn" href="<?= \Router\Router::route('/admin/subscribers/create') ?>"><i class="fa-solid fa-plus" aria-hidden="true"></i> Ajouter</a>
    </div>
</header>

<section class="filter-bar" aria-label="Recherche abonnés">
    <form class="filter-form" method="get" action="<?= \Router\Router::route('/admin/subscribers') ?>">
        <div class="form-field filter-search">
            <label class="sr-only" for="q">Rechercher</label>
            <input id="q" name="q" type="search" placeholder="Rechercher un email…" value="<?= htmlspecialchars($filters['q'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
        </div>
        <button class="btn" type="submit"><i class="fa-solid fa-magnifying-glass" aria-hidden="true"></i> Chercher</button>
    </form>
</section>

<section class="crm-panel" aria-labelledby="subs-title">
    <div class="crm-panel-head">
        <h2 id="subs-title">Liste des abonnés</h2>
    </div>
    <div class="table-scroll" tabindex="0">
        <table class="responsive-table crm-table">
            <thead>
                <tr>
                    <th scope="col">Email</th>
                    <th scope="col">Date d’inscription</th>
                    <th scope="col"><span class="sr-only">Actions</span></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($subscribers as $sub): ?>
                    <tr>
                        <td data-label="Email">
                            <div class="crm-person">
                                <span class="crm-avatar" aria-hidden="true"><i class="fa-solid fa-envelope"></i></span>
                                <strong><?= htmlspecialchars($sub->email ?? '', ENT_QUOTES, 'UTF-8') ?></strong>
                            </div>
                        </td>
                        <td data-label="Date"><?= !empty($sub->created_at) ? htmlspecialchars(date('d/m/Y H:i', strtotime($sub->created_at)), ENT_QUOTES, 'UTF-8') : '—' ?></td>
                        <td data-label="Actions">
                            <div class="table-actions">
                                <a class="icon-button icon-button-edit" href="<?= \Router\Router::route('/admin/subscribers/' . $sub->id . '/edit') ?>" title="Modifier"><i class="fa-solid fa-pen" aria-hidden="true"></i></a>
                                <form method="post" action="<?= \Router\Router::route('/admin/subscribers/' . $sub->id . '/delete') ?>" onsubmit="return confirm('Supprimer cet abonné ?');">
                                    <button class="icon-button icon-button-delete" type="submit" title="Supprimer"><i class="fa-solid fa-trash" aria-hidden="true"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <?php if (empty($subscribers)): ?>
                    <tr><td colspan="3" class="empty-state">Aucun abonné newsletter pour le moment.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</section>
