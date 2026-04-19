<?php
include 'head.php';
$pagina_curenta = 'calea.php';
?>
<!doctype html>
<html lang="<?php echo $current_lang; ?>">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="<?php echo $lang['meta_desc_calea']; ?>">
<title><?php echo $lang['meta_title_calea']; ?></title>
<?php render_head_assets(); ?>
</head>
<body class="calea-page-body">
<?php include 'menu.php'; ?>
<main id="main-content">
  <header class="js-page-hero text-center">
    <div class="container py-5">
      <h1 class="js-page-hero-title"><?php echo $lang['calea_hero_title']; ?></h1>
      <p class="js-page-hero-tagline mb-0"><?php echo $lang['calea_hero_subtitle']; ?></p>
    </div>
  </header>
  <section class="section-padding" id="mahamudra-content">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <p class="lead mb-5 text-center"><?php echo $lang['calea_intro_text']; ?></p>
          <div class="text-center mb-5"> <img src="<?php echo htmlspecialchars(asset_url('imgs/mahamudra1.webp')); ?>" class="img-fluid rounded shadow-sm" alt="Mahasiddha" style="max-height: 400px;"> </div>
          <h2 class="just-sitting-subtitle mb-4"><?php echo $lang['calea_guide_title']; ?></h2>
          <p><?php echo $lang['calea_guide_intro']; ?></p>
          <ul class="just-sitting-list mt-4">
            <li class="mb-4"><strong><?php echo $lang['error_1_title']; ?></strong> <?php echo $lang['error_1_text']; ?></li>
            <li class="mb-4"><strong><?php echo $lang['error_2_title']; ?></strong> <?php echo $lang['error_2_text']; ?></li>
            <li class="mb-4"><strong><?php echo $lang['error_3_title']; ?></strong> <?php echo $lang['error_3_text']; ?></li>
            <li class="mb-4"><strong><?php echo $lang['error_4_title']; ?></strong> <?php echo $lang['error_4_text']; ?></li>
          </ul>
          <div class="mt-5 p-4 bg-light rounded border-start border-4 border-secondary">
            <p class="small mb-2"><strong><?php echo $lang['note_shunyata_title']; ?></strong> <?php echo $lang['note_shunyata_text']; ?></p>
            <p class="small mb-0"><strong><?php echo $lang['note_kalpana_title']; ?></strong> <?php echo $lang['note_kalpana_text']; ?></p>
          </div>
          <div class="mt-5 mb-1">
            <h2 class="just-sitting-subtitle mb-4"><?php echo $lang['calea_deep_title']; ?></h2>
            <p class="fst-italic border-start ps-3 py-2 border-primary" style="background-color: #fdf8f4;"> "<?php echo $lang['calea_deep_quote']; ?>" </p>
            <div class="row mt-4">
              <div class="col-md-4 mb-3">
                <h5 class="text-secondary fw-bold"><?php echo $lang['calea_deep_1_title']; ?></h5>
                <p class="small"><?php echo $lang['calea_deep_1_text']; ?></p>
              </div>
              <div class="col-md-4 mb-3">
                <h5 class="text-secondary fw-bold"><?php echo $lang['calea_deep_2_title']; ?></h5>
                <p class="small"><?php echo $lang['calea_deep_2_text']; ?></p>
              </div>
              <div class="col-md-4 mb-3">
                <h5 class="text-secondary fw-bold"><?php echo $lang['calea_deep_3_title']; ?></h5>
                <p class="small"><?php echo $lang['calea_deep_3_text']; ?></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>
<?php include 'footer.php'; ?>
</body>
</html>
