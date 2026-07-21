<?php
if (!isset($articles)) {
    $articles = [];
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Articles - Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body class="antialiased bg-gray-50">

<?php require dirname(__DIR__,2) . '/layouts/sidebar.php'; ?>

<main class="main">
    <div class="header">
        <div>
            <span class="eyebrow">Articles</span>
            <h1>Articles récents</h1>
            <p>Liste des articles ajoutés dans la base de données.</p>
        </div>
        <div class="header-actions">
            <a class="px-4 py-2 bg-white text-blue-700 border border-blue-700 rounded font-semibold" href="<?= \Router\Router::route('/admin/dashboard') ?>">Retour</a>
            <a class="px-4 py-2 bg-blue-600 text-white rounded font-semibold" href="#">Nouvel article</a>
        </div>
    </div>

    <div class="table-container">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100 text-xs uppercase">
                    <tr>
                        <th class="px-6 py-3 text-left font-medium">#</th>
                        <th class="px-6 py-3 text-left font-medium">Titre</th>
                        <th class="px-6 py-3 text-left font-medium">Auteur</th>
                        <th class="px-6 py-3 text-left font-medium">Publié le</th>
                        <th class="px-6 py-3 text-left font-medium">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    <?php foreach ($articles as $a): ?>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 font-medium text-sm"><?= htmlspecialchars($a['id'] ?? '') ?></td>
                            <td class="px-6 py-4 text-sm"><?= htmlspecialchars($a['title'] ?? $a['name'] ?? '') ?></td>
                            <td class="px-6 py-4 text-sm"><?= htmlspecialchars($a['author'] ?? '') ?></td>
                            <td class="px-6 py-4 text-sm"><?= htmlspecialchars($a['created_at'] ?? '') ?></td>
                            <td class="px-6 py-4 text-sm">
                                <a title="Voir" class="inline-flex items-center px-3 py-1 rounded text-white bg-blue-600 hover:bg-blue-700" href="#"><i class="fa-solid fa-eye"></i></a>
                                <a title="Éditer" class="inline-flex items-center px-3 py-1 rounded text-white bg-yellow-500 hover:bg-yellow-600 ml-2" href="#"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a title="Supprimer" class="inline-flex items-center px-3 py-1 rounded text-white bg-red-600 hover:bg-red-700 ml-2" href="#"><i class="fa-solid fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <?php if (empty($articles)): ?>
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-gray-500">Aucun article trouvé.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</main>

</body>
</html>
