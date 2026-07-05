

<!-- <!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Admin Login</title>
  <style>body{font-family:Arial,Helvetica,sans-serif;padding:40px} form{max-width:360px;margin:0 auto}</style>
</head>

<body>
  <h2>Connexion Admin</h2>
    <?php if(isset($_SESSION['message_error'])): ?>
        <p style="color:red"><?php echo htmlspecialchars($_SESSION['message_error']); ?></p>
    <?php endif; ?>
  <form method="POST" action="../../../src/api/api_login.php">
    <div><label>Utilisateur<br><input name="username" required></label></div>
    <div><label>Mot de passe<br><input name="password" type="password" required></label></div>
    <div style="margin-top:12px"><button type="submit">Se connecter</button></div>
  </form>
</body>
</html> -->

<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login</title>
  <style>
    /* Réinitialisation de base */
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
      background-color: #f0f4f8; /* Blanc cassé tirant sur le bleu */
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      color: #333333;
    }

    /* Conteneur principal de la carte */
    .login-container {
      background-color: #ffffff; /* Blanc pur */
      padding: 40px;
      border-radius: 12px;
      box-shadow: 0 8px 24px rgba(149, 157, 165, 0.2); /* Ombre douce */
      width: 100%;
      max-width: 400px;
    }

    h2 {
      color: #1a73e8; /* Bleu moderne */
      text-align: center;
      margin-bottom: 24px;
      font-size: 24px;
      font-weight: 600;
    }

    /* Message d'erreur */
    .error-message {
      background-color: #ffebee;
      color: #c62828;
      padding: 12px;
      border-radius: 6px;
      border-left: 4px solid #e53935;
      margin-bottom: 20px;
      font-size: 14px;
    }

    /* Groupes du formulaire */
    .form-group {
      margin-bottom: 20px;
    }

    label {
      display: block;
      margin-bottom: 8px;
      font-size: 14px;
      color: #5f6368;
      font-weight: 500;
    }

    input {
      width: 100%;
      padding: 12px;
      border: 1.5px solid #dadce0;
      border-radius: 6px;
      font-size: 15px;
      transition: border-color 0.2s, box-shadow 0.2s;
      outline: none;
    }

    /* Focus sur les inputs */
    input:focus {
      border-color: #1a73e8; /* Changement vers le bleu */
      box-shadow: 0 0 0 3px rgba(26, 115, 232, 0.15);
    }

    /* Bouton de connexion */
    button {
      width: 100%;
      padding: 12px;
      background-color: #1a73e8; /* Bouton bleu */
      color: #ffffff;
      border: none;
      border-radius: 6px;
      font-size: 16px;
      font-weight: 600;
      cursor: pointer;
      transition: background-color 0.2s, transform 0.1s;
    }

    /* Effets au survol et clic */
    button:hover {
      background-color: #1557b0; /* Bleu plus foncé */
    }

    button:active {
      transform: scale(0.98); /* Léger effet d'enfoncement */
    }
  </style>
</head>

<body>

  <div class="login-container">
    <h2>Connexion Admin</h2>

    <?php if(isset($_SESSION['message_error'])): ?>
        <div class="error-message">
            <?php 
                echo htmlspecialchars($_SESSION['message_error']); 
                unset($_SESSION['message_error']); // Optionnel : vide l'erreur après affichage
            ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="../../../src/api/api_login.php">
      <div class="form-group">
        <label for="username">Utilisateur</label>
        <input type="text" id="username" name="username" required autocomplete="username">
      </div>

      <div class="form-group">
        <label for="password">Mot de passe</label>
        <input type="password" id="password" name="password" required>
      </div>

      <button type="submit">Se connecter</button>
    </form>
  </div>

</body>
</html>
