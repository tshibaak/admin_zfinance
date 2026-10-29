<header class="header">
    <div>
        <span class="eyebrow">Articles</span>
        <h1>Modifier l’article</h1>
        <p>Mettez à jour le contenu avant sa publication.</p>
    </div>
    <div class="header-actions">
        <a class="btn btn-muted" href="<?= \Router\Router::route('/admin/articles') ?>">
            <i class="fa-solid fa-arrow-left" aria-hidden="true"></i> Retour aux articles
        </a>
    </div>
</header>

<form class="article-form" action="<?= \Router\Router::route('/admin/articles/' . $article->id . '/update') ?>" method="post" enctype="multipart/form-data">
    <section class="article-form-main" aria-labelledby="article-content-title">
        <div class="form-section-heading">
            <span class="form-section-icon"><i class="fa-solid fa-pen-nib" aria-hidden="true"></i></span>
            <div>
                <h2 id="article-content-title">Contenu de l’article</h2>
                <p>Modifiez les informations visibles par vos lecteurs.</p>
            </div>
        </div>
        <div class="form-field">
            <label for="title">Titre <span aria-hidden="true">*</span></label>
            <input id="title" name="title" type="text" value="<?= htmlspecialchars($article->title ?? '', ENT_QUOTES, 'UTF-8') ?>" required>
        </div>
        <div class="form-field">
            <label for="excerpt">Résumé</label>
            <textarea id="excerpt" name="excerpt" rows="3"><?= htmlspecialchars($article->excerpt ?? '', ENT_QUOTES, 'UTF-8') ?></textarea>
        </div>
        <div class="form-field">
            <label for="link">Lien externe (optionnel)</label>
            <input id="link" name="link" type="url" value="<?= htmlspecialchars($article->link ?? '', ENT_QUOTES, 'UTF-8') ?>" placeholder="https://…">
        </div>
        <div class="form-field">
            <label for="content">Contenu <span aria-hidden="true">*</span></label>
            <textarea id="content" name="content" rows="13" required><?= htmlspecialchars($article->content ?? '', ENT_QUOTES, 'UTF-8') ?></textarea>
        </div>
        <input type="hidden" name="sort_order" value="<?= (int) ($article->sort_order ?? 0) ?>">
    </section>

    <aside class="article-form-sidebar" aria-label="Paramètres de publication">
        <section class="article-settings">
            <div class="form-section-heading">
                <span class="form-section-icon"><i class="fa-solid fa-sliders" aria-hidden="true"></i></span>
                <div>
                    <h2>Publication</h2>
                    <p>Contrôlez la visibilité de l’article.</p>
                </div>
            </div>
            <div class="form-field">
                <label for="status">Statut</label>
                <select id="status" name="status">
                    <option value="pending" <?= ($article->status ?? '') === 'pending' ? 'selected' : '' ?>>Brouillon</option>
                    <option value="published" <?= ($article->status ?? '') === 'published' ? 'selected' : '' ?>>Publié</option>
                </select>
            </div>
            <div class="form-field">
                <label for="category">Catégorie</label>
                <select id="category" name="category">
                    <option value="">Choisir une catégorie</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= (int) $category->id ?>" <?= ((int) ($article->category_id ?? 0) === (int) $category->id) ? 'selected' : '' ?>>
                            <?= htmlspecialchars(ucfirst($category->name), ENT_QUOTES, 'UTF-8') ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </section>
        <section class="article-settings">
            <div class="form-section-heading">
                <span class="form-section-icon"><i class="fa-regular fa-image" aria-hidden="true"></i></span>
                <div>
                    <h2>Image de couverture</h2>
                    <p>Remplacez l’image si nécessaire.</p>
                </div>
            </div>
            <?php if (!empty($article->image)): ?>
                <div class="cover-preview">
                    <img src="<?= htmlspecialchars($article->image, ENT_QUOTES, 'UTF-8') ?>" alt="Couverture actuelle">
                </div>
            <?php endif; ?>
            <label class="file-upload" for="cover-image">
                <i class="fa-solid fa-cloud-arrow-up" aria-hidden="true"></i>
                <span><?= !empty($article->image) ? 'Remplacer l’image' : 'Choisir une image' ?></span>
                <small>JPG, PNG ou WebP · max 5 Mo</small>
            </label>
            <input id="cover-image" name="image" type="file" accept="image/*" class="sr-only">
        </section>
    </aside>

    <footer class="article-form-actions">
        <a class="btn btn-secondary" href="<?= \Router\Router::route('/admin/articles') ?>">Annuler</a>
        <button class="btn" type="submit">
            <i class="fa-solid fa-floppy-disk" aria-hidden="true"></i> Enregistrer les modifications
        </button>
    </footer>
</form>
