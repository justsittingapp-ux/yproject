<?php
include 'head.php';
?>
<!doctype html>
<html lang="<?php echo $current_lang; ?>">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo $lang['meta_title']; ?></title>
<meta name="description" content="<?php echo $lang['meta_description']; ?>">
<?php render_head_assets(); ?>
</head>
<body class="home-page-body">
<?php include 'menu.php'; ?>
<main id="main-content">
  <header class="js-page-hero text-center hero-home-special">
    <div class="container py-5">
      <div class="hero-content-wrapper">
        <h1 class="js-page-hero-title"><?php echo $lang['hero_title']; ?></h1>
        <p class="js-page-hero-tagline"><?php echo $lang['hero_subtitle']; ?></p>
        <a href="<?php echo htmlspecialchars(route_url('calea.php')); ?>" class="btn btn-custom mt-4 px-4"><?php echo $lang['hero_btn']; ?></a>
      </div>
    </div>
  </header>
  <section class="section-padding bg-white">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-9">
          <header class="text-center mb-5">
            <h2 class="just-sitting-subtitle"><?php echo $lang['intro_title']; ?></h2>
            <p class="text-muted italic"><?php echo $lang['intro_subtitle']; ?></p>
          </header>
          <div class="just-sitting-content">
            <p><?php echo $lang['intro_text_1']; ?></p>
            <p><?php echo $lang['intro_text_2']; ?></p>
            <div class="p-4 my-5 bg-light border-start border-4 border-secondary shadow-sm">
              <p class="mb-0 fst-italic">"<?php echo $lang['intro_quote']; ?>"</p>
            </div>
            <p><?php echo $lang['intro_final']; ?></p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="section-padding bg-light">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6">
          <h2 class="just-sitting-subtitle mb-4"><?php echo $lang['trad_title']; ?></h2>
          <p><?php echo $lang['trad_intro']; ?></p>
          <p><?php echo $lang['trad_lineage']; ?></p>
          <p><?php echo $lang['trad_chain']; ?></p>
          <p><?php echo $lang['trad_text_1']; ?></p>
          <p><?php echo $lang['trad_text_2']; ?></p>
          <p class="fst-italic mt-4"><?php echo $lang['trad_quote']; ?></p>
        </div>
        <div class="col-lg-6">
          <img src="<?php echo htmlspecialchars(asset_url('imgs/naro.jpg')); ?>" class="img-fluid rounded shadow-lg" alt="Naropa">
        </div>
      </div>
    </div>
  </section>
  <section class="section-padding">
    <div class="container">
      <h2 class="section-title text-center mb-5"><?php echo isset($lang['pillar_title']) ? $lang['pillar_title'] : 'Cei Patru Piloni Vajrayana'; ?></h2>
      <div class="row g-4">
        <?php
        $piloni = array(
          array($lang['pillar_1_title'], $lang['pillar_1_desc']),
          array($lang['pillar_2_title'], $lang['pillar_2_desc']),
          array($lang['pillar_3_title'], $lang['pillar_3_desc']),
          array($lang['pillar_4_title'], $lang['pillar_4_desc'])
        );
        foreach ($piloni as $p): ?>
        <div class="col-md-6">
          <div class="rounded h-100 pillar-card shadow-lg">
            <h4 class="just-sitting-subtitle h5"><?php echo $p[0]; ?></h4>
            <p class="mb-0"><?php echo $p[1]; ?></p>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
  <section class="section-padding text-center bg-dark text-white">
    <div class="container py-4">
      <h2 class="mb-4"><?php echo $lang['cta_ready']; ?></h2>
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <p class="lead mb-5 text-white-50"><?php echo $lang['cta_description']; ?></p>
          <div class="d-flex flex-column flex-sm-row justify-content-center gap-3">
            <a href="<?php echo htmlspecialchars(route_url('just-sitting.php')); ?>" class="btn btn-custom btn-lg px-4"><?php echo $lang['cta_btn_app']; ?></a>
            <a href="<?php echo htmlspecialchars(route_url('contact.php')); ?>" class="btn btn-outline-light btn-lg px-4"><?php echo $lang['cta_btn_contact']; ?></a>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>
<?php include 'footer.php'; ?>
</body>
</html>
