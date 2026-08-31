<?php
$status = (int) ($status ?? 500);
$statusText = (string) ($statusText ?? 'Une erreur est survenue.');
$statusLabel = (string) ($statusLabel ?? 'Réponse HTTP');
$requestUri = (string) ($requestUri ?? '/');
$isServerError = $status >= 500;
$eyebrow = $isServerError ? 'Incident technique' : 'Requête non aboutie';
$title = $isServerError ? 'Le service rencontre un problème' : 'Cette page n’est pas disponible';
$description = $isServerError
    ? 'Notre équipe a été informée. Réessayez dans quelques instants ou revenez à votre espace de gestion.'
    : 'La demande ne peut pas être traitée telle quelle. Vérifiez l’adresse ou revenez à la page précédente.';
?>
<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex">
    <title><?= htmlspecialchars((string) $status) ?> | Zfinances</title>
    <style>
        :root {
            --ink: #000028;
            --blue: #001b92;
            --blue-bright: #1107ca;
            --surface: #fff;
            --muted: #626a86;
            --line: #e4e8f4;
            --accent: #ffa514;
            --danger: #d94b61;
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        body {
            min-width: 320px;
            min-height: 100vh;
            margin: 0;
            color: var(--ink);
            background:
                radial-gradient(circle at 12% 10%, rgba(17, 7, 202, .13), transparent 28rem),
                linear-gradient(135deg, #f7f9ff 0%, #e9edf8 100%);
            font-family: "Inter", "Segoe UI", sans-serif;
            -webkit-font-smoothing: antialiased;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        .error-shell {
            display: grid;
            grid-template-columns: minmax(0, 1.05fr) minmax(320px, .95fr);
            gap: clamp(2rem, 7vw, 7rem);
            align-items: center;
            width: min(1120px, calc(100% - 48px));
            min-height: 100vh;
            margin: 0 auto;
            padding: 64px 0;
        }

        .brand {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            margin-bottom: clamp(4rem, 13vh, 9rem);
            color: var(--blue);
            font-size: .98rem;
            font-weight: 800;
            letter-spacing: .02em;
        }

        .brand-mark {
            display: grid;
            place-items: center;
            width: 38px;
            height: 38px;
            color: var(--blue-bright);
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0, 27, 146, .14);
            font-size: 1.15rem;
            font-weight: 900;
        }

        .eyebrow {
            margin: 0 0 14px;
            color: var(--blue-bright);
            font-size: .76rem;
            font-weight: 800;
            letter-spacing: .13em;
            text-transform: uppercase;
        }

        h1 {
            max-width: 620px;
            margin: 0;
            color: var(--ink);
            font-size: clamp(2.2rem, 5vw, 4.4rem);
            line-height: 1.03;
            letter-spacing: -.035em;
        }

        .lead {
            max-width: 560px;
            margin: 24px 0 0;
            color: #49516d;
            font-size: clamp(1rem, 1.6vw, 1.15rem);
            line-height: 1.75;
        }

        .actions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 34px;
        }

        .button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 48px;
            padding: 0 21px;
            border: 1px solid transparent;
            border-radius: 8px;
            font-size: .92rem;
            font-weight: 750;
            transition: transform .2s ease, box-shadow .2s ease, background .2s ease;
        }

        .button:hover,
        .button:focus-visible {
            transform: translateY(-2px);
        }

        .button-primary {
            color: #fff;
            background: var(--blue-bright);
            box-shadow: 0 12px 24px rgba(17, 7, 202, .2);
        }

        .button-primary:hover,
        .button-primary:focus-visible {
            background: var(--blue);
        }

        .button-secondary {
            color: var(--blue);
            background: rgba(255, 255, 255, .7);
            border-color: #cbd3e9;
        }

        .button-secondary:hover,
        .button-secondary:focus-visible {
            background: #fff;
        }

        .status-panel {
            position: relative;
            padding: clamp(28px, 5vw, 50px);
            background: rgba(255, 255, 255, .84);
            border: 1px solid rgba(255, 255, 255, .9);
            border-radius: 14px;
            box-shadow: 0 24px 60px rgba(0, 0, 80, .13);
            animation: rise .55s ease both;
        }

        .status-panel::before {
            content: "";
            position: absolute;
            top: 0;
            left: 28px;
            right: 28px;
            height: 4px;
            background: var(--accent);
            border-radius: 0 0 4px 4px;
        }

        .status-code {
            display: block;
            color: var(--blue);
            font-size: clamp(4.5rem, 11vw, 8rem);
            font-weight: 850;
            line-height: .9;
            letter-spacing: -.07em;
        }

        .status-label {
            display: inline-block;
            margin-top: 20px;
            padding: 7px 11px;
            color: <?= $isServerError ? 'var(--danger)' : 'var(--blue)' ?>;
            background: <?= $isServerError ? '#fff0f2' : '#edf0ff' ?>;
            border-radius: 5px;
            font-size: .78rem;
            font-weight: 800;
            letter-spacing: .08em;
            text-transform: uppercase;
        }

        .status-message {
            margin: 20px 0 0;
            padding-top: 20px;
            color: #313954;
            border-top: 1px solid var(--line);
            font-size: 1.03rem;
            line-height: 1.65;
        }

        .request-context {
            display: block;
            margin-top: 26px;
            color: var(--muted);
            font-family: ui-monospace, SFMono-Regular, Consolas, monospace;
            font-size: .76rem;
            overflow-wrap: anywhere;
        }

        .request-context strong {
            display: block;
            margin-bottom: 5px;
            color: #858ba0;
            font-family: inherit;
            font-size: .68rem;
            letter-spacing: .1em;
            text-transform: uppercase;
        }

        @keyframes rise {
            from {
                opacity: 0;
                transform: translateY(16px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 760px) {
            .error-shell {
                grid-template-columns: 1fr;
                width: min(100% - 32px, 560px);
                padding: 28px 0 42px;
            }

            .brand {
                margin-bottom: 56px;
            }

            h1 {
                font-size: clamp(2.35rem, 12vw, 4rem);
            }

            .status-panel {
                padding: 34px 26px 28px;
            }

            .status-code {
                font-size: 5.5rem;
            }
        }

        @media (prefers-reduced-motion: reduce) {

            *,
            *::before,
            *::after {
                animation: none !important;
                transition: none !important;
            }
        }
    </style>
</head>

<body>
    <main class="error-shell" aria-labelledby="error-title">
        <section>
            <a class="brand" href="<?= htmlspecialchars(Router\Router::route('/'), ENT_QUOTES, 'UTF-8') ?>" aria-label="Retour à l’accueil de Zfinances">
                <span class="brand-mark" aria-hidden="true">Z</span>
                <span>Zfinances</span>
            </a>
            <p class="eyebrow"><?= htmlspecialchars($eyebrow, ENT_QUOTES, 'UTF-8') ?></p>
            <h1 id="error-title"><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?></h1>
            <p class="lead"><?= htmlspecialchars($description, ENT_QUOTES, 'UTF-8') ?></p>
            <nav class="actions" aria-label="Actions de navigation">
                <a class="button button-primary" href="<?= htmlspecialchars(Router\Router::route('/'), ENT_QUOTES, 'UTF-8') ?>">Retour à l’accueil</a>
                <a class="button button-secondary" href="javascript:history.back()">Page précédente</a>
            </nav>
        </section>

        <aside class="status-panel" aria-label="Détails de l’erreur">
            <span class="status-code" aria-label="Code HTTP <?= $status ?>"><?= $status ?></span>
            <span class="status-label"><?= htmlspecialchars($statusLabel, ENT_QUOTES, 'UTF-8') ?></span>
            <p class="status-message"><?= htmlspecialchars($statusText, ENT_QUOTES, 'UTF-8') ?></p>
            <small class="request-context"><strong>Adresse demandée</strong><?= htmlspecialchars($requestUri, ENT_QUOTES, 'UTF-8') ?></small>
        </aside>
    </main>
</body>

</html>