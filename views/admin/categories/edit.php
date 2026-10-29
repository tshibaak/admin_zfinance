<header class="header">
    <div>
        <span class="eyebrow">Organisation</span>
        <h1>Modifier une catégorie</h1>
        <p>Mettez à jour son intitulé.</p>
    </div>
    <div class="header-actions">
        <a class="btn btn-muted" href="<?= \Router\Router::route('/admin/categories') ?>">
            <i class="fa-solid fa-arrow-left" aria-hidden="true"></i> Retour aux catégories
        </a>
    </div>
</header>

<form class="category-form" action="<?= \Router\Router::route('/admin/categories/' . $category->id . '/update') ?>" method="post">
    <section class="category-form-card" aria-labelledby="category-form-title">
        <div class="form-section-heading">
            <span class="form-section-icon"><i class="fa-solid fa-tag" aria-hidden="true"></i></span>
            <div>
                <h2 id="category-form-title">Informations de la catégorie</h2>
                <p>Les changements seront visibles dans le classement des articles.</p>
            </div>
        </div>
        <div class="form-field">
            <label for="name">Nom de la catégorie <span aria-hidden="true">*</span></label>
            <input id="name" name="name" type="text" value="<?= htmlspecialchars($category->name, ENT_QUOTES, 'UTF-8') ?>" required>
        </div>
        <footer class="article-form-actions">
            <a class="btn btn-secondary" href="<?= \Router\Router::route('/admin/categories') ?>">Annuler</a>
            <button class="btn" type="submit">
                <i class="fa-solid fa-floppy-disk" aria-hidden="true"></i> Enregistrer les modifications
            </button>
        </footer>
    </section>
</form>
