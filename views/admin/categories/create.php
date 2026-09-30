<header class="header">
    <div>
        <span class="eyebrow">Organisation</span>
        <h1>Créer une catégorie</h1>
        <p>Ajoutez un repère clair pour classer vos articles.</p>
    </div>
    <div class="header-actions">
        <a class="btn btn-muted" href="<?= \Router\Router::route('/admin/categories') ?>">
            <i class="fa-solid fa-arrow-left" aria-hidden="true"></i> Retour aux catégories
        </a>
    </div>
</header>

<form class="category-form" action="<?= \Router\Router::route('/admin/categories/store') ?>" method="post">
    <section class="category-form-card" aria-labelledby="category-form-title">
        <div class="form-section-heading">
            <span class="form-section-icon"><i class="fa-solid fa-tag" aria-hidden="true"></i></span>
            <div>
                <h2 id="category-form-title">Informations de la catégorie</h2>
                <p>Choisissez un nom court, précis et facilement reconnaissable.</p>
            </div>
        </div>
        <div class="form-field">
            <label for="name">Nom de la catégorie <span aria-hidden="true">*</span></label>
            <input id="name" name="name" type="text" placeholder="Ex. Investissement" required>
            <small>Ce nom sera affiché aux lecteurs.</small>
        </div>
        <footer class="article-form-actions">
            <a class="btn btn-secondary" href="<?= \Router\Router::route('/admin/categories') ?>">Annuler</a>
            <button class="btn" type="submit">
                <i class="fa-solid fa-plus" aria-hidden="true"></i> Créer la catégorie
            </button>
        </footer>
    </section>
</form>
