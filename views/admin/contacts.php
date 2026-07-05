<?php
if (!isset($contacts)) {
    $contacts = [];
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
<<<<<<< HEAD
    <link rel="stylesheet" href="../../public/assets/css/admin.css">
=======
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Messages contact - Zfinances Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/admin.css">
>>>>>>> f31fb06 (refactor(dashboard): Modification du dashboard)
</head>

<body>

    <div class="sidebar">

<<<<<<< HEAD
        <h2>ADMIN</h2>
=======
    <h2>Zfinances Admin</h2>
>>>>>>> f31fb06 (refactor(dashboard): Modification du dashboard)

        <ul>

<<<<<<< HEAD
            <li>
                <a href="dashboard.php">🏠 Dashboard</a>
            </li>

            <li>
                <a href="contacts.php">📩 Messages Contact(<?= count($contacts) ?>)</a>
            </li>

            <li>
                <a href="newsletter.php">📧 Newsletter</a>
            </li>

            <li>
                <a href="testimonials.php">⭐ Témoignages</a>
            </li>

            <li>
                <a href="../../index.php?q=accueil">↩ Retour au site</a>
            </li>

            <li>
                <a href="logout.php">🚪 Déconnexion</a>
            </li>
=======
        <li>
            <a href="/admin/dashboard">🏠 Dashboard</a>
        </li>

        <li>
            <a class="active" href="/admin/contacts">📩 Messages Contact (<?= count($contacts) ?>)</a>
        </li>

        <li>
            <a href="/admin/newsletter">📧 Newsletter</a>
        </li>

        <li>
            <a href="/admin/testimonials">⭐ Témoignages</a>
        </li>

        <li>
            <a href="/">↩ Retour au site</a>
        </li>

        <li>
            <a href="/logout">🚪 Déconnexion</a>
        </li>
>>>>>>> f31fb06 (refactor(dashboard): Modification du dashboard)

        </ul>

<<<<<<< HEAD
=======
</div>
<div class="main">

    <div class="header">
        <div>
            <span class="eyebrow">Relation client</span>
            <h1>Messages contact</h1>
            <p>Consultez les demandes reçues et marquez automatiquement les messages comme lus à l'ouverture.</p>
        </div>
        <div class="header-actions">
            <a class="btn btn-muted" href="/admin/dashboard">Retour dashboard</a>
        </div>
    </div>

    <div class="table-container">
        <div class="panel-title">
            <div>
                <h2>Demandes reçues</h2>
                <p><?= count($contacts) ?> message(s) dans la boîte de réception.</p>
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

            <?php foreach($contacts as $contact): ?>

                <tr>

                    <td><?= htmlspecialchars($contact['nom']) ?></td>

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
    data-nom="<?= htmlspecialchars($contact['nom'], ENT_QUOTES, 'UTF-8') ?>"
    data-email="<?= htmlspecialchars($contact['email'], ENT_QUOTES, 'UTF-8') ?>"
    data-tel="<?= htmlspecialchars($contact['telephone'], ENT_QUOTES, 'UTF-8') ?>"
    data-message="<?= htmlspecialchars($contact['message'], ENT_QUOTES, 'UTF-8') ?>"
>
    Voir
</button>

                    </td>

                </tr>

            <?php endforeach; ?>

            </tbody>

        </table>
>>>>>>> f31fb06 (refactor(dashboard): Modification du dashboard)
    </div>
    <div class="main">

        <div class="table-container">
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

                    <?php foreach ($contacts as $contact): ?>

                        <tr>

                            <td><?= htmlspecialchars($contact['nom']) ?></td>

                            <td><?= htmlspecialchars($contact['email']) ?></td>

                            <td><?= htmlspecialchars($contact['sujet']) ?></td>

                            <td>

                                <?php if ($contact['statut'] == "lu"): ?>

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
                                    data-nom="<?= htmlspecialchars($contact['nom'], ENT_QUOTES, 'UTF-8') ?>"
                                    data-email="<?= htmlspecialchars($contact['email'], ENT_QUOTES, 'UTF-8') ?>"
                                    data-tel="<?= htmlspecialchars($contact['telephone'], ENT_QUOTES, 'UTF-8') ?>"
                                    data-message="<?= htmlspecialchars($contact['message'], ENT_QUOTES, 'UTF-8') ?>">
                                    Voir
                                </button>

                            </td>

                        </tr>

                    <?php endforeach; ?>

                </tbody>

            </table>
        </div>
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
        function showMessage(nom, email, tel, message) {

            document.getElementById('modalNom').textContent = nom;
            document.getElementById('modalEmail').textContent = email;
            document.getElementById('modalTel').textContent = tel;
            document.getElementById('modalMessage').textContent = message;

            document.getElementById('messageModal').style.display = 'block';
        }

        function closeModal() {

            document.getElementById('messageModal').style.display = 'none';
        }

        window.onclick = function(event) {

            const modal = document.getElementById('messageModal');

<<<<<<< HEAD
            if (event.target === modal) {
                modal.style.display = 'none';
=======
        // 🔥 update statut en base
        fetch('/assets/admin/mark_as_read.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: 'id=' + encodeURIComponent(id)
        })
        .then(res => res.text())
        .then(res => {
            if (res === "ok") {
                // optionnel: update UI direct
                const badge = this.closest('tr').querySelector('.badge');
                badge.textContent = 'Lu';
                badge.classList.remove('badge-unread');
                badge.classList.add('badge-read');
>>>>>>> f31fb06 (refactor(dashboard): Modification du dashboard)
            }
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

                document.getElementById('messageModal').style.display = 'block';

                // 🔥 update statut en base
                fetch('mark_as_read.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: 'id=' + encodeURIComponent(id)
                    })
                    .then(res => res.text())
                    .then(res => {
                        if (res === "ok") {
                            // optionnel: update UI direct
                            this.closest('tr')
                                .querySelector('.badge')
                                .textContent = 'Lu';
                        }
                    });

            });
        });

        document.getElementById('messageModal').addEventListener('click', function(event) {
            if (event.target === this) {
                this.style.display = 'none';
            }
        });
    </script>

</body>


</html>
