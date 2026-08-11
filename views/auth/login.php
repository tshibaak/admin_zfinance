<!doctype html>

<html lang="fr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Connexion | Administration</title>

  <!-- Bootstrap 5 -->
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet">

  <!-- Bootstrap Icons -->
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <style>
    :root {
      --primary: #0d3b66;
      --secondary: #1f5f9b;
      --background: #f4f7fb;
    }

    * {
      box-sizing: border-box;
    }

    body {
      min-height: 100vh;
      margin: 0;
      background:
        linear-gradient(135deg,
          #f4f7fb 0%,
          #e8f0f8 100%);
      font-family: "Segoe UI", Roboto, Arial, sans-serif;
    }

    .login-wrapper {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 25px;
    }

    .login-card {
      width: 100%;
      max-width: 430px;
      background: #ffffff;
      border: none;
      border-radius: 18px;
      overflow: hidden;
      box-shadow: 0 15px 45px rgba(13, 59, 102, 0.15);
    }

    /* Header */

    .login-header {
      background: linear-gradient(135deg,
          var(--primary),
          var(--secondary));

      color: white;
      text-align: center;
      padding: 35px 30px;
    }

    .login-icon {
      width: 70px;
      height: 70px;
      margin: 0 auto 18px;

      display: flex;
      align-items: center;
      justify-content: center;

      background: rgba(255, 255, 255, 0.15);
      border: 1px solid rgba(255, 255, 255, 0.25);

      border-radius: 50%;

      font-size: 30px;
    }

    .login-header h2 {
      margin: 0;
      font-size: 25px;
      font-weight: 700;
    }

    .login-header p {
      margin: 8px 0 0;
      font-size: 14px;
      opacity: 0.85;
    }

    /* Body */

    .login-body {
      padding: 35px;
    }

    .form-label {
      color: var(--primary);
      font-weight: 600;
      font-size: 14px;
    }

    .input-group-text {
      background: #f5f8fb;
      border: 1px solid #d9e2ec;
      color: var(--secondary);
    }

    .form-control {
      min-height: 48px;
      border: 1px solid #d9e2ec;
      font-size: 15px;
    }

    .form-control:focus {
      border-color: var(--secondary);

      box-shadow:
        0 0 0 0.2rem rgba(31, 95, 155, 0.15);
    }

    .btn-login {
      min-height: 48px;
      border: none;
      border-radius: 8px;

      background: var(--primary);
      color: white;

      font-weight: 600;
      font-size: 15px;

      transition: all 0.2s ease;
    }

    .btn-login:hover {
      background: var(--secondary);
      color: white;
      transform: translateY(-1px);

      box-shadow:
        0 6px 15px rgba(13, 59, 102, 0.2);
    }

    .btn-login:active {
      transform: translateY(0);
    }

    /* Error */

    .error-message {
      display: flex;
      align-items: flex-start;
      gap: 10px;

      background: #fff1f1;
      color: #b42318;

      border-left: 4px solid #dc3545;
      border-radius: 7px;

      padding: 12px 14px;

      margin-bottom: 25px;

      font-size: 14px;
    }

    .error-message i {
      font-size: 18px;
    }

    /* Footer */

    .login-footer {
      text-align: center;
      padding: 0 35px 30px;

      color: #7a8694;
      font-size: 12px;
    }

    /* Responsive */

    @media (max-width: 480px) {

      .login-wrapper {
        padding: 15px;
      }

      .login-body {
        padding: 25px;
      }

      .login-header {
        padding: 30px 20px;
      }

      .login-footer {
        padding: 0 25px 25px;
      }
    }
  </style>
</head>

<body>

  <div class="login-wrapper">


    <div class="login-card">

      <!-- Header -->
      <div class="login-header">

        <div class="login-icon">
          <i class="bi bi-shield-lock"></i>
        </div>

        <h2>Connexion</h2>

        <p>
          Accédez à votre espace d'administration
        </p>

      </div>

      <!-- Formulaire -->
      <div class="login-body">

        <?php if (isset($_SESSION['message_error'])): ?>
          <div class="error-message">
            <i class="bi bi-exclamation-circle-fill"></i>
            <div>
              <?= htmlspecialchars($_SESSION['message_error']); ?>
            </div>
          </div>
          <?php unset($_SESSION['message_error']); ?>
        <?php endif; ?>


        <form
          method="POST"
          action="<?= \Router\Router::route('/login') ?>">

          <!-- Email -->
          <div class="mb-4">

            <label
              for="email"
              class="form-label">
              Adresse email
            </label>

            <div class="input-group">

              <span class="input-group-text">
                <i class="bi bi-envelope"></i>
              </span>

              <input
                type="email"
                class="form-control"
                id="email"
                name="email"
                placeholder="exemple@email.com"
                required
                autocomplete="email">

            </div>

          </div>


          <!-- Mot de passe -->
          <div class="mb-4">

            <label
              for="password"
              class="form-label">
              Mot de passe
            </label>

            <div class="input-group">

              <span class="input-group-text">
                <i class="bi bi-lock"></i>
              </span>

              <input
                type="password"
                class="form-control"
                id="password"
                name="password"
                placeholder="Votre mot de passe"
                required
                autocomplete="current-password">

            </div>

          </div>


          <!-- Bouton -->
          <button
            type="submit"
            class="btn btn-login w-100">

            <i class="bi bi-box-arrow-in-right me-2"></i>

            Se connecter

          </button>

        </form>

      </div>


      <!-- Footer -->
      <div class="login-footer">

        <i class="bi bi-shield-check me-1"></i>

        Espace sécurisé — Administration

      </div>

    </div>

  </div>

  <!-- Bootstrap JS -->

  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
  </script>

</body>

</html>