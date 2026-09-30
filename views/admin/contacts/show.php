<header class="page-topbar">
    <div>
        <p class="page-kicker">Relation client</p>
        <h1 class="page-title">Détail du message</h1>
        <p class="page-subtitle">Reçu le <?= !empty($contact->created_at) ? htmlspecialchars(date('d/m/Y à H:i', strtotime($contact->created_at)), ENT_QUOTES, 'UTF-8') : '—' ?></p>
    </div>
    <div class="header-actions">
        <a class="btn btn-muted" href="<?= \Router\Router::route('/admin/contacts') ?>"><i class="fa-solid fa-arrow-left" aria-hidden="true"></i> Retour</a>
        <form method="post" action="<?= \Router\Router::route('/admin/contacts/' . $contact->id . '/delete') ?>" onsubmit="return confirm('Supprimer ce message ?');">
            <button class="btn btn-danger" type="submit"><i class="fa-solid fa-trash" aria-hidden="true"></i> Supprimer</button>
        </form>
    </div>
</header>

<article class="resource-show">
    <header class="resource-show-header">
        <div class="crm-person">
            <span class="crm-avatar crm-avatar-lg" aria-hidden="true"><?= htmlspecialchars(strtoupper(substr($contact->name ?? '?', 0, 1)), ENT_QUOTES, 'UTF-8') ?></span>
            <span>
                <h2 id="contact-name"><?= htmlspecialchars($contact->name ?? '', ENT_QUOTES, 'UTF-8') ?></h2>
                <p class="resource-meta">
                    <?php if (($contact->statut ?? '') === 'lu'): ?>
                        <span class="status-badge status-published">Lu</span>
                    <?php else: ?>
                        <span class="status-badge status-pending">Non lu</span>
                    <?php endif; ?>
                    <span><?= htmlspecialchars($contact->email ?? '', ENT_QUOTES, 'UTF-8') ?></span>
                    <?php if (!empty($contact->phone)): ?>
                        <span><?= htmlspecialchars($contact->phone, ENT_QUOTES, 'UTF-8') ?></span>
                    <?php endif; ?>
                </p>
            </span>
        </div>
    </header>

    <section class="detail-grid" aria-label="Métadonnées">
        <dl>
            <div>
                <dt>Sujet</dt>
                <dd><?= htmlspecialchars($contact->sujet ?? '', ENT_QUOTES, 'UTF-8') ?></dd>
            </div>
        </dl>
    </section>

    <section class="resource-body" aria-label="Message">
        <?= nl2br(htmlspecialchars($contact->message ?? '', ENT_QUOTES, 'UTF-8')) ?>
    </section>
</article>
