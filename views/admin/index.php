<header class="page-topbar">
    <div>
        <p class="page-kicker">Pilotage</p>
        <h1 class="page-title">Tableau de bord</h1>
        <p class="page-subtitle">Vue d’ensemble CRM — messages, audience et contenus Zfinances.</p>
    </div>
    <div class="header-actions">
        <a class="btn btn-muted" href="https://www.zfinancesdrc.com/" target="_blank" rel="noopener noreferrer">
            <i class="fa-solid fa-arrow-up-right-from-square" aria-hidden="true"></i> Voir le site
        </a>
        <a class="btn" href="<?= \Router\Router::route('/admin/contacts') ?>">
            <i class="fa-solid fa-inbox" aria-hidden="true"></i> Traiter les messages
        </a>
    </div>
</header>

<section class="crm-stats" aria-label="Indicateurs clés">
    <article class="crm-stat-card">
        <span class="crm-stat-icon crm-stat-blue" aria-hidden="true"><i class="fa-solid fa-envelope"></i></span>
        <div>
            <p class="crm-stat-label">Messages contact</p>
            <p class="crm-stat-value"><?= (int) ($totalContacts ?? 0) ?></p>
            <p class="crm-stat-hint">Demandes reçues</p>
        </div>
    </article>
    <article class="crm-stat-card">
        <span class="crm-stat-icon crm-stat-cyan" aria-hidden="true"><i class="fa-solid fa-paper-plane"></i></span>
        <div>
            <p class="crm-stat-label">Newsletter</p>
            <p class="crm-stat-value"><?= (int) ($totalSubscribers ?? 0) ?></p>
            <p class="crm-stat-hint">Abonnés actifs</p>
        </div>
    </article>
    <article class="crm-stat-card">
        <span class="crm-stat-icon crm-stat-amber" aria-hidden="true"><i class="fa-solid fa-star"></i></span>
        <div>
            <p class="crm-stat-label">Témoignages</p>
            <p class="crm-stat-value"><?= (int) ($totalTestimonials ?? 0) ?></p>
            <p class="crm-stat-hint">Avis clients</p>
        </div>
    </article>
    <article class="crm-stat-card">
        <span class="crm-stat-icon crm-stat-rose" aria-hidden="true"><i class="fa-solid fa-circle-exclamation"></i></span>
        <div>
            <p class="crm-stat-label">Non lus</p>
            <p class="crm-stat-value"><?= (int) ($unread ?? 0) ?></p>
            <p class="crm-stat-hint">À traiter en priorité</p>
        </div>
    </article>
    <article class="crm-stat-card">
        <span class="crm-stat-icon crm-stat-indigo" aria-hidden="true"><i class="fa-solid fa-briefcase"></i></span>
        <div>
            <p class="crm-stat-label">Portfolio</p>
            <p class="crm-stat-value"><?= (int) ($totalArticles ?? 0) ?></p>
            <p class="crm-stat-hint">Articles publiés / brouillons</p>
        </div>
    </article>
</section>

<div class="crm-dashboard-grid">
    <section class="crm-panel" aria-labelledby="recent-contacts-title">
        <div class="crm-panel-head">
            <h2 id="recent-contacts-title">Derniers messages</h2>
            <a class="text-link" href="<?= \Router\Router::route('/admin/contacts') ?>">Tout voir <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></a>
        </div>
        <ul class="crm-list">
            <?php foreach (($recentContacts ?? []) as $contact): ?>
                <li>
                    <a class="crm-list-item" href="<?= \Router\Router::route('/admin/contacts/' . $contact->id . '/show') ?>">
                        <span class="crm-avatar" aria-hidden="true"><?= htmlspecialchars(strtoupper(substr($contact->name ?? '?', 0, 1)), ENT_QUOTES, 'UTF-8') ?></span>
                        <span class="crm-list-body">
                            <strong><?= htmlspecialchars($contact->name ?? '', ENT_QUOTES, 'UTF-8') ?></strong>
                            <small><?= htmlspecialchars($contact->sujet ?? '', ENT_QUOTES, 'UTF-8') ?></small>
                        </span>
                        <?php if (($contact->statut ?? '') === 'non_lu'): ?>
                            <span class="status-badge status-pending">Non lu</span>
                        <?php else: ?>
                            <span class="status-badge status-published">Lu</span>
                        <?php endif; ?>
                    </a>
                </li>
            <?php endforeach; ?>
            <?php if (empty($recentContacts)): ?>
                <li class="empty-state-inline">Aucun message récent.</li>
            <?php endif; ?>
        </ul>
    </section>

    <section class="crm-panel" aria-labelledby="recent-testimonials-title">
        <div class="crm-panel-head">
            <h2 id="recent-testimonials-title">Derniers témoignages</h2>
            <a class="text-link" href="<?= \Router\Router::route('/admin/temoignages') ?>">Tout voir <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></a>
        </div>
        <ul class="crm-list">
            <?php foreach (($recentTestimonials ?? []) as $t): ?>
                <li>
                    <a class="crm-list-item" href="<?= \Router\Router::route('/admin/temoignages/' . $t->id . '/show') ?>">
                        <span class="crm-avatar" aria-hidden="true"><?= htmlspecialchars(strtoupper(substr($t->author ?? '?', 0, 1)), ENT_QUOTES, 'UTF-8') ?></span>
                        <span class="crm-list-body">
                            <strong><?= htmlspecialchars($t->author ?? '', ENT_QUOTES, 'UTF-8') ?></strong>
                            <small><?= htmlspecialchars(mb_strimwidth($t->message ?? '', 0, 70, '…'), ENT_QUOTES, 'UTF-8') ?></small>
                        </span>
                        <span class="rating-pill" aria-hidden="true">
                            <i class="fa-solid fa-star"></i> <?= (int) ($t->rating ?? 0) ?>
                        </span>
                    </a>
                </li>
            <?php endforeach; ?>
            <?php if (empty($recentTestimonials)): ?>
                <li class="empty-state-inline">Aucun témoignage récent.</li>
            <?php endif; ?>
        </ul>
    </section>
</div>
