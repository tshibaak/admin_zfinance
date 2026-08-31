<?php
$currentPath = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
$isCurrentPath = static fn(string $path): bool => $currentPath === $path || str_starts_with($currentPath, $path . '/');
$userRole = \Core\Session::role();
$userName = \Core\Session::userName();
?>

<button class="mobile-nav-toggle" type="button" aria-controls="adminSidebar" aria-expanded="false">
    <span class="sr-only">Ouvrir le menu de navigation</span>
    <i class="fa-solid fa-bars" aria-hidden="true"></i>
</button>
<div class="sidebar-backdrop" hidden></div>

<aside class="sidebar" id="adminSidebar" aria-label="Navigation d'administration">
    <header class="sidebar-brand">
        <a href="<?= \Router\Router::route('/admin/dashboard') ?>" aria-label="Zfinances, tableau de bord">
            <span class="sidebar-brand-mark" aria-hidden="true">Z</span>
            <span><strong>Zfinances</strong><small>Administration</small></span>
        </a>
    </header>

    <nav class="sidebar-nav" aria-label="Menu principal">
        <p class="sidebar-section-title">Espace de gestion</p>
        <ul>
            <?php if ($userRole === 'semi-admin'): ?>
                <li><a class="<?= $isCurrentPath('/admin/dashboard') ? 'active' : '' ?>" href="<?= \Router\Router::route('/admin/dashboard') ?>"><i class="fas fa-chart-pie" aria-hidden="true"></i><span>Tableau de bord</span></a></li>
                <li><a class="<?= $isCurrentPath('/admin/contacts') ? 'active' : '' ?>" href="<?= \Router\Router::route('/admin/contacts') ?>"><i class="fas fa-envelope" aria-hidden="true"></i><span>Messages contact</span></a></li>
                <li><a class="<?= $isCurrentPath('/admin/subscribers') ? 'active' : '' ?>" href="<?= \Router\Router::route('/admin/subscribers') ?>"><i class="fas fa-paper-plane" aria-hidden="true"></i><span>Newsletter</span></a></li>
                <li><a class="<?= $isCurrentPath('/admin/temoignages') ? 'active' : '' ?>" href="<?= \Router\Router::route('/admin/temoignages') ?>"><i class="fas fa-star" aria-hidden="true"></i><span>Témoignages</span></a></li>
                <li><a class="<?= $isCurrentPath('/admin/articles') ? 'active' : '' ?>" href="<?= \Router\Router::route('/admin/articles') ?>"><i class="fas fa-newspaper" aria-hidden="true"></i><span>Articles</span></a></li>
                <li><a class="<?= $isCurrentPath('/admin/categories') ? 'active' : '' ?>" href="<?= \Router\Router::route('/admin/categories') ?>"><i class="fas fa-tags" aria-hidden="true"></i><span>Catégories</span></a></li>
            <?php endif; ?>
            <?php if ($userRole === 'admin'): ?>
                <li><a class="<?= $isCurrentPath('/admin/users') ? 'active' : '' ?>" href="<?= \Router\Router::route('/admin/users') ?>"><i class="fas fa-users" aria-hidden="true"></i><span>Utilisateurs</span></a></li>
            <?php endif; ?>
        </ul>
    </nav>

    <footer class="sidebar-footer">
        <div class="sidebar-user" aria-label="Session active">
            <span class="sidebar-avatar" aria-hidden="true"><?= htmlspecialchars(strtoupper(substr($userName, 0, 1)), ENT_QUOTES, 'UTF-8') ?></span>
            <span><strong><?= htmlspecialchars($userName) ?></strong><small><?= htmlspecialchars($userRole ?: 'Administrateur') ?></small></span>
        </div>
        <ul class="sidebar-utility-links">
            <li><a href="https://www.zfinancesdrc.com/"><i class="fas fa-arrow-up-right-from-square" aria-hidden="true"></i><span>Voir le site</span></a></li>
            <li><a class="sidebar-logout" href="<?= \Router\Router::route('/logout') ?>"><i class="fas fa-right-from-bracket" aria-hidden="true"></i><span>Déconnexion</span></a></li>
        </ul>
    </footer>
</aside>

<script>
    (() => {
        const toggle = document.querySelector('.mobile-nav-toggle');
        const sidebar = document.querySelector('#adminSidebar');
        const backdrop = document.querySelector('.sidebar-backdrop');
        if (!toggle || !sidebar || !backdrop) return;
        const closeMenu = () => {
            sidebar.classList.remove('is-open');
            document.body.classList.remove('nav-open');
            toggle.setAttribute('aria-expanded', 'false');
            backdrop.hidden = true;
        };
        const openMenu = () => {
            sidebar.classList.add('is-open');
            document.body.classList.add('nav-open');
            toggle.setAttribute('aria-expanded', 'true');
            backdrop.hidden = false;
        };
        toggle.addEventListener('click', () => sidebar.classList.contains('is-open') ? closeMenu() : openMenu());
        backdrop.addEventListener('click', closeMenu);
        sidebar.querySelectorAll('a').forEach((link) => link.addEventListener('click', closeMenu));
        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape') closeMenu();
        });
    })();
</script>
