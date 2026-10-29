<?php
$old = $old ?? [];
?>
<header class="header">
    <div>
        <span class="eyebrow">Articles</span>
        <h1>Créer un article</h1>
        <p>Préparez et publiez un nouveau contenu pour votre site.</p>
    </div>
    <div class="header-actions">
        <a class="btn btn-muted" href="<?= \Router\Router::route('/admin/articles') ?>">
            <i class="fa-solid fa-arrow-left" aria-hidden="true"></i> Retour aux articles
        </a>
    </div>
</header>

<form class="article-form" action="<?= \Router\Router::route('/admin/articles/store') ?>" method="post" enctype="multipart/form-data">
    <section class="article-form-main" aria-labelledby="article-content-title">
        <div class="form-section-heading">
            <span class="form-section-icon"><i class="fa-solid fa-pen-nib" aria-hidden="true"></i></span>
            <div>
                <h2 id="article-content-title">Contenu de l’article</h2>
                <p>Les informations visibles par vos lecteurs.</p>
            </div>
        </div>
        <div class="form-field">
            <label for="title">Titre <span aria-hidden="true">*</span></label>
            <input id="title" name="title" type="text" placeholder="Ex. Comprendre les bases de l'investissement" value="<?= htmlspecialchars($old['title'] ?? '', ENT_QUOTES, 'UTF-8') ?>" required>
        </div>
        <div class="form-field">
            <label for="excerpt">Résumé</label>
            <textarea id="excerpt" name="excerpt" rows="3" placeholder="Présentez brièvement le sujet de l'article."><?= htmlspecialchars($old['excerpt'] ?? '', ENT_QUOTES, 'UTF-8') ?></textarea>
            <small>Ce texte peut être affiché dans la liste des articles.</small>
        </div>
        <div class="form-field">
            <label for="link">Lien externe (optionnel)</label>
            <input id="link" name="link" type="url" placeholder="https://…" value="<?= htmlspecialchars($old['link'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
        </div>
        <div class="form-field">
            <label for="content">Contenu <span aria-hidden="true">*</span></label>
            <textarea id="content" name="content" rows="13" placeholder="Rédigez votre article ici…" required><?= htmlspecialchars($old['content'] ?? '', ENT_QUOTES, 'UTF-8') ?></textarea>
        </div>
    </section>

    <aside class="article-form-sidebar" aria-label="Paramètres de publication">
        <section class="article-settings">
            <div class="form-section-heading">
                <span class="form-section-icon"><i class="fa-solid fa-sliders" aria-hidden="true"></i></span>
                <div>
                    <h2>Publication</h2>
                    <p>Choisissez le statut de l’article.</p>
                </div>
            </div>
            <div class="form-field">
                <label for="status">Statut</label>
                <select id="status" name="status">
                    <option value="pending" <?= ($old['status'] ?? 'pending') === 'pending' ? 'selected' : '' ?>>Brouillon</option>
                    <option value="published" <?= ($old['status'] ?? '') === 'published' ? 'selected' : '' ?>>Publier maintenant</option>
                </select>
            </div>
            <div class="form-field">
                <label for="category">Catégorie</label>
                <select id="category" name="category">
                    <option value="">Choisir une catégorie</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= (int) $category->id ?>" <?= ((string) ($old['category'] ?? '') === (string) $category->id) ? 'selected' : '' ?>>
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
                    <p>JPG, PNG ou WebP · max 5 Mo.</p>
                </div>
            </div>
            <label class="file-upload" for="cover-image">
                <i class="fa-solid fa-cloud-arrow-up" aria-hidden="true"></i>
                <span>Choisir une image</span>
                <small>Format recommandé : 1600 × 900 px</small>
            </label>
            <input id="cover-image" name="image" type="file" accept="image/*" class="sr-only">
        </section>
    </aside>

    <footer class="article-form-actions">
        <a class="btn btn-secondary" href="<?= \Router\Router::route('/admin/articles') ?>">Annuler</a>
        <button class="btn" type="submit">
            <i class="fa-solid fa-paper-plane" aria-hidden="true"></i> Enregistrer l’article
        </button>
    </footer>
</form>
