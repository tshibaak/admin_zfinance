<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function h($value)
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

$scriptName = str_replace('\\', '/', $_SERVER['SCRIPT_NAME'] ?? '');
$publicPos = strpos($scriptName, '/public/');
$projectBase = $publicPos === false ? dirname(dirname(dirname(dirname($scriptName)))) : substr($scriptName, 0, $publicPos);
$projectBase = rtrim($projectBase, '/');
$publicBase = $projectBase . '/public';
$assetBase = $publicBase . '/assets';
$apiBase = $projectBase . '/src/api';
$supportSrc = $projectBase . '/support.js';

$popupMessage = '';
$popupType = '';

if (isset($_SESSION['message_error_accueil'])) {
    $popupMessage = $_SESSION['message_error_accueil'];
    $popupType = 'error';
    unset($_SESSION['message_error_accueil']);
}

if (isset($_SESSION['message_accueil_ok'])) {
    $popupMessage = $_SESSION['message_accueil_ok'];
    $popupType = 'success';
    unset($_SESSION['message_accueil_ok']);
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Zfinances - Expertise Comptable & Audit Financier</title>
<style>
  .zf-popup{position:fixed;inset:22px 22px auto auto;z-index:5000;max-width:min(380px,calc(100vw - 44px));background:#fff;border:1px solid #CCCCFF;box-shadow:0 22px 50px rgba(0,0,60,.18);padding:18px 20px;font-family:Inter,system-ui,sans-serif;color:#000066}
  .zf-popup.success{border-left:5px solid #0000FF}
  .zf-popup.error{border-left:5px solid #C62828}
  .zf-popup strong{display:block;font-size:.86rem;margin-bottom:5px;color:#000066}
  .zf-popup p{font-size:.88rem;line-height:1.55;margin:0;color:#000099}
</style>
<script src="<?= h($supportSrc) ?>"></script>
</head>
<body>
<?php if ($popupMessage !== ''): ?>
<div class="zf-popup <?= h($popupType) ?>">
  <strong><?= $popupType === 'success' ? 'Succes' : 'Erreur' ?></strong>
  <p><?= h($popupMessage) ?></p>
</div>
<?php endif; ?>
<x-dc>
<helmet>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<style>
  *{box-sizing:border-box;margin:0;padding:0;}
  html{scroll-behavior:smooth;}
  body{font-family:'Inter',system-ui,sans-serif;color:#000066;background:#fff;line-height:1.6;overflow-x:hidden;-webkit-font-smoothing:antialiased;}
  a{text-decoration:none;color:inherit;}
  img{display:block;}
  ::selection{background:#0000FF;color:#fff;}
  @keyframes zfPulse{0%,100%{opacity:1;transform:scale(1)}50%{opacity:.45;transform:scale(1.3)}}
  @keyframes zfBar{from{transform:scaleY(0)}to{transform:scaleY(1)}}
  @keyframes zfMarqueeL{from{transform:translateX(-50%)}to{transform:translateX(0)}}
  @keyframes zfMarqueeR{from{transform:translateX(0)}to{transform:translateX(-50%)}}
  .zf-fade{opacity:0;transform:translateY(26px);transition:opacity .7s ease,transform .7s ease;}
  .zf-fade.zf-vis{opacity:1;transform:none;}
  .zf-marquee:hover .zf-track{animation-play-state:paused;}
</style>
</helmet>

<div style="background:#fff;">

  <template id="__bundler_thumbnail">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><rect width="100" height="100" fill="#0000FF"/><circle cx="44" cy="44" r="19" fill="none" stroke="#fff" stroke-width="6"/><line x1="58" y1="58" x2="74" y2="74" stroke="#fff" stroke-width="7" stroke-linecap="round"/></svg>
  </template>

  <!-- ===================== HEADER ===================== -->
  <header style="position:sticky;top:0;z-index:1000;background:rgba(255,255,255,.94);backdrop-filter:blur(12px);border-bottom:1px solid #E6E6FF;">
    <div style="max-width:1200px;margin:0 auto;padding:0 24px;">
      <div style="display:flex;align-items:center;justify-content:space-between;height:74px;gap:28px;flex-wrap:wrap;">
        <a href="#zf-hero" style="display:flex;align-items:center;gap:10px;flex-shrink:0;">
          <img src="https://image.youmind.com/user-files/eebe4f28a1c7f3ce5132746a515a51ef427cc8493122627c398898d4b8feb61a?format=jpeg&width=4000&height=4000&fit=scale-down" alt="Zfinances" style="height:42px;width:auto;">
        </a>
        <nav style="display:flex;align-items:center;gap:2px;">
          <a href="#zf-hero" style="font-size:.9rem;font-weight:500;color:#000066;padding:9px 14px;transition:.2s;" style-hover="color:#0000FF;background:#F0F0FF;">Accueil</a>
          <a href="#zf-services" style="font-size:.9rem;font-weight:500;color:#000066;padding:9px 14px;transition:.2s;" style-hover="color:#0000FF;background:#F0F0FF;">Services</a>
          <a href="#zf-about" style="font-size:.9rem;font-weight:500;color:#000066;padding:9px 14px;transition:.2s;" style-hover="color:#0000FF;background:#F0F0FF;">À propos</a>
          <a href="#zf-team" style="font-size:.9rem;font-weight:500;color:#000066;padding:9px 14px;transition:.2s;" style-hover="color:#0000FF;background:#F0F0FF;">Équipe</a>
          <a href="#zf-trust" style="font-size:.9rem;font-weight:500;color:#000066;padding:9px 14px;transition:.2s;" style-hover="color:#0000FF;background:#F0F0FF;">Références</a>
          <a href="#zf-contact" style="font-size:.9rem;font-weight:500;color:#000066;padding:9px 14px;transition:.2s;" style-hover="color:#0000FF;background:#F0F0FF;">Contact</a>
          <a href="<?= h($publicBase) ?>/index.php?q=admin" style="font-size:.9rem;font-weight:500;color:#000066;padding:9px 14px;transition:.2s;" style-hover="color:#0000FF;background:#F0F0FF;">Admin</a>
        </nav>
        <a href="#zf-contact" style="display:inline-flex;align-items:center;gap:8px;padding:12px 22px;background:#0000FF;color:#fff;font-size:.9rem;font-weight:600;border:2px solid #0000FF;transition:.25s;" style-hover="background:#fff;color:#0000FF;">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="0"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
          Rendez-vous
        </a>
      </div>
    </div>
  </header>

  <!-- ===================== HERO ===================== -->
  <section id="zf-hero" style="position:relative;overflow:hidden;background:#fff;border-bottom:1px solid #E6E6FF;">
    <div style="position:absolute;top:0;right:0;width:46%;height:100%;background:#F5F5FF;pointer-events:none;"></div>
    <div style="position:absolute;top:64px;right:8%;width:140px;height:140px;border:2px solid #E6E6FF;pointer-events:none;"></div>
    <div style="position:relative;max-width:1200px;margin:0 auto;padding:0 24px;">
      <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(360px,1fr));gap:56px;align-items:center;padding:76px 0 80px;">
        <div class="zf-fade">
          <div style="display:inline-flex;align-items:center;gap:9px;background:#E6E6FF;color:#0000FF;font-size:.78rem;font-weight:700;letter-spacing:.04em;padding:8px 16px;text-transform:uppercase;">
            <span style="width:7px;height:7px;background:#0000FF;animation:zfPulse 2s infinite;"></span>
            Expertise comptable &amp; Audit financier
          </div>
          <h1 style="font-size:clamp(2.2rem,5vw,3.7rem);font-weight:900;color:#000066;line-height:1.06;margin:22px 0 18px;letter-spacing:-1.5px;">Votre réussite<br>financière,<br><span style="color:#0000FF;">notre expertise</span></h1>
          <p style="font-size:1.06rem;color:#000099;line-height:1.75;margin-bottom:34px;max-width:520px;">Zfinances accompagne les entreprises et les indépendants dans la gestion de leurs obligations comptables, fiscales et financières — avec rigueur, transparence et réactivité.</p>
          <div style="display:flex;gap:0;flex-wrap:wrap;margin-bottom:48px;">
            <a href="#zf-services" style="display:inline-flex;align-items:center;gap:9px;padding:15px 28px;background:#0000FF;color:#fff;font-size:.95rem;font-weight:600;border:2px solid #0000FF;transition:.25s;" style-hover="background:#000066;border-color:#000066;">Découvrir nos services<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
            <a href="#zf-contact" style="display:inline-flex;align-items:center;gap:8px;padding:15px 28px;background:transparent;color:#0000FF;font-size:.95rem;font-weight:600;border:2px solid #0000FF;border-left:none;transition:.25s;" style-hover="background:#F0F0FF;">Nous contacter</a>
          </div>
          <div style="display:flex;gap:0;flex-wrap:wrap;border:1px solid #E6E6FF;">
            <div style="flex:1;min-width:120px;padding:18px 22px;border-right:1px solid #E6E6FF;"><span class="zf-count" data-target="200" data-prefix="+" style="font-size:1.7rem;font-weight:800;color:#0000FF;line-height:1;display:block;">+200</span><span style="font-size:.76rem;color:#000099;font-weight:500;">Clients satisfaits</span></div>
            <div style="flex:1;min-width:120px;padding:18px 22px;border-right:1px solid #E6E6FF;"><span class="zf-count" data-target="15" data-prefix="+" style="font-size:1.7rem;font-weight:800;color:#0000FF;line-height:1;display:block;">+15</span><span style="font-size:.76rem;color:#000099;font-weight:500;">Ans d'expérience</span></div>
            <div style="flex:1;min-width:120px;padding:18px 22px;"><span class="zf-count" data-target="98" data-suffix="%" style="font-size:1.7rem;font-weight:800;color:#0000FF;line-height:1;display:block;">98%</span><span style="font-size:.76rem;color:#000099;font-weight:500;">De satisfaction</span></div>
          </div>
        </div>

        <div class="zf-fade" style="transition-delay:.15s;position:relative;">
          <div style="position:relative;border:6px solid #fff;outline:1px solid #E6E6FF;box-shadow:0 30px 70px rgba(0,0,40,.18);">
            <img src="https://images.unsplash.com/photo-1600880292203-757bb62b4baf?auto=format&fit=crop&w=1000&q=80" alt="Conseillers financiers Zfinances" style="width:100%;height:360px;object-fit:cover;">
            <div style="position:absolute;left:0;bottom:0;background:#0000FF;color:#fff;padding:16px 20px;">
              <div style="font-size:1.5rem;font-weight:800;line-height:1;">+24,8%</div>
              <div style="font-size:.72rem;color:#CCCCFF;margin-top:4px;letter-spacing:.04em;">CROISSANCE MOYENNE CLIENTS</div>
            </div>
          </div>
          <div style="position:absolute;right:-16px;top:28px;background:#fff;border:1px solid #E6E6FF;box-shadow:0 16px 40px rgba(0,0,40,.14);padding:16px 18px;width:188px;">
            <div style="font-size:.68rem;font-weight:700;color:#000099;letter-spacing:.06em;margin-bottom:10px;">PERFORMANCE 2024</div>
            <div style="display:flex;align-items:flex-end;gap:5px;height:54px;">
              <div style="flex:1;height:42%;background:#E6E6FF;transform-origin:bottom;animation:zfBar .7s ease both .1s;"></div>
              <div style="flex:1;height:64%;background:#9999FF;transform-origin:bottom;animation:zfBar .7s ease both .2s;"></div>
              <div style="flex:1;height:50%;background:#E6E6FF;transform-origin:bottom;animation:zfBar .7s ease both .3s;"></div>
              <div style="flex:1;height:86%;background:#0000FF;transform-origin:bottom;animation:zfBar .7s ease both .4s;"></div>
              <div style="flex:1;height:70%;background:#9999FF;transform-origin:bottom;animation:zfBar .7s ease both .5s;"></div>
              <div style="flex:1;height:96%;background:#0000FF;transform-origin:bottom;animation:zfBar .7s ease both .6s;"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ===================== SERVICES ===================== -->
  <section id="zf-services" style="padding:100px 0;background:#FAFAFF;">
    <div style="max-width:1200px;margin:0 auto;padding:0 24px;">
      <div class="zf-fade" style="text-align:center;margin-bottom:58px;">
        <span style="display:inline-block;background:#E6E6FF;color:#0000FF;font-size:.76rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;padding:6px 16px;margin-bottom:18px;">Nos services</span>
        <h2 style="font-size:clamp(1.6rem,3.5vw,2.5rem);font-weight:800;color:#000066;margin-bottom:14px;letter-spacing:-.5px;">Une expertise complète à votre service</h2>
        <p style="max-width:560px;margin:0 auto;font-size:1.05rem;color:#000099;">Une gamme complète de solutions pour sécuriser et optimiser votre gestion financière.</p>
      </div>
      <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(300px,1fr));gap:0;border-left:1px solid #E6E6FF;border-top:1px solid #E6E6FF;">
        <div class="zf-fade" style="background:#fff;border-right:1px solid #E6E6FF;border-bottom:1px solid #E6E6FF;padding:34px 30px;transition:.25s;" style-hover="background:#F5F5FF;">
          <div style="width:54px;height:54px;background:#F0F0FF;display:flex;align-items:center;justify-content:center;margin-bottom:20px;color:#0000FF;"><svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg></div>
          <h3 style="font-size:1.08rem;font-weight:700;color:#000066;margin-bottom:10px;">Expertise Comptable</h3>
          <p style="font-size:.89rem;color:#000099;line-height:1.65;margin-bottom:16px;">Tenue et révision de comptabilité, bilans et comptes de résultat, liasses fiscales et reporting financier.</p>
          <div style="display:flex;flex-wrap:wrap;gap:6px;"><span style="font-size:.72rem;font-weight:600;color:#0000FF;background:#F0F0FF;padding:4px 10px;">Bilan</span><span style="font-size:.72rem;font-weight:600;color:#0000FF;background:#F0F0FF;padding:4px 10px;">Comptabilité</span><span style="font-size:.72rem;font-weight:600;color:#0000FF;background:#F0F0FF;padding:4px 10px;">Liasse fiscale</span></div>
        </div>
        <div class="zf-fade" style="background:#fff;border-right:1px solid #E6E6FF;border-bottom:1px solid #E6E6FF;padding:34px 30px;transition:.25s;" style-hover="background:#F5F5FF;">
          <div style="width:54px;height:54px;background:#F0F0FF;display:flex;align-items:center;justify-content:center;margin-bottom:20px;color:#0000FF;"><svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/><line x1="11" y1="8" x2="11" y2="14"/><line x1="8" y1="11" x2="14" y2="11"/></svg></div>
          <h3 style="font-size:1.08rem;font-weight:700;color:#000066;margin-bottom:10px;">Audit Financier</h3>
          <p style="font-size:.89rem;color:#000099;line-height:1.65;margin-bottom:16px;">Audit légal et contractuel, commissariat aux comptes, certification des comptes annuels et audit d'acquisition.</p>
          <div style="display:flex;flex-wrap:wrap;gap:6px;"><span style="font-size:.72rem;font-weight:600;color:#0000FF;background:#F0F0FF;padding:4px 10px;">Audit légal</span><span style="font-size:.72rem;font-weight:600;color:#0000FF;background:#F0F0FF;padding:4px 10px;">CAC</span><span style="font-size:.72rem;font-weight:600;color:#0000FF;background:#F0F0FF;padding:4px 10px;">Certification</span></div>
        </div>
        <div class="zf-fade" style="background:#fff;border-right:1px solid #E6E6FF;border-bottom:1px solid #E6E6FF;padding:34px 30px;transition:.25s;" style-hover="background:#F5F5FF;">
          <div style="width:54px;height:54px;background:#F0F0FF;display:flex;align-items:center;justify-content:center;margin-bottom:20px;color:#0000FF;"><svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg></div>
          <h3 style="font-size:1.08rem;font-weight:700;color:#000066;margin-bottom:10px;">Conseil Fiscal</h3>
          <p style="font-size:.89rem;color:#000099;line-height:1.65;margin-bottom:16px;">Optimisation fiscale, déclarations, accompagnement lors des contrôles fiscaux et veille réglementaire.</p>
          <div style="display:flex;flex-wrap:wrap;gap:6px;"><span style="font-size:.72rem;font-weight:600;color:#0000FF;background:#F0F0FF;padding:4px 10px;">Optimisation</span><span style="font-size:.72rem;font-weight:600;color:#0000FF;background:#F0F0FF;padding:4px 10px;">Déclarations</span><span style="font-size:.72rem;font-weight:600;color:#0000FF;background:#F0F0FF;padding:4px 10px;">TVA</span></div>
        </div>
        <div class="zf-fade" style="background:#fff;border-right:1px solid #E6E6FF;border-bottom:1px solid #E6E6FF;padding:34px 30px;transition:.25s;" style-hover="background:#F5F5FF;">
          <div style="width:54px;height:54px;background:#F0F0FF;display:flex;align-items:center;justify-content:center;margin-bottom:20px;color:#0000FF;"><svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="7" width="20" height="14" rx="0"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg></div>
          <h3 style="font-size:1.08rem;font-weight:700;color:#000066;margin-bottom:10px;">Conseil Juridique</h3>
          <p style="font-size:.89rem;color:#000099;line-height:1.65;margin-bottom:16px;">Création et transformation de sociétés, rédaction de statuts, pactes d'associés et restructurations.</p>
          <div style="display:flex;flex-wrap:wrap;gap:6px;"><span style="font-size:.72rem;font-weight:600;color:#0000FF;background:#F0F0FF;padding:4px 10px;">Création</span><span style="font-size:.72rem;font-weight:600;color:#0000FF;background:#F0F0FF;padding:4px 10px;">Statuts</span><span style="font-size:.72rem;font-weight:600;color:#0000FF;background:#F0F0FF;padding:4px 10px;">Fusion</span></div>
        </div>
        <div class="zf-fade" style="background:#fff;border-right:1px solid #E6E6FF;border-bottom:1px solid #E6E6FF;padding:34px 30px;transition:.25s;" style-hover="background:#F5F5FF;">
          <div style="width:54px;height:54px;background:#F0F0FF;display:flex;align-items:center;justify-content:center;margin-bottom:20px;color:#0000FF;"><svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg></div>
          <h3 style="font-size:1.08rem;font-weight:700;color:#000066;margin-bottom:10px;">Gestion de Paie</h3>
          <p style="font-size:.89rem;color:#000099;line-height:1.65;margin-bottom:16px;">Externalisation complète de la paie, bulletins, déclarations sociales et accompagnement RH.</p>
          <div style="display:flex;flex-wrap:wrap;gap:6px;"><span style="font-size:.72rem;font-weight:600;color:#0000FF;background:#F0F0FF;padding:4px 10px;">Bulletins</span><span style="font-size:.72rem;font-weight:600;color:#0000FF;background:#F0F0FF;padding:4px 10px;">Déclarations</span><span style="font-size:.72rem;font-weight:600;color:#0000FF;background:#F0F0FF;padding:4px 10px;">RH</span></div>
        </div>
        <div class="zf-fade" style="background:#fff;border-right:1px solid #E6E6FF;border-bottom:1px solid #E6E6FF;padding:34px 30px;transition:.25s;" style-hover="background:#F5F5FF;">
          <div style="width:54px;height:54px;background:#F0F0FF;display:flex;align-items:center;justify-content:center;margin-bottom:20px;color:#0000FF;"><svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg></div>
          <h3 style="font-size:1.08rem;font-weight:700;color:#000066;margin-bottom:10px;">Accompagnement</h3>
          <p style="font-size:.89rem;color:#000099;line-height:1.65;margin-bottom:16px;">Business plan, prévisionnel financier, accompagnement à la levée de fonds et suivi de la performance.</p>
          <div style="display:flex;flex-wrap:wrap;gap:6px;"><span style="font-size:.72rem;font-weight:600;color:#0000FF;background:#F0F0FF;padding:4px 10px;">Business plan</span><span style="font-size:.72rem;font-weight:600;color:#0000FF;background:#F0F0FF;padding:4px 10px;">Prévisionnel</span><span style="font-size:.72rem;font-weight:600;color:#0000FF;background:#F0F0FF;padding:4px 10px;">Levée de fonds</span></div>
        </div>
      </div>
    </div>
  </section>

  <!-- ===================== APPROACH (photo band) ===================== -->
  <sc-if value="{{ showApproachPhoto }}" hint-placeholder-val="{{ true }}">
  <section style="padding:100px 0;background:#fff;">
    <div style="max-width:1200px;margin:0 auto;padding:0 24px;">
      <div style="position:relative;overflow:hidden;min-height:400px;display:flex;align-items:center;border:1px solid #E6E6FF;">
        <img src="https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?auto=format&fit=crop&w=1600&q=80" alt="Analyse financière Zfinances" style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;">
        <div style="position:absolute;inset:0;background:linear-gradient(100deg,rgba(0,0,80,.93) 0%,rgba(0,0,180,.82) 48%,rgba(0,0,255,.30) 100%);"></div>
        <div class="zf-fade" style="position:relative;padding:56px 50px;max-width:640px;color:#fff;">
          <span style="display:inline-block;background:rgba(255,255,255,.16);color:#fff;font-size:.76rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;padding:6px 16px;margin-bottom:18px;">Notre approche</span>
          <h2 style="font-size:clamp(1.6rem,3.5vw,2.3rem);font-weight:800;color:#fff;line-height:1.16;margin-bottom:16px;">Des décisions financières éclairées, fondées sur la donnée</h2>
          <p style="font-size:1rem;color:#E6E6FF;line-height:1.7;margin-bottom:30px;">De la tenue comptable au conseil stratégique, nous transformons vos chiffres en leviers de croissance — avec la même exigence que les plus grandes institutions financières.</p>
          <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(130px,1fr));gap:0;border:1px solid rgba(255,255,255,.25);">
            <div style="padding:16px 18px;border-right:1px solid rgba(255,255,255,.25);"><div class="zf-count" data-target="50" data-prefix="+" style="font-size:1.9rem;font-weight:900;color:#fff;line-height:1;">+50</div><div style="font-size:.76rem;color:#CCCCFF;margin-top:4px;">Secteurs couverts</div></div>
            <div style="padding:16px 18px;border-right:1px solid rgba(255,255,255,.25);"><div class="zf-count" data-target="98" data-suffix="%" style="font-size:1.9rem;font-weight:900;color:#fff;line-height:1;">98%</div><div style="font-size:.76rem;color:#CCCCFF;margin-top:4px;">Clients fidèles</div></div>
            <div style="padding:16px 18px;"><div style="font-size:1.9rem;font-weight:900;color:#fff;line-height:1;">24h</div><div style="font-size:.76rem;color:#CCCCFF;margin-top:4px;">Délai de réponse</div></div>
          </div>
        </div>
      </div>
    </div>
  </section>
  </sc-if>

  <!-- ===================== ABOUT ===================== -->
  <section id="zf-about" style="padding:100px 0;background:#FAFAFF;">
    <div style="max-width:1200px;margin:0 auto;padding:0 24px;">
      <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(340px,1fr));gap:60px;align-items:center;">
        <div class="zf-fade" style="position:relative;">
          <img src="https://images.unsplash.com/photo-1521737604893-d14cc237f11d?auto=format&fit=crop&w=900&q=80" alt="Cabinet Zfinances" style="width:100%;height:440px;object-fit:cover;border:6px solid #fff;outline:1px solid #E6E6FF;box-shadow:0 30px 60px rgba(0,0,40,.14);">
          <div style="position:absolute;right:-14px;bottom:-14px;background:#0000FF;color:#fff;padding:22px 26px;max-width:210px;">
            <div style="font-size:2rem;font-weight:900;line-height:1;">15+</div>
            <div style="font-size:.78rem;color:#CCCCFF;margin-top:6px;">années à accompagner les entreprises de Kinshasa</div>
          </div>
        </div>
        <div class="zf-fade" style="transition-delay:.12s;">
          <span style="display:inline-block;background:#E6E6FF;color:#0000FF;font-size:.76rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;padding:6px 16px;margin-bottom:18px;">À propos</span>
          <h2 style="font-size:clamp(1.6rem,3.5vw,2.4rem);font-weight:800;color:#000066;margin-bottom:18px;letter-spacing:-.5px;">Pourquoi choisir Zfinances ?</h2>
          <p style="font-size:1rem;color:#000099;margin-bottom:16px;line-height:1.7;">Cabinet d'expertise comptable et d'audit financier, Zfinances place la relation client au cœur de son activité. Notre équipe de professionnels certifiés accompagne plus de 200 entreprises et indépendants dans la gestion de leurs obligations comptables, fiscales et financières.</p>
          <div style="display:grid;grid-template-columns:1fr 1fr;gap:0;margin-top:24px;border-left:1px solid #E6E6FF;border-top:1px solid #E6E6FF;">
            <div style="padding:18px 20px;border-right:1px solid #E6E6FF;border-bottom:1px solid #E6E6FF;display:flex;gap:12px;align-items:flex-start;">
              <span style="color:#0000FF;flex:none;"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#0000FF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 11 12 14 22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg></span>
              <div><h4 style="font-size:.92rem;font-weight:700;color:#000066;margin-bottom:3px;">Rigueur</h4><p style="font-size:.8rem;color:#000099;margin:0;line-height:1.5;">Respect strict des normes professionnelles.</p></div>
            </div>
            <div style="padding:18px 20px;border-right:1px solid #E6E6FF;border-bottom:1px solid #E6E6FF;display:flex;gap:12px;align-items:flex-start;">
              <span style="color:#0000FF;flex:none;"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#0000FF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg></span>
              <div><h4 style="font-size:.92rem;font-weight:700;color:#000066;margin-bottom:3px;">Proximité</h4><p style="font-size:.8rem;color:#000099;margin:0;line-height:1.5;">Un interlocuteur dédié et à l'écoute.</p></div>
            </div>
            <div style="padding:18px 20px;border-right:1px solid #E6E6FF;border-bottom:1px solid #E6E6FF;display:flex;gap:12px;align-items:flex-start;">
              <span style="color:#0000FF;flex:none;"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#0000FF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg></span>
              <div><h4 style="font-size:.92rem;font-weight:700;color:#000066;margin-bottom:3px;">Réactivité</h4><p style="font-size:.8rem;color:#000099;margin:0;line-height:1.5;">Réponses rapides, délais respectés.</p></div>
            </div>
            <div style="padding:18px 20px;border-right:1px solid #E6E6FF;border-bottom:1px solid #E6E6FF;display:flex;gap:12px;align-items:flex-start;">
              <span style="color:#0000FF;flex:none;"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#0000FF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg></span>
              <div><h4 style="font-size:.92rem;font-weight:700;color:#000066;margin-bottom:3px;">Transparence</h4><p style="font-size:.8rem;color:#000099;margin:0;line-height:1.5;">Honoraires clairs, reporting régulier.</p></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ===================== ÉQUIPE ===================== -->
  <sc-if value="{{ showTeam }}" hint-placeholder-val="{{ true }}">
  <section id="zf-team" style="padding:100px 0;background:#fff;">
    <div style="max-width:1200px;margin:0 auto;padding:0 24px;">
      <div class="zf-fade" style="text-align:center;margin-bottom:56px;">
        <span style="display:inline-block;background:#E6E6FF;color:#0000FF;font-size:.76rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;padding:6px 16px;margin-bottom:18px;">Le cabinet</span>
        <h2 style="font-size:clamp(1.6rem,3.5vw,2.5rem);font-weight:800;color:#000066;margin-bottom:14px;letter-spacing:-.5px;">Une équipe d'experts à vos côtés</h2>
        <p style="max-width:580px;margin:0 auto;font-size:1.05rem;color:#000099;">Des professionnels reconnus de la comptabilité, de l'audit et de la fiscalité en République Démocratique du Congo.</p>
      </div>
      <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:24px;align-items:stretch;">
        <sc-for list="{{ team }}" as="m" hint-placeholder-count="5">
          <div class="zf-fade" style="background:#fff;border:1px solid #E6E6FF;transition:.25s;display:flex;flex-direction:column;min-height:100%;" style-hover="border-color:#0000FF;box-shadow:0 18px 44px rgba(0,0,255,.1);">
            <div style="position:relative;background:linear-gradient(180deg,#F5F5FF 0%,#E6E6FF 100%);height:260px;overflow:hidden;display:flex;align-items:flex-end;justify-content:center;padding:16px 16px 0;">
              <div style="position:absolute;inset:18px;border:1px solid rgba(0,0,255,.12);pointer-events:none;"></div>
              <img src="{{ m.photo }}" alt="{{ m.name }}" style="position:relative;z-index:1;width:100%;height:100%;object-fit:contain;object-position:center bottom;filter:drop-shadow(0 16px 24px rgba(0,0,60,.14));">
            </div>
            <div style="padding:20px 22px;border-top:3px solid #0000FF;flex:1;">
              <h3 style="font-size:1.05rem;font-weight:700;color:#000066;">{{ m.name }}</h3>
              <div style="font-size:.8rem;font-weight:600;color:#0000FF;margin:3px 0 12px;text-transform:uppercase;letter-spacing:.03em;">{{ m.role }}</div>
              <p style="font-size:.83rem;color:#000099;line-height:1.6;margin:0;">{{ m.bio }}</p>
            </div>
          </div>
        </sc-for>
        <div class="zf-fade" style="background:#000066;color:#fff;display:flex;flex-direction:column;justify-content:center;padding:30px;">
          <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" style="margin-bottom:16px;"><path d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3zM7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3"/></svg>
          <h3 style="font-size:1.3rem;font-weight:800;color:#fff;margin-bottom:10px;">Travaillons ensemble</h3>
          <p style="font-size:.88rem;color:#CCCCFF;line-height:1.6;margin-bottom:20px;">Comptabilité, audit, fiscalité et accompagnement financier pour vos projets.</p>
          <a href="#zf-contact" style="align-self:flex-start;display:inline-flex;align-items:center;gap:8px;padding:12px 20px;background:#0000FF;color:#fff;font-size:.88rem;font-weight:600;border:2px solid #0000FF;transition:.25s;" style-hover="background:#fff;color:#000066;border-color:#fff;">Prendre rendez-vous<svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
        </div>
      </div>
    </div>
  </section>
  </sc-if>

  <!-- ===================== ILS NOUS FONT CONFIANCE ===================== -->
  <section id="zf-trust" style="padding:96px 0 90px;background:#0000FF;position:relative;overflow:hidden;">
    <div style="position:relative;max-width:1200px;margin:0 auto;padding:0 24px;">
      <div class="zf-fade" style="text-align:center;margin-bottom:8px;">
        <span style="display:inline-block;background:rgba(255,255,255,.16);color:#fff;font-size:.76rem;font-weight:700;letter-spacing:.12em;text-transform:uppercase;padding:6px 16px;margin-bottom:18px;">Références clients</span>
        <h2 style="font-size:clamp(1.7rem,3.5vw,2.6rem);font-weight:800;color:#fff;margin-bottom:12px;letter-spacing:-.5px;">Ils nous font confiance</h2>
        <p style="max-width:600px;margin:0 auto;font-size:1.02rem;color:#CCCCFF;">Des PME aux grands groupes, plus de 200 organisations s'appuient sur Zfinances pour leur comptabilité, leur audit et leur conseil fiscal.</p>
      </div>
    </div>

    <!-- marquee 1 : logos défilants L -> R -->
    <div class="zf-marquee" style="position:relative;margin-top:40px;overflow:hidden;-webkit-mask-image:linear-gradient(90deg,transparent,#000 7%,#000 93%,transparent);mask-image:linear-gradient(90deg,transparent,#000 7%,#000 93%,transparent);">
      <div class="zf-track" style="display:flex;gap:20px;width:max-content;animation:zfMarqueeL 50s linear infinite;">
        <sc-for list="{{ logosRow1 }}" as="g" hint-placeholder-count="11">
          <div style="flex:none;display:flex;align-items:center;justify-content:center;width:190px;height:96px;background:#fff;padding:0 22px;">
            <img src="{{ g.src }}" alt="{{ g.name }}" style="max-width:100%;max-height:62px;object-fit:contain;">
          </div>
        </sc-for>
      </div>
    </div>

    <!-- marquee 2 : logos défilants R -> L -->
    <div class="zf-marquee" style="position:relative;margin-top:20px;overflow:hidden;-webkit-mask-image:linear-gradient(90deg,transparent,#000 7%,#000 93%,transparent);mask-image:linear-gradient(90deg,transparent,#000 7%,#000 93%,transparent);">
      <div class="zf-track" style="display:flex;gap:20px;width:max-content;animation:zfMarqueeR 58s linear infinite;">
        <sc-for list="{{ logosRow2 }}" as="g" hint-placeholder-count="11">
          <div style="flex:none;display:flex;align-items:center;justify-content:center;width:190px;height:96px;background:#fff;padding:0 22px;">
            <img src="{{ g.src }}" alt="{{ g.name }}" style="max-width:100%;max-height:62px;object-fit:contain;">
          </div>
        </sc-for>
      </div>
    </div>

    <sc-if value="{{ showTrustCategories }}" hint-placeholder-val="{{ true }}">
    <div style="position:relative;max-width:1200px;margin:56px auto 0;padding:0 24px;">
      <div class="zf-fade" style="display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:0;border-left:1px solid rgba(255,255,255,.2);border-top:1px solid rgba(255,255,255,.2);">
        <sc-for list="{{ trustCategories }}" as="c" hint-placeholder-count="4">
          <div style="padding:24px;border-right:1px solid rgba(255,255,255,.2);border-bottom:1px solid rgba(255,255,255,.2);">
            <div style="font-size:.78rem;font-weight:700;letter-spacing:.06em;text-transform:uppercase;color:#fff;margin-bottom:14px;padding-bottom:12px;border-bottom:2px solid rgba(255,255,255,.25);">{{ c.title }}</div>
            <div style="display:flex;flex-direction:column;gap:8px;">
              <sc-for list="{{ c.clients }}" as="cl" hint-placeholder-count="5"><div style="font-size:.85rem;color:#E6E6FF;">{{ cl }}</div></sc-for>
            </div>
          </div>
        </sc-for>
      </div>
    </div>
    </sc-if>
  </section>

  <!-- ===================== STATS BAND ===================== -->
  <sc-if value="{{ showStatsBand }}" hint-placeholder-val="{{ true }}">
  <section style="padding:0;background:#000066;">
    <div style="max-width:1200px;margin:0 auto;padding:0 24px;">
      <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(170px,1fr));gap:0;border-left:1px solid rgba(255,255,255,.12);">
        <div class="zf-fade" style="padding:54px 24px;text-align:center;border-right:1px solid rgba(255,255,255,.12);"><div class="zf-count" data-target="200" data-prefix="+" style="font-size:clamp(2.2rem,5vw,3.2rem);font-weight:900;color:#fff;line-height:1;margin-bottom:8px;">+200</div><div style="font-size:.88rem;color:#CCCCFF;font-weight:500;">Clients accompagnés</div></div>
        <div class="zf-fade" style="transition-delay:.08s;padding:54px 24px;text-align:center;border-right:1px solid rgba(255,255,255,.12);"><div class="zf-count" data-target="15" data-prefix="+" style="font-size:clamp(2.2rem,5vw,3.2rem);font-weight:900;color:#fff;line-height:1;margin-bottom:8px;">+15</div><div style="font-size:.88rem;color:#CCCCFF;font-weight:500;">Ans d'expérience</div></div>
        <div class="zf-fade" style="transition-delay:.16s;padding:54px 24px;text-align:center;border-right:1px solid rgba(255,255,255,.12);"><div class="zf-count" data-target="50" data-prefix="+" style="font-size:clamp(2.2rem,5vw,3.2rem);font-weight:900;color:#fff;line-height:1;margin-bottom:8px;">+50</div><div style="font-size:.88rem;color:#CCCCFF;font-weight:500;">Secteurs d'activité</div></div>
        <div class="zf-fade" style="transition-delay:.24s;padding:54px 24px;text-align:center;border-right:1px solid rgba(255,255,255,.12);"><div class="zf-count" data-target="98" data-suffix="%" style="font-size:clamp(2.2rem,5vw,3.2rem);font-weight:900;color:#fff;line-height:1;margin-bottom:8px;">98%</div><div style="font-size:.88rem;color:#CCCCFF;font-weight:500;">Taux de satisfaction</div></div>
      </div>
    </div>
  </section>
  </sc-if>

  <!-- ===================== TÉMOIGNAGES ===================== -->
  <section id="zf-testimonials" style="padding:100px 0;background:#FAFAFF;">
    <div style="max-width:1200px;margin:0 auto;padding:0 24px;">
      <div class="zf-fade" style="text-align:center;margin-bottom:56px;">
        <span style="display:inline-block;background:#E6E6FF;color:#0000FF;font-size:.76rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;padding:6px 16px;margin-bottom:18px;">Témoignages</span>
        <h2 style="font-size:clamp(1.6rem,3.5vw,2.5rem);font-weight:800;color:#000066;margin-bottom:14px;letter-spacing:-.5px;">Ce que disent nos clients</h2>
        <p style="max-width:560px;margin:0 auto;font-size:1.05rem;color:#000099;">La satisfaction de nos clients est notre meilleure récompense.</p>
      </div>
      <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(300px,1fr));gap:24px;">
        <sc-for list="{{ testimonials }}" as="t" hint-placeholder-count="3">
          <div class="zf-fade" style="background:#fff;border:1px solid #E6E6FF;padding:32px;transition:.25s;" style-hover="border-color:#0000FF;box-shadow:0 16px 40px rgba(0,0,255,.08);">
            <div style="display:flex;gap:3px;margin-bottom:18px;"><svg width="16" height="16" viewBox="0 0 24 24" fill="#0000FF" stroke="none"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg><svg width="16" height="16" viewBox="0 0 24 24" fill="#0000FF" stroke="none"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg><svg width="16" height="16" viewBox="0 0 24 24" fill="#0000FF" stroke="none"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg><svg width="16" height="16" viewBox="0 0 24 24" fill="#0000FF" stroke="none"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg><svg width="16" height="16" viewBox="0 0 24 24" fill="#0000FF" stroke="none"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg></div>
            <p style="font-size:.93rem;color:#000099;line-height:1.7;margin-bottom:24px;">{{ t.text }}</p>
            <div style="display:flex;align-items:center;gap:13px;border-top:1px solid #E6E6FF;padding-top:18px;">
              <img src="{{ t.photo }}" alt="{{ t.name }}" style="width:50px;height:50px;object-fit:cover;flex:none;">
              <div><div style="font-size:.9rem;font-weight:700;color:#000066;">{{ t.name }}</div><div style="font-size:.78rem;color:#0000FF;">{{ t.company }}</div></div>
            </div>
          </div>
        </sc-for>
      </div>
    </div>
  </section>

  <!-- ===================== CONTACT ===================== -->
  <section id="zf-contact" style="padding:100px 0;background:#fff;">
    <div style="max-width:1200px;margin:0 auto;padding:0 24px;">
      <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(330px,1fr));gap:60px;align-items:start;">
        <div class="zf-fade">
          <span style="display:inline-block;background:#E6E6FF;color:#0000FF;font-size:.76rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;padding:6px 16px;margin-bottom:18px;">Contact</span>
          <h2 style="font-size:clamp(1.6rem,3.5vw,2.4rem);font-weight:800;color:#000066;margin-bottom:8px;letter-spacing:-.5px;">Parlons de votre projet</h2>
          <p style="font-size:.95rem;color:#000099;margin-bottom:30px;">Remplissez le formulaire et nous vous recontacterons sous 24h ouvrées.</p>
          <form action="<?= h($apiBase) ?>/api_accueil.php" method="POST">
            <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(150px,1fr));gap:16px;">
              <div style="margin-bottom:16px;"><label style="display:block;font-size:.84rem;font-weight:600;color:#000066;margin-bottom:6px;">Nom complet *</label><input name="nom" required autocomplete="name" placeholder="Jean Dupont" style="width:100%;padding:13px 15px;border:1.5px solid #CCCCFF;font-size:.9rem;color:#000066;outline:none;transition:.2s;" style-focus="border-color:#0000FF;"></div>
              <div style="margin-bottom:16px;"><label style="display:block;font-size:.84rem;font-weight:600;color:#000066;margin-bottom:6px;">Email *</label><input name="email" required type="email" autocomplete="email" placeholder="jean@exemple.cd" style="width:100%;padding:13px 15px;border:1.5px solid #CCCCFF;font-size:.9rem;color:#000066;outline:none;transition:.2s;" style-focus="border-color:#0000FF;"></div>
            </div>
            <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(150px,1fr));gap:16px;">
              <div style="margin-bottom:16px;"><label style="display:block;font-size:.84rem;font-weight:600;color:#000066;margin-bottom:6px;">Téléphone</label><input name="telephone" type="tel" autocomplete="tel" placeholder="+243 00 00 00 000" style="width:100%;padding:13px 15px;border:1.5px solid #CCCCFF;font-size:.9rem;color:#000066;outline:none;transition:.2s;" style-focus="border-color:#0000FF;"></div>
              <div style="margin-bottom:16px;"><label style="display:block;font-size:.84rem;font-weight:600;color:#000066;margin-bottom:6px;">Sujet *</label><select name="sujet" required style="width:100%;padding:13px 15px;border:1.5px solid #CCCCFF;font-size:.9rem;color:#000066;outline:none;background:#fff;" style-focus="border-color:#0000FF;"><option value="">Sélectionner un service</option><option value="comptabilite">Expertise Comptable</option><option value="audit">Audit Financier</option><option value="fiscal">Conseil Fiscal</option><option value="juridique">Conseil Juridique</option><option value="paie">Gestion de Paie</option><option value="entrepreneurial">Accompagnement</option><option value="autre">Autre</option></select></div>
            </div>
            <div style="margin-bottom:16px;"><label style="display:block;font-size:.84rem;font-weight:600;color:#000066;margin-bottom:6px;">Message *</label><textarea name="message" required placeholder="Décrivez votre besoin..." style="width:100%;padding:13px 15px;border:1.5px solid #CCCCFF;font-size:.9rem;color:#000066;outline:none;min-height:120px;resize:vertical;transition:.2s;" style-focus="border-color:#0000FF;"></textarea></div>
            <button type="submit" style="width:100%;justify-content:center;display:inline-flex;align-items:center;gap:8px;padding:15px 28px;background:#0000FF;color:#fff;font-size:.95rem;font-weight:600;border:2px solid #0000FF;cursor:pointer;transition:.25s;" style-hover="background:#000066;border-color:#000066;"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>Envoyer le message</button>
            <?php if ($popupMessage !== ''): ?><div style="background:#F0F0FF;border:1px solid #CCCCFF;padding:14px 18px;font-size:.9rem;color:#000066;margin-top:16px;"><?= h($popupMessage) ?></div><?php endif; ?>
          </form>
        </div>
        <div class="zf-fade" style="transition-delay:.12s;">
          <div style="background:#000066;color:#fff;padding:34px;">
            <h3 style="font-size:1.2rem;font-weight:700;color:#fff;margin-bottom:6px;">Nos informations</h3>
            <p style="font-size:.88rem;color:#CCCCFF;margin-bottom:26px;">Contactez-nous directement par téléphone ou email.</p>
            <div style="display:flex;flex-direction:column;gap:0;border-top:1px solid rgba(255,255,255,.15);">
              <div style="display:flex;gap:14px;align-items:flex-start;padding:18px 0;border-bottom:1px solid rgba(255,255,255,.15);"><span style="flex:none;"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#9999FF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg></span><div><strong style="display:block;font-size:.85rem;color:#fff;">Adresse</strong><span style="font-size:.83rem;color:#CCCCFF;">372, Av. Col. Mondjiba, C/Ngaliema — Kinshasa, RDC</span></div></div>
              <div style="display:flex;gap:14px;align-items:flex-start;padding:18px 0;border-bottom:1px solid rgba(255,255,255,.15);"><span style="flex:none;"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#9999FF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12 19.79 19.79 0 0 1 1.61 3.4 2 2 0 0 1 3.6 1.22h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L7.91 8.96a16 16 0 0 0 6.13 6.13l.96-1.84a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg></span><div><strong style="display:block;font-size:.85rem;color:#fff;">Téléphone</strong><span style="font-size:.83rem;color:#CCCCFF;">+243 000 000 000</span></div></div>
              <div style="display:flex;gap:14px;align-items:flex-start;padding:18px 0;border-bottom:1px solid rgba(255,255,255,.15);"><span style="flex:none;"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#9999FF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg></span><div><strong style="display:block;font-size:.85rem;color:#fff;">Email</strong><span style="font-size:.83rem;color:#CCCCFF;">contact@zfinances.cd</span></div></div>
            </div>
            <div style="margin-top:24px;padding-top:20px;border-top:1px solid rgba(255,255,255,.15);">
              <div style="display:flex;justify-content:space-between;font-size:.83rem;color:#CCCCFF;padding:5px 0;"><strong style="color:#fff;font-weight:600;">Lun – Ven</strong><span>9h00 – 18h00</span></div>
              <div style="display:flex;justify-content:space-between;font-size:.83rem;color:#CCCCFF;padding:5px 0;"><strong style="color:#fff;font-weight:600;">Samedi</strong><span>9h00 – 12h00</span></div>
              <div style="display:flex;justify-content:space-between;font-size:.83rem;color:#CCCCFF;padding:5px 0;"><strong style="color:#fff;font-weight:600;">Dimanche</strong><span>Fermé</span></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ===================== FOOTER ===================== -->
  <footer style="background:#000066;padding:70px 0 0;">
    <div style="max-width:1200px;margin:0 auto;padding:0 24px;">
      <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:44px;padding-bottom:44px;border-bottom:1px solid rgba(255,255,255,.12);">
        <div>
          <img src="https://image.youmind.com/user-files/eebe4f28a1c7f3ce5132746a515a51ef427cc8493122627c398898d4b8feb61a?format=jpeg&width=4000&height=4000&fit=scale-down" alt="Zfinances" style="height:38px;width:auto;background:#fff;padding:5px 8px;">
          <p style="font-size:.85rem;color:#B3B3FF;margin-top:16px;line-height:1.7;max-width:300px;">Cabinet d'expertise comptable et d'audit financier à Kinshasa. Votre partenaire de confiance pour une gestion financière rigoureuse et optimisée.</p>
          <div style="display:flex;gap:10px;margin-top:20px;">
            <div style="width:38px;height:38px;background:rgba(255,255,255,.08);display:flex;align-items:center;justify-content:center;cursor:pointer;transition:.2s;" style-hover="background:#0000FF;"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/><rect x="2" y="9" width="4" height="12"/><circle cx="4" cy="4" r="2"/></svg></div>
            <div style="width:38px;height:38px;background:rgba(255,255,255,.08);display:flex;align-items:center;justify-content:center;cursor:pointer;transition:.2s;" style-hover="background:#0000FF;"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg></div>
          </div>
        </div>
        <div>
          <h4 style="font-size:.82rem;font-weight:700;color:#fff;margin-bottom:16px;text-transform:uppercase;letter-spacing:.08em;">Navigation</h4>
          <div style="display:flex;flex-direction:column;gap:10px;">
            <a href="#zf-hero" style="font-size:.85rem;color:#B3B3FF;transition:.2s;" style-hover="color:#fff;">Accueil</a>
            <a href="#zf-services" style="font-size:.85rem;color:#B3B3FF;transition:.2s;" style-hover="color:#fff;">Services</a>
            <a href="#zf-about" style="font-size:.85rem;color:#B3B3FF;transition:.2s;" style-hover="color:#fff;">À propos</a>
            <a href="#zf-team" style="font-size:.85rem;color:#B3B3FF;transition:.2s;" style-hover="color:#fff;">Équipe</a>
            <a href="#zf-trust" style="font-size:.85rem;color:#B3B3FF;transition:.2s;" style-hover="color:#fff;">Références</a>
            <a href="<?= h($publicBase) ?>/index.php?q=admin" style="font-size:.85rem;color:#B3B3FF;transition:.2s;" style-hover="color:#fff;">Admin</a>
          </div>
        </div>
        <div>
          <h4 style="font-size:.82rem;font-weight:700;color:#fff;margin-bottom:16px;text-transform:uppercase;letter-spacing:.08em;">Services</h4>
          <div style="display:flex;flex-direction:column;gap:10px;">
            <a href="#zf-services" style="font-size:.85rem;color:#B3B3FF;transition:.2s;" style-hover="color:#fff;">Expertise Comptable</a>
            <a href="#zf-services" style="font-size:.85rem;color:#B3B3FF;transition:.2s;" style-hover="color:#fff;">Audit Financier</a>
            <a href="#zf-services" style="font-size:.85rem;color:#B3B3FF;transition:.2s;" style-hover="color:#fff;">Conseil Fiscal</a>
            <a href="#zf-services" style="font-size:.85rem;color:#B3B3FF;transition:.2s;" style-hover="color:#fff;">Gestion de Paie</a>
          </div>
        </div>
        <div>
          <h4 style="font-size:.82rem;font-weight:700;color:#fff;margin-bottom:16px;text-transform:uppercase;letter-spacing:.08em;">Newsletter</h4>
          <p style="font-size:.82rem;color:#B3B3FF;margin-bottom:14px;">Recevez nos actualités fiscales et comptables.</p>
          <form action="<?= h($apiBase) ?>/api_newsletter.php" method="POST" style="display:flex;gap:0;">
            <input name="email" type="email" required placeholder="votre@email.cd" style="flex:1;padding:11px 14px;border:1.5px solid rgba(255,255,255,.18);background:rgba(255,255,255,.06);color:#fff;font-size:.85rem;outline:none;" style-focus="border-color:#9999FF;">
            <button type="submit" style="padding:11px 18px;background:#0000FF;color:#fff;border:1.5px solid #0000FF;font-size:.85rem;font-weight:600;cursor:pointer;transition:.2s;" style-hover="background:#1A1AFF;">OK</button>
          </form>
          <sc-if value="{{ subscribed }}" hint-placeholder-val="{{ false }}"><p style="font-size:.78rem;color:#9999FF;margin-top:10px;">✓ Inscription confirmée !</p></sc-if>
        </div>
      </div>
      <div style="display:flex;justify-content:space-between;align-items:center;padding:22px 0;gap:16px;flex-wrap:wrap;">
        <p style="font-size:.8rem;color:#B3B3FF;">© 2024 Zfinances — Cabinet d'expertise comptable. Tous droits réservés.</p>
        <p style="font-size:.8rem;color:#B3B3FF;">RCCM CD/KNG/RCCM/21-B-02914 · N° Impôt A2283273P</p>
      </div>
    </div>
  </footer>

</div>
</x-dc>
<script type="text/x-dc" data-dc-script data-props="{&quot;$preview&quot;:{&quot;width&quot;:1280,&quot;height&quot;:900},&quot;showTeam&quot;:{&quot;editor&quot;:&quot;boolean&quot;,&quot;default&quot;:true,&quot;tsType&quot;:&quot;boolean&quot;},&quot;showTrustCategories&quot;:{&quot;editor&quot;:&quot;boolean&quot;,&quot;default&quot;:true,&quot;tsType&quot;:&quot;boolean&quot;},&quot;showApproachPhoto&quot;:{&quot;editor&quot;:&quot;boolean&quot;,&quot;default&quot;:true,&quot;tsType&quot;:&quot;boolean&quot;}}">
class Component extends DCLogic {
  state = { sent:false, subscribed:false };

  componentDidMount(){ this.setupObservers(); }
  componentDidUpdate(){ this.setupObservers(); }

  setupObservers(){
    if(!('IntersectionObserver' in window)){ document.querySelectorAll('.zf-fade').forEach(el=>el.classList.add('zf-vis')); return; }
    const fades=document.querySelectorAll('.zf-fade:not([data-zf-obs])');
    const fo=new IntersectionObserver((es)=>{ es.forEach(e=>{ if(e.isIntersecting){ e.target.classList.add('zf-vis'); fo.unobserve(e.target); } }); },{threshold:.1,rootMargin:'0px 0px -40px 0px'});
    fades.forEach(el=>{ el.setAttribute('data-zf-obs','1'); fo.observe(el); });
    const counters=document.querySelectorAll('.zf-count:not([data-zf-counted])');
    const co=new IntersectionObserver((es)=>{ es.forEach(e=>{ if(e.isIntersecting){ this.animateCount(e.target); co.unobserve(e.target); } }); },{threshold:.4});
    counters.forEach(el=>{ el.setAttribute('data-zf-counted','1'); co.observe(el); });
  }

  animateCount(el){
    const target=parseInt(el.dataset.target)||0, prefix=el.dataset.prefix||'', suffix=el.dataset.suffix||'';
    const dur=1600, t0=performance.now();
    const tick=(now)=>{ const p=Math.min(1,(now-t0)/dur); const e=1-Math.pow(1-p,3); el.textContent=prefix+Math.floor(e*target)+suffix; if(p<1) requestAnimationFrame(tick); else el.textContent=prefix+target+suffix; };
    requestAnimationFrame(tick);
  }

  renderVals(){
    const p=this.props||{};
    const assetBase=<?= json_encode($assetBase, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?>;
    const ic={
      compta:'<svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>',
      audit:'<svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/><line x1="11" y1="8" x2="11" y2="14"/><line x1="8" y1="11" x2="14" y2="11"/></svg>',
      fiscal:'<svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>',
      juridique:'<svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="7" width="20" height="14" rx="0"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg>',
      paie:'<svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>',
      accomp:'<svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>',
    };
    const services=[
      { icon:ic.compta, title:'Expertise Comptable', desc:'Tenue et révision de comptabilité, bilans et comptes de résultat, liasses fiscales et reporting financier.', tags:['Bilan','Comptabilité','Liasse fiscale'] },
      { icon:ic.audit, title:'Audit Financier', desc:'Audit légal et contractuel, commissariat aux comptes, certification des comptes annuels et audit d\u2019acquisition.', tags:['Audit légal','CAC','Certification'] },
      { icon:ic.fiscal, title:'Conseil Fiscal', desc:'Optimisation fiscale, déclarations, accompagnement lors des contrôles fiscaux et veille réglementaire.', tags:['Optimisation','Déclarations','TVA'] },
      { icon:ic.juridique, title:'Conseil Juridique', desc:'Création et transformation de sociétés, rédaction de statuts, pactes d\u2019associés et restructurations.', tags:['Création','Statuts','Fusion'] },
      { icon:ic.paie, title:'Gestion de Paie', desc:'Externalisation complète de la paie, bulletins, déclarations sociales et accompagnement RH.', tags:['Bulletins','Déclarations','RH'] },
      { icon:ic.accomp, title:'Accompagnement', desc:'Business plan, prévisionnel financier, accompagnement à la levée de fonds et suivi de la performance.', tags:['Business plan','Prévisionnel','Levée de fonds'] },
    ];
    const team=[
      { photo:assetBase + '/team/leki.png', name:'Leki MUYEKA', role:'Managing Partner', bio:'Expert-comptable agréé, plus de 30 ans d\u2019expérience en finances, comptabilité, fiscalité et gestion. A exercé au sein du CRS et de MSF Suisse, puis accompagné de nombreuses entreprises comme consultant et formateur. Commissaire aux comptes.' },
      { photo:assetBase + '/team/arly.png', name:'Arly ZAGABE', role:'Expert finance & gouvernance', bio:'20 ans d\u2019expérience en finance et comptabilité. Postes de direction chez Bralima, Cimenterie de Lukala, Texaf, Ascoma et Pactilis RDC. Master en Sciences de gestion ; accompagne les entreprises sur la performance et la stratégie financière.' },
      { photo:assetBase + '/team/guylain.png', name:'Guylain KINVUKA', role:'Comptable', bio:'Master en sciences économiques et administratives (IRD Congo/Kinshasa). 3 ans en comptabilité, 2 ans en audit, 4 ans en fiscalité déclarative. Dynamique, adaptable et rigoureux.' },
      { photo:assetBase + '/team/merveil.png', name:'Merveil MBUYI ONESIME', role:'Analyst Audit · Audit & Assurance', bio:'Diplômé en Gestion financière (Université de Kinshasa). Expérience en audit, conseil et commissariat aux comptes acquise notamment chez Deloitte. Missions pour entreprises, ONG et institutions financières en RDC et à l\u2019international.' },
      { photo:assetBase + '/team/fiston.png', name:'Fiston KAZANGA', role:'Comptable fiscaliste · Assistant auditeur', bio:'Licence en Économie Publique. Expérience en comptabilité, fiscalité et audit financier. Maîtrise des opérations comptables, déclarations fiscales et sociales et du contrôle interne. Rigoureux et méthodique.' },
    ];
    const star='<svg width="16" height="16" viewBox="0 0 24 24" fill="#0000FF" stroke="none"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>';
    const stars=star.repeat(5);
    const testimonials=[
      { photo:'https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?auto=format&fit=crop&w=200&q=80', name:'Marie Lefebvre', company:'Directrice · TechSolutions', text:'\u201cZfinances a transformé notre gestion comptable. Une réactivité exemplaire et des conseils fiscaux qui nous ont fait réaliser des économies substantielles.\u201d' },
      { photo:'https://images.unsplash.com/photo-1560250097-0b93528c311a?auto=format&fit=crop&w=200&q=80', name:'Antoine Bernard', company:'Consultant · AB Conseil', text:'\u201cCompétents et accessibles : disponibles, pédagogues et toujours à jour sur les évolutions réglementaires. Exactement ce dont j\u2019avais besoin.\u201d' },
      { photo:'https://images.unsplash.com/photo-1580489944761-15a19d654956?auto=format&fit=crop&w=200&q=80', name:'Sophie Charpentier', company:'Co-fondatrice · GreenStart', text:'\u201cLeur accompagnement lors de notre levée de fonds a été décisif. Expertise en audit et connaissance des investisseurs au top. Partenaire de confiance !\u201d' },
    ];
    const L=[
      {name:'Infobip',src:assetBase + '/logos/infobip.png'},
      {name:'Standard Telecom',src:assetBase + '/logos/standard.png'},
      {name:'SFA',src:assetBase + '/logos/sfa.png'},
      {name:'Pygma Communication',src:assetBase + '/logos/pygma.png'},
      {name:'Pactilis',src:assetBase + '/logos/pactilis.png'},
      {name:'UTEX',src:assetBase + '/logos/utex.png'},
      {name:'Texaf Bilembo',src:assetBase + '/logos/texaf.png'},
      {name:'Wiko',src:assetBase + '/logos/wiko.png'},
      {name:'Ascoma',src:assetBase + '/logos/ascoma.png'},
      {name:'Amigo Foods',src:assetBase + '/logos/amigo.png'},
      {name:'Carrigres',src:assetBase + '/logos/carrigres.png'},
    ];
    const trustCategories=[
      { title:'Tenue comptable', clients:['INFOBIP','REDITECH','TEXAF BILEMBO','WIKO','SPLITTI · MAFRALAND'] },
      { title:'Ressources humaines', clients:['INFOBIP','OADC','WIOCC','ASCOMA','PACTILIS'] },
      { title:'Projets d\u2019investissement', clients:['MSALABS','ABC','MAFRALAND','AMIGO FOODS','NURAN'] },
      { title:'Conseil fiscal', clients:['UTEXAFRICA · IMMOTEX','COTEX · CARRIGRES','STANDARD TELECOM','GROUPE PYGMA · SFA','CTG · IPP · CJIC'] },
    ];
    return {
      showTrustCategories: p.showTrustCategories ?? true,
      showStatsBand: p.showStatsBand ?? true,
      showApproachPhoto: p.showApproachPhoto ?? true,
      showTeam: p.showTeam ?? true,
      services, team, testimonials, stars,
      logosRow1:[...L,...L], logosRow2:[...[...L].reverse(),...[...L].reverse()],
      trustCategories,
      sent:this.state.sent, subscribed:this.state.subscribed,
      onSubmit:(e)=>{ e.preventDefault(); this.setState({sent:true}); },
      onNewsletter:(e)=>{ e.preventDefault(); this.setState({subscribed:true}); },
    };
  }
}
</script>
</body>
</html>
