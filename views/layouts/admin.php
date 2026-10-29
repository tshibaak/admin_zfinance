<?php
$pageTitle = $pageTitle ?? 'Administration';
$flash = \Core\Session::pullFlash();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8') ?> — Zfinances</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;0,9..40,800;1,9..40,400&family=IBM+Plex+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/admin.css">
</head>
<body class="admin-body">
    <?php require __DIR__ . '/sidebar.php'; ?>
    <main class="main" id="main-content">
        <?php if ($flash): ?>
            <div class="flash-alert flash-<?= htmlspecialchars($flash['type'], ENT_QUOTES, 'UTF-8') ?>" role="alert">
                <span class="flash-icon" aria-hidden="true">
                    <?php if ($flash['type'] === 'success'): ?>
                        <i class="fa-solid fa-circle-check"></i>
                    <?php elseif ($flash['type'] === 'error'): ?>
                        <i class="fa-solid fa-circle-exclamation"></i>
                    <?php elseif ($flash['type'] === 'warning'): ?>
                        <i class="fa-solid fa-triangle-exclamation"></i>
                    <?php else: ?>
                        <i class="fa-solid fa-circle-info"></i>
                    <?php endif; ?>
                </span>
                <p><?= htmlspecialchars($flash['message'], ENT_QUOTES, 'UTF-8') ?></p>
                <button type="button" class="flash-dismiss" aria-label="Fermer la notification" onclick="this.parentElement.remove()">
                    <i class="fa-solid fa-xmark" aria-hidden="true"></i>
                </button>
            </div>
        <?php endif; ?>
        <?= $content ?? '' ?>
    </main>
    <script>
        (() => {
            document.querySelectorAll('input[type="file"].sr-only').forEach((input) => {
                const label = document.querySelector(`label[for="${input.id}"]`);
                if (!label) return;
                input.addEventListener('change', () => {
                    const name = input.files?.[0]?.name;
                    const span = label.querySelector('span');
                    if (span && name) span.textContent = name;
                });
            });
        })();
    </script>
</body>
</html>
