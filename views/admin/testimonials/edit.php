<header class="page-topbar">
    <div>
        <p class="page-kicker">Réputation</p>
        <h1 class="page-title">Modifier le témoignage</h1>
        <p class="page-subtitle">Mettez à jour l’avis client.</p>
    </div>
    <div class="header-actions">
        <a class="btn btn-muted" href="<?= \Router\Router::route('/admin/temoignages') ?>"><i class="fa-solid fa-arrow-left" aria-hidden="true"></i> Retour</a>
    </div>
</header>

<form class="category-form" method="post" action="<?= \Router\Router::route('/admin/temoignages/' . $testimonial->id . '/update') ?>">
    <section class="category-form-card" aria-labelledby="testimonial-edit-title">
        <div class="form-section-heading">
            <span class="form-section-icon"><i class="fa-solid fa-quote-left" aria-hidden="true"></i></span>
            <div>
                <h2 id="testimonial-edit-title">Contenu du témoignage</h2>
            </div>
        </div>
        <div class="form-field">
            <label for="author">Auteur <span aria-hidden="true">*</span></label>
            <input id="author" name="author" type="text" required value="<?= htmlspecialchars($testimonial->author ?? '', ENT_QUOTES, 'UTF-8') ?>">
        </div>
        <div class="form-field">
            <label for="company">Entreprise</label>
            <input id="company" name="company" type="text" value="<?= htmlspecialchars($testimonial->company ?? '', ENT_QUOTES, 'UTF-8') ?>">
        </div>
        <div class="form-field">
            <label for="rating">Note</label>
            <select id="rating" name="rating">
                <?php for ($i = 5; $i >= 1; $i--): ?>
                    <option value="<?= $i ?>" <?= ((int) ($testimonial->rating ?? 5) === $i) ? 'selected' : '' ?>><?= $i ?> / 5</option>
                <?php endfor; ?>
            </select>
        </div>
        <div class="form-field">
            <label for="message">Message <span aria-hidden="true">*</span></label>
            <textarea id="message" name="message" rows="6" required><?= htmlspecialchars($testimonial->message ?? '', ENT_QUOTES, 'UTF-8') ?></textarea>
        </div>
        <footer class="article-form-actions">
            <a class="btn btn-secondary" href="<?= \Router\Router::route('/admin/temoignages') ?>">Annuler</a>
            <button class="btn" type="submit"><i class="fa-solid fa-floppy-disk" aria-hidden="true"></i> Enregistrer</button>
        </footer>
    </section>
</form>
