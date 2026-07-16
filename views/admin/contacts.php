<?php
if (!isset($contacts) && !isset($pendings)) {
    $contacts = [];
    $pendings = 0;
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <link rel="stylesheet" href="/public/css/admin.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Messages contact - Zfinances Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>

    <div class="sidebar">

        <h2>Zfinances Admin</h2>

        <ul>

        <li>
            <a href="<?= \Router\Router::route('/admin/dashboard') ?>">🏠 Dashboard</a>
        </li>

        <li>
            <a class="active" href="<?= \Router\Router::route('/admin/contacts') ?>">📩 Messages Contact (<?= $pendings ?? 0  ?>)</a>
        </li>

        <li>
            <a href="<?= \Router\Router::route('/admin/subscribers') ?>">📧 Newsletter</a>
        </li>

        <li>
            <a href="<?= \Router\Router::route('/admin/temoignages') ?>">⭐ Témoignages</a>
        </li>

        <li>
            <a href="https://www.zfinancesdrc.com/">↩ Retour au site</a>
        </li>

        <li>
            <a href="<?= \Router\Router::route('/logout') ?>">🚪 Déconnexion</a>
        </li>

        </ul>

    </div>
<div class="main">

    <div class="header">
        <div>
            <span class="eyebrow">Relation client</span>
            <h1>Messages contact</h1>
            <p>Consultez les demandes reçues et marquez automatiquement les messages comme lus à l'ouverture.</p>
        </div>
        <div class="header-actions">
            <a class="btn btn-muted" href="<?= \Router\Router::route('/admin/dashboard') ?>">Retour dashboard</a>
        </div>
    </div>

    <div class="table-container">
        <div class="panel-title">
            <div>
                <h2>Demandes reçues</h2>
                <p><?= count($contacts ?? 0) ?> message(s) dans la boîte de réception.</p>
            </div>
        </div>

        <table>

            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Sujet</th>
                    <th>Statut</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>

            <?php if (empty($contacts)): ?>
                <tr>
                    <td class="empty-state" colspan="6">Aucun message contact pour le moment.</td>
                </tr>
            <?php endif; ?>

            <?php foreach($contacts ?? [] as $contact): ?>

                <tr>

                    <td><?= htmlspecialchars($contact['name']) ?></td>

                    <td><?= htmlspecialchars($contact['email']) ?></td>

                    <td class="message-cell"><?= htmlspecialchars($contact['sujet']) ?></td>

                    <td>
                        <?php if($contact['statut']=="lu"): ?>
                            <span class="badge badge-read">
                                Lu
                            </span>
                        <?php else: ?>

                            <span class="badge badge-unread">
                                Non lu
                            </span>

                        <?php endif; ?>
                    </td>

                    <td><?= date('d/m/Y H:i', strtotime($contact['created_at'])) ?></td>
                    <td>
                        <button
                            class="action-btn btn-view"
                            data-id="<?= $contact['id'] ?>"
                            data-nom="<?= htmlspecialchars($contact['name'], ENT_QUOTES, 'UTF-8') ?>"
                            data-email="<?= htmlspecialchars($contact['email'], ENT_QUOTES, 'UTF-8') ?>"
                            data-tel="<?= htmlspecialchars($contact['phone'], ENT_QUOTES, 'UTF-8') ?>"
                            data-message="<?= htmlspecialchars($contact['message'], ENT_QUOTES, 'UTF-8') ?>"
                        >
                            Voir
                        </button>
                    </td>

                </tr>

            <?php endforeach; ?>

            </tbody>

        </table>
    </div>

    <!-- POPUP -->

    <div id="messageModal" class="modal">

        <div class="modal-content">

            <span class="close" onclick="closeModal()">
                &times;
            </span>

            <h2>Détails du message</h2>

            <hr>

            <p>
                <strong>Nom :</strong>
                <span id="modalNom"></span>
            </p>

            <p>
                <strong>Email :</strong>
                <span id="modalEmail"></span>
            </p>

            <p>
                <strong>Téléphone :</strong>
                <span id="modalTel"></span>
            </p>

            <br>

            <p id="modalMessage"></p>

        </div>

    </div>

    <script>
        // Modal helpers
        function openModal() {
            document.getElementById('messageModal').style.display = 'block';
        }
        function closeModal() {
            document.getElementById('messageModal').style.display = 'none';
        }

        document.querySelectorAll('.btn-view').forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.dataset.id;
                const nom = this.dataset.nom;
                const email = this.dataset.email;
                const tel = this.dataset.tel;
                const message = this.dataset.message;

                document.getElementById('modalNom').textContent = nom;
                document.getElementById('modalEmail').textContent = email;
                document.getElementById('modalTel').textContent = tel;
                document.getElementById('modalMessage').textContent = message;

                openModal();

                // mark as read
                fetch(`/api/contacts/${id}/read`, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                })
                .then(res => res.text())
                .then(res => {
                    if (res === 'ok') {
                        const badge = btn.closest('tr').querySelector('.badge');
                        if (badge) { badge.textContent = 'Lu'; badge.classList.remove('badge-unread'); badge.classList.add('badge-read'); }
                    }
                });
            });
        });

        // close when clicking outside
        document.getElementById('messageModal').addEventListener('click', function(event) {
            if (event.target === this) closeModal();
        });
    </script>

</body>


</html>
