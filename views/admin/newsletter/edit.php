<header class="page-topbar">
    <div>
        <p class="page-kicker">Audience</p>
        <h1 class="page-title">Modifier l’abonné</h1>
        <p class="page-subtitle">Mettre à jour l’adresse email.</p>
    </div>
    <div class="header-actions">
        <a class="btn btn-muted" href="<?= \Router\Router::route('/admin/subscribers') ?>"><i class="fa-solid fa-arrow-left" aria-hidden="true"></i> Retour</a>
    </div>
</header>

<form class="category-form" method="post" action="<?= \Router\Router::route('/admin/subscribers/' . $subscriber->id . '/update') ?>">
    <section class="category-form-card" aria-labelledby="sub-edit-title">
        <div class="form-section-heading">
            <span class="form-section-icon"><i class="fa-solid fa-envelope" aria-hidden="true"></i></span>
            <div>
                <h2 id="sub-edit-title">Email de l’abonné</h2>
            </div>
        </div>
        <div class="form-field">
            <label for="email">Adresse email <span aria-hidden="true">*</span></label>
            <input id="email" name="email" type="email" required value="<?= htmlspecialchars($subscriber->email ?? '', ENT_QUOTES, 'UTF-8') ?>">
        </div>
        <footer class="article-form-actions">
            <a class="btn btn-secondary" href="<?= \Router\Router::route('/admin/subscribers') ?>">Annuler</a>
            <button class="btn" type="submit"><i class="fa-solid fa-floppy-disk" aria-hidden="true"></i> Enregistrer</button>
        </footer>
    </section>
</form>
