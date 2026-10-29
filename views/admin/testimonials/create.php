<?php $old = $old ?? []; ?>
<header class="page-topbar">
    <div>
        <p class="page-kicker">Réputation</p>
        <h1 class="page-title">Nouveau témoignage</h1>
        <p class="page-subtitle">Ajoutez un avis client à publier.</p>
    </div>
    <div class="header-actions">
        <a class="btn btn-muted" href="<?= \Router\Router::route('/admin/temoignages') ?>"><i class="fa-solid fa-arrow-left" aria-hidden="true"></i> Retour</a>
    </div>
</header>

<form class="category-form" method="post" action="<?= \Router\Router::route('/admin/temoignages/store') ?>">
    <section class="category-form-card" aria-labelledby="testimonial-form-title">
        <div class="form-section-heading">
            <span class="form-section-icon"><i class="fa-solid fa-quote-left" aria-hidden="true"></i></span>
            <div>
                <h2 id="testimonial-form-title">Contenu du témoignage</h2>
                <p>Les champs marqués sont obligatoires.</p>
            </div>
        </div>
        <div class="form-field">
            <label for="author">Auteur <span aria-hidden="true">*</span></label>
            <input id="author" name="author" type="text" required value="<?= htmlspecialchars($old['author'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
        </div>
        <div class="form-field">
            <label for="company">Entreprise</label>
            <input id="company" name="company" type="text" value="<?= htmlspecialchars($old['company'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
        </div>
        <div class="form-field">
            <label for="rating">Note</label>
            <select id="rating" name="rating">
                <?php for ($i = 5; $i >= 1; $i--): ?>
                    <option value="<?= $i ?>" <?= ((int) ($old['rating'] ?? 5) === $i) ? 'selected' : '' ?>><?= $i ?> / 5</option>
                <?php endfor; ?>
            </select>
        </div>
        <div class="form-field">
            <label for="message">Message <span aria-hidden="true">*</span></label>
            <textarea id="message" name="message" rows="6" required><?= htmlspecialchars($old['message'] ?? '', ENT_QUOTES, 'UTF-8') ?></textarea>
        </div>
        <footer class="article-form-actions">
            <a class="btn btn-secondary" href="<?= \Router\Router::route('/admin/temoignages') ?>">Annuler</a>
            <button class="btn" type="submit"><i class="fa-solid fa-plus" aria-hidden="true"></i> Créer</button>
        </footer>
    </section>
</form>
