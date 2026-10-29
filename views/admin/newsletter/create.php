<?php $old = $old ?? []; ?>
<header class="page-topbar">
    <div>
        <p class="page-kicker">Audience</p>
        <h1 class="page-title">Ajouter un abonné</h1>
        <p class="page-subtitle">Inscription manuelle à la newsletter.</p>
    </div>
    <div class="header-actions">
        <a class="btn btn-muted" href="<?= \Router\Router::route('/admin/subscribers') ?>"><i class="fa-solid fa-arrow-left" aria-hidden="true"></i> Retour</a>
    </div>
</header>

<form class="category-form" method="post" action="<?= \Router\Router::route('/admin/subscribers/store') ?>">
    <section class="category-form-card" aria-labelledby="sub-form-title">
        <div class="form-section-heading">
            <span class="form-section-icon"><i class="fa-solid fa-paper-plane" aria-hidden="true"></i></span>
            <div>
                <h2 id="sub-form-title">Email de l’abonné</h2>
                <p>L’adresse doit être unique.</p>
            </div>
        </div>
        <div class="form-field">
            <label for="email">Adresse email <span aria-hidden="true">*</span></label>
            <input id="email" name="email" type="email" required placeholder="ex. client@entreprise.com" value="<?= htmlspecialchars($old['email'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
        </div>
        <footer class="article-form-actions">
            <a class="btn btn-secondary" href="<?= \Router\Router::route('/admin/subscribers') ?>">Annuler</a>
            <button class="btn" type="submit"><i class="fa-solid fa-plus" aria-hidden="true"></i> Ajouter</button>
        </footer>
    </section>
</form>
