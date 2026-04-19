<?php
$pagina_curenta = basename($_SERVER['PHP_SELF']);
$current_page_slug = isset($current_page_slug) ? $current_page_slug : page_slug_from_script($pagina_curenta);
$lang_switch_params = $_GET;
unset($lang_switch_params['l']);
$lang_switch_ro = route_url($pagina_curenta, 'ro', $lang_switch_params);
$lang_switch_en = route_url($pagina_curenta, 'en', $lang_switch_params);
?><a href="#main-content" class="skip-to-main">Sari la continut</a>

<nav class="navbar navbar-expand-lg sticky-top">
  <div class="container">
    <a class="navbar-brand" href="<?php echo htmlspecialchars(route_url('index.php')); ?>">Just Sitting</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link <?php echo ($current_page_slug == 'index') ? 'active' : ''; ?>" href="<?php echo htmlspecialchars(route_url('index.php')); ?>">
            <?php echo $lang['nav_home']; ?>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo ($current_page_slug == 'calea') ? 'active' : ''; ?>" href="<?php echo htmlspecialchars(route_url('calea.php')); ?>">
            <?php echo $lang['nav_path']; ?>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo ($current_page_slug == 'invatatura') ? 'active' : ''; ?>" href="<?php echo htmlspecialchars(route_url('invatatura.php')); ?>">
            <?php echo $lang['nav_wisdom']; ?>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo ($current_page_slug == 'just-sitting') ? 'active' : ''; ?>" href="<?php echo htmlspecialchars(route_url('just-sitting.php')); ?>">
            <?php echo $lang['nav_just_sitting']; ?>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo ($current_page_slug == 'contact') ? 'active' : ''; ?>" href="<?php echo htmlspecialchars(route_url('contact.php')); ?>">
            <?php echo $lang['nav_contact']; ?>
          </a>
        </li>
        <li class="nav-item d-flex align-items-center ms-lg-3">
          <div class="nav-lang-pastille">
            <a class="lang-link <?php echo ($current_lang == 'ro') ? 'is-active' : ''; ?>" href="<?php echo htmlspecialchars($lang_switch_ro); ?>">RO</a>
            <a class="lang-link <?php echo ($current_lang == 'en') ? 'is-active' : ''; ?>" href="<?php echo htmlspecialchars($lang_switch_en); ?>">EN</a>
          </div>
        </li>
      </ul>
    </div>
  </div>
</nav>
