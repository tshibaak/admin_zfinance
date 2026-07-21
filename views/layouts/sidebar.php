<div class="sidebar">
    <h2>Zfinances Admin</h2>
    <ul>
        <li>
            <a class="active" href="<?= \Router\Router::route('/admin/dashboard') ?>">
                <i class="fas fa-tachometer-alt"></i> Dashboard
            </a>
        </li>

        <li>
            <a href="<?= \Router\Router::route('/admin/contacts') ?>">
                <i class="fas fa-envelope"></i> Messages Contact
            </a>
        </li>

        <li>
            <a href="<?= \Router\Router::route('/admin/subscribers') ?>">
                <i class="fas fa-paper-plane"></i> Newsletter
            </a>
        </li>

        <li>
            <a href="<?= \Router\Router::route('/admin/temoignages') ?>">
                <i class="fas fa-star"></i> Témoignages
            </a>
        </li>

        <li>
            <a href="<?= \Router\Router::route('/admin/users') ?>">
                <i class="fas fa-users"></i> Utilisateurs
            </a>
        </li>

        <li>
            <a href="<?= \Router\Router::route('/admin/articles') ?>">
                <i class="fas fa-newspaper"></i> Articles
            </a>
        </li>

        <li>
            <a href="https://www.zfinancesdrc.com/">
                <i class="fas fa-arrow-left"></i> Retour au site
            </a>
        </li>

        <li>
            <a href="<?= \Router\Router::route('/logout') ?>">
                <i class="fas fa-sign-out-alt"></i> Déconnexion
            </a>
        </li>
    </ul>
</div>
