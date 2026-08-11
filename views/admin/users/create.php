<!DOCTYPE html>

<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouvel administrateur</title>

    <!-- Bootstrap 5 -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <style>
        :root {
            --primary-color: #0d3b66;
            --secondary-color: #1f5f9b;
            --light-blue: #f1f6fb;
        }

        body {
            min-height: 100vh;
            background: var(--light-blue);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: Arial, sans-serif;
        }

        .admin-card {
            width: 100%;
            max-width: 520px;
            background: #fff;
            border: none;
            border-radius: 16px;
            box-shadow: 0 10px 35px rgba(13, 59, 102, 0.15);
            overflow: hidden;
        }

        .admin-header {
            background: var(--primary-color);
            color: white;
            padding: 28px 30px;
        }

        .admin-header h2 {
            margin: 0;
            font-size: 24px;
            font-weight: 600;
        }

        .admin-header p {
            margin: 6px 0 0;
            opacity: 0.8;
            font-size: 14px;
        }

        .admin-body {
            padding: 30px;
        }

        .form-label {
            color: var(--primary-color);
            font-weight: 600;
            margin-bottom: 8px;
        }

        .form-control,
        .form-select {
            min-height: 46px;
            border: 1px solid #d5e0ea;
            border-radius: 9px;
            padding: 10px 13px;
            transition: all 0.2s ease;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 0.2rem rgba(31, 95, 155, 0.15);
        }

        .btn-create {
            width: 100%;
            min-height: 46px;
            border: none;
            border-radius: 9px;
            background: var(--primary-color);
            color: white;
            font-weight: 600;
            transition: all 0.2s ease;
        }

        .btn-create:hover {
            background: var(--secondary-color);
            color: white;
            transform: translateY(-1px);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .required {
            color: #dc3545;
        }
    </style>

</head>

<body>

    <div class="admin-card">

        <!-- Header -->
        <div class="admin-header">
            <h2>Créer un  utilisateur</h2>
            <p>Ajoutez un nouvel utilisateur à la plateforme.</p>
        </div>

        <!-- Formulaire -->
        <div class="admin-body">

            <form action="<?= \Router\Router::route('/admin/users/store') ?>" method="POST">

                <!-- Nom -->
                <div class="form-group">
                    <label for="name" class="form-label">
                        Nom <span class="required">*</span>
                    </label>

                    <input
                        type="text"
                        name="name"
                        id="name"
                        class="form-control"
                        placeholder="Entrez le nom complet"
                        required>
                </div>

                <!-- Email -->
                <div class="form-group">
                    <label for="email" class="form-label">
                        Email <span class="required">*</span>
                    </label>

                    <input
                        type="email"
                        name="email"
                        id="email"
                        class="form-control"
                        placeholder="exemple@email.com"
                        required>
                </div>

                <!-- Mot de passe -->
                <div class="form-group">
                    <label for="password" class="form-label">
                        Mot de passe <span class="required">*</span>
                    </label>

                    <input
                        type="password"
                        name="password"
                        id="password"
                        class="form-control"
                        placeholder="Entrez un mot de passe"
                        required>
                </div>

                <!-- Rôle -->
                <div class="form-group">
                    <label for="role" class="form-label">
                        Rôle <span class="required">*</span>
                    </label>

                    <select
                        name="role"
                        id="role"
                        class="form-select"
                        required>
                        <option value="" selected disabled>
                            Sélectionnez un rôle
                        </option>

                        <?php foreach ($roles ?? [] as $role): ?>
                            <option value="<?= $role?->id ?>">
                                <?= $role?->name ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Bouton -->
                <div class="mt-4">
                    <button type="submit" class="btn btn-create">
                        Créer l'administrateur
                    </button>
                </div>

            </form>

        </div>


    </div>

</body>

</html>