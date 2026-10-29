<header class="page-topbar">
    <div>
        <p class="page-kicker">Relation client</p>
        <h1 class="page-title">Messages contact</h1>
        <p class="page-subtitle"><?= (int) $pendings ?> non lu<?= (int) $pendings > 1 ? 's' : '' ?> · <?= count($contacts) ?> affiché<?= count($contacts) > 1 ? 's' : '' ?></p>
    </div>
    <div class="header-actions">
        <a class="btn btn-muted" href="<?= \Router\Router::route('/admin/dashboard') ?>"><i class="fa-solid fa-arrow-left" aria-hidden="true"></i> Dashboard</a>
    </div>
</header>

<section class="filter-bar" aria-label="Filtres messages">
    <form class="filter-form" method="get" action="<?= \Router\Router::route('/admin/contacts') ?>">
        <div class="form-field filter-search">
            <label class="sr-only" for="q">Rechercher</label>
            <input id="q" name="q" type="search" placeholder="Nom, email, sujet…" value="<?= htmlspecialchars($filters['q'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
        </div>
        <div class="form-field">
            <label class="sr-only" for="statut">Statut</label>
            <select id="statut" name="statut">
                <option value="">Tous les statuts</option>
                <option value="non_lu" <?= ($filters['statut'] ?? '') === 'non_lu' ? 'selected' : '' ?>>Non lus</option>
                <option value="lu" <?= ($filters['statut'] ?? '') === 'lu' ? 'selected' : '' ?>>Lus</option>
            </select>
        </div>
        <button class="btn" type="submit"><i class="fa-solid fa-filter" aria-hidden="true"></i> Filtrer</button>
    </form>
</section>

<section class="crm-panel" aria-labelledby="contacts-title">
    <div class="crm-panel-head">
        <h2 id="contacts-title">Boîte de réception</h2>
    </div>
    <div class="table-scroll" tabindex="0">
        <table class="responsive-table crm-table">
            <thead>
                <tr>
                    <th scope="col">Contact</th>
                    <th scope="col">Sujet</th>
                    <th scope="col">Statut</th>
                    <th scope="col">Date</th>
                    <th scope="col"><span class="sr-only">Actions</span></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($contacts as $contact): ?>
                    <tr class="<?= ($contact->statut ?? '') === 'non_lu' ? 'row-unread' : '' ?>">
                        <td data-label="Contact">
                            <div class="crm-person">
                                <span class="crm-avatar" aria-hidden="true"><?= htmlspecialchars(strtoupper(substr($contact->name ?? '?', 0, 1)), ENT_QUOTES, 'UTF-8') ?></span>
                                <span>
                                    <strong><?= htmlspecialchars($contact->name ?? '', ENT_QUOTES, 'UTF-8') ?></strong>
                                    <small><?= htmlspecialchars($contact->email ?? '', ENT_QUOTES, 'UTF-8') ?></small>
                                </span>
                            </div>
                        </td>
                        <td data-label="Sujet" class="message-cell"><?= htmlspecialchars($contact->sujet ?? '', ENT_QUOTES, 'UTF-8') ?></td>
                        <td data-label="Statut">
                            <?php if (($contact->statut ?? '') === 'lu'): ?>
                                <span class="status-badge status-published">Lu</span>
                            <?php else: ?>
                                <span class="status-badge status-pending">Non lu</span>
                            <?php endif; ?>
                        </td>
                        <td data-label="Date"><?= !empty($contact->created_at) ? htmlspecialchars(date('d/m/Y H:i', strtotime($contact->created_at)), ENT_QUOTES, 'UTF-8') : '—' ?></td>
                        <td data-label="Actions">
                            <div class="table-actions">
                                <a class="icon-button icon-button-view" href="<?= \Router\Router::route('/admin/contacts/' . $contact->id . '/show') ?>" title="Voir"><i class="fa-solid fa-eye" aria-hidden="true"></i></a>
                                <?php if (($contact->statut ?? '') === 'non_lu'): ?>
                                    <form method="post" action="<?= \Router\Router::route('/admin/contacts/' . $contact->id . '/read') ?>">
                                        <button class="icon-button icon-button-muted" type="submit" title="Marquer lu"><i class="fa-solid fa-envelope-open" aria-hidden="true"></i></button>
                                    </form>
                                <?php else: ?>
                                    <form method="post" action="<?= \Router\Router::route('/admin/contacts/' . $contact->id . '/unread') ?>">
                                        <button class="icon-button icon-button-muted" type="submit" title="Marquer non lu"><i class="fa-solid fa-envelope" aria-hidden="true"></i></button>
                                    </form>
                                <?php endif; ?>
                                <form method="post" action="<?= \Router\Router::route('/admin/contacts/' . $contact->id . '/delete') ?>" onsubmit="return confirm('Supprimer ce message ?');">
                                    <button class="icon-button icon-button-delete" type="submit" title="Supprimer"><i class="fa-solid fa-trash" aria-hidden="true"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <?php if (empty($contacts)): ?>
                    <tr><td colspan="5" class="empty-state">Aucun message contact pour le moment.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</section>
