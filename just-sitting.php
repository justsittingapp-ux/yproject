<?php
$just_sitting_play_url = 'https://play.google.com/store/apps/details?id=com.lawrence.justsitting&hl=en';

$just_sitting_gallery = glob(__DIR__ . '/img/*.{png,jpg,jpeg,webp}', GLOB_BRACE);
if ($just_sitting_gallery === false) {
    $just_sitting_gallery = array();
}

natsort($just_sitting_gallery);
$just_sitting_gallery = array_values(array_filter($just_sitting_gallery, function ($path) {
    return strcasecmp(basename($path), 'justsittingbig.png') !== 0;
}));
$just_sitting_gallery = array_slice($just_sitting_gallery, 0, 8);

include 'head.php';
$pagina_curenta = 'just-sitting.php';
?>
<!doctype html>
<html lang="<?php echo $current_lang; ?>">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="<?php echo $lang['meta_desc_js']; ?>">
<title><?php echo $lang['meta_title_js']; ?></title>
<?php render_head_assets(); ?>
</head>
<body class="just-sitting-page-body">
<?php include 'menu.php'; ?>
<main id="main-content">
  <header class="js-page-hero text-center">
    <div class="container py-5">
      <h1 class="js-page-hero-title"><?php echo $lang['js_hero_title']; ?></h1>
      <p class="js-page-hero-tagline mb-0"><?php echo $lang['js_hero_tagline']; ?></p>
    </div>
  </header>
  <section class="section-padding just-sitting-section" id="despre">
    <div class="container">
      <div class="row align-items-start g-4 g-lg-5">
        <div class="col-lg-5 text-center">
          <?php if (!empty($just_sitting_gallery)) : ?>
          <div class="row g-2 g-md-3 mt-3 mt-md-4 just-sitting-thumbs justify-content-center">
            <?php foreach ($just_sitting_gallery as $i => $thumb_fullpath) :
    // Calculăm timpul ultimei modificări a fișierului pentru a forța refresh-ul
    $version = filemtime($thumb_fullpath); 
    $thumb_src = asset_url('img/' . basename($thumb_fullpath)) . '?v=' . $version;
    $shot_alt = 'Just Sitting screenshot ' . ((int) $i + 1);
?>
            <div class="col-6">
              <button type="button" class="just-sitting-thumb-trigger" data-bs-toggle="modal" data-bs-target="#justSittingScreenshotModal" data-img-src="<?php echo htmlspecialchars($thumb_src); ?>" data-img-alt="<?php echo htmlspecialchars($shot_alt); ?>" aria-label="Enlarge <?php echo htmlspecialchars($shot_alt); ?>"> <img src="<?php echo htmlspecialchars($thumb_src); ?>" class="img-fluid just-sitting-thumb-img rounded shadow-sm" alt="<?php echo htmlspecialchars($shot_alt); ?>" loading="lazy"> </button>
            </div>
            <?php endforeach; ?>
          </div>
          <?php endif; ?>
        </div>
        <div class="col-lg-7">
          <h2 class="section-title just-sitting-main-title"> <?php echo $lang['js_main_title']; ?> </h2>
          <div class="just-sitting-content">
            <p class="lead"><?php echo $lang['js_desc_lead']; ?></p>
            <p><?php echo $lang['js_desc_body']; ?></p>
            <h3 class="just-sitting-subtitle mt-4"><?php echo $lang['js_depth_title']; ?></h3>
            <p><?php echo $lang['js_depth_intro']; ?></p>
            <ul class="just-sitting-list">
              <li><?php echo $lang['js_path_1']; ?></li>
              <li><?php echo $lang['js_path_2']; ?></li>
              <li><?php echo $lang['js_path_3']; ?></li>
            </ul>
            <h3 class="just-sitting-subtitle mt-4"><?php echo $lang['js_essence_title']; ?></h3>
            <p><?php echo $lang['js_essence_body']; ?></p>
            <h3 class="just-sitting-subtitle mt-4"><?php echo $lang['js_features_title']; ?></h3>
            <ul class="just-sitting-list">
              <li><?php echo $lang['js_feat_1']; ?></li>
              <li><?php echo $lang['js_feat_2']; ?></li>
              <li><?php echo $lang['js_feat_3']; ?></li>
              <li><?php echo $lang['js_feat_4']; ?></li>
              <li><?php echo $lang['js_feat_5']; ?></li>
            </ul>
            <h3 class="just-sitting-subtitle mt-4"><?php echo $lang['js_stats_title']; ?></h3>
            <p><?php echo $lang['js_stats_desc']; ?></p>
            <h3 class="just-sitting-subtitle mt-4"><?php echo $lang['js_phil_title']; ?></h3>
            <p><?php echo $lang['js_phil_body']; ?></p>
            <a href="<?php echo htmlspecialchars($just_sitting_play_url); ?>" class="just-sitting-img-link d-inline-block" target="_blank" rel="noopener noreferrer" aria-label="Open Just Sitting in Google Play"> 
    <img src="<?php echo htmlspecialchars(asset_url('imgs/justsittingbig.jpg?v=1')); ?>" class="img-fluid just-sitting-img rounded shadow" alt="Just Sitting app" loading="lazy"> 
</a></div>
        </div>
      </div>
    </div>
  </section>
  <section class="section-padding bg-white" id="tutoriale">
    <div class="container">
      <h2 class="section-title js-section-heading"><?php echo $lang['js_tut_title']; ?></h2>
      <p class="text-center text-muted mx-auto mb-5 js-section-lead"><?php echo $lang['js_tut_lead']; ?></p>
      <div class="row g-4">
        <div class="col-md-6 col-lg-4">
          <div class="js-tutorial-card h-100 p-4 border border-light-subtle shadow-sm">
            <h3 class="h5 just-sitting-subtitle mb-3"><?php echo $lang['js_tut_step1_title']; ?></h3>
            <p class="mb-0 small"><?php echo str_replace('%PLAY_URL%', htmlspecialchars($just_sitting_play_url), $lang['js_tut_step1_text']); ?></p>
          </div>
        </div>
        <div class="col-md-6 col-lg-4">
          <div class="js-tutorial-card h-100 p-4 border border-light-subtle shadow-sm">
            <h3 class="h5 just-sitting-subtitle mb-3"><?php echo $lang['js_tut_step2_title']; ?></h3>
            <p class="mb-0 small"><?php echo $lang['js_tut_step2_text']; ?></p>
          </div>
        </div>
        <div class="col-md-6 col-lg-4">
          <div class="js-tutorial-card h-100 p-4 border border-light-subtle shadow-sm">
            <h3 class="h5 just-sitting-subtitle mb-3"><?php echo $lang['js_tut_step3_title']; ?></h3>
            <p class="mb-0 small"><?php echo $lang['js_tut_step3_text']; ?></p>
          </div>
        </div>
        <div class="col-md-6 col-lg-4">
          <div class="js-tutorial-card h-100 p-4 border border-light-subtle shadow-sm">
            <h3 class="h5 just-sitting-subtitle mb-3"><?php echo $lang['js_tut_step4_title']; ?></h3>
            <p class="mb-0 small"><?php echo $lang['js_tut_step4_text']; ?></p>
          </div>
        </div>
        <div class="col-md-6 col-lg-4">
          <div class="js-tutorial-card h-100 p-4 border border-light-subtle shadow-sm">
            <h3 class="h5 just-sitting-subtitle mb-3"><?php echo $lang['js_tut_step5_title']; ?></h3>
            <p class="mb-0 small"><?php echo $lang['js_tut_step5_text']; ?></p>
          </div>
        </div>
        <div class="col-md-6 col-lg-4">
          <div class="js-tutorial-card h-100 p-4 border border-light-subtle shadow-sm">
            <h3 class="h5 just-sitting-subtitle mb-3"><?php echo $lang['js_tut_step6_title']; ?></h3>
            <p class="mb-0 small"><?php echo $lang['js_tut_step6_text']; ?></p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="section-padding js-download-section" id="descarcare">
    <div class="container text-center">
      <h2 class="section-title js-section-heading js-download-title"><?php echo $lang['js_download_title']; ?></h2>
      <p class="mx-auto mb-4 js-download-lead"><?php echo $lang['js_download_lead']; ?></p>
      <div class="mb-5"> <a href="<?php echo htmlspecialchars($just_sitting_play_url); ?>" target="_blank" rel="noopener noreferrer" class="d-inline-block google-play-badge"> <img src="<?php echo $lang['js_play_store_badge']; ?>" alt="<?php echo $lang['js_play_store_alt']; ?>" class="img-fluid" style="max-width: 200px;"> </a> </div>
      <p class="small text-white-50 mb-3"><?php echo $lang['js_nonprofit_text']; ?></p>
      <div class="contact-social d-flex justify-content-center gap-4 align-items-center"> <a href="https://x.com/Just4Sitting" class="contact-social-link js-social-mute" target="_blank" rel="noopener noreferrer" aria-label="Just Sitting on X"> <svg class="contact-social-icon" xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true">
        <path d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633L12.601.75Zm-.86 13.028h1.36L4.323 2.145H2.865z"/>
        </svg> </a> <a href="https://www.instagram.com/just_sitting_09/" class="contact-social-link js-social-mute" target="_blank" rel="noopener noreferrer" aria-label="Just Sitting on Instagram"> <svg class="contact-social-icon" xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true">
        <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.509-.198-1.09-.333-1.942-.372C10.443.01 10.172 0 7.998 0zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.109.282.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.109.705-.24 1.485-.276.738-.034 1.02-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92M8 3.863c-2.302 0-4.165 1.863-4.165 4.165 0 2.302 1.863 4.165 4.165 4.165s4.165-1.863 4.165-4.165c0-2.302-1.863-4.165-4.165-4.165m0 1.442a2.723 2.723 0 1 1 0 5.446 2.723 2.723 0 0 1 0-5.446"/>
        </svg> </a> </div>
    </div>
  </section>
</main>
<?php if (!empty($just_sitting_gallery)) : ?>
<div class="modal fade" id="justSittingScreenshotModal" tabindex="-1" aria-labelledby="justSittingScreenshotModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable just-sitting-screenshot-modal">
    <div class="modal-content just-sitting-modal-content">

      <div class="modal-header border-0 pb-0">
        <h5 class="modal-title" id="justSittingScreenshotModalLabel">Screenshot</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body pt-2 text-center position-relative px-5">

        <!-- Săgeată STÂNGA -->
        <button id="jsModalPrev"
                type="button"
                aria-label="Imaginea anterioară"
                style="
                  position:absolute; left:0; top:50%; transform:translateY(-50%);
                  background:rgba(212,175,55,0.15); border:none; border-radius:0 4px 4px 0;
                  color:#D4AF37; font-size:1.5rem; padding:0.6rem 0.75rem;
                  cursor:pointer; transition:background 0.2s; z-index:10;
                ">&#8592;</button>

        <img src="" alt="" class="img-fluid rounded just-sitting-modal-img" id="justSittingScreenshotModalImg">

        <!-- Săgeată DREAPTA -->
        <button id="jsModalNext"
                type="button"
                aria-label="Imaginea următoare"
                style="
                  position:absolute; right:0; top:50%; transform:translateY(-50%);
                  background:rgba(212,175,55,0.15); border:none; border-radius:4px 0 0 4px;
                  color:#D4AF37; font-size:1.5rem; padding:0.6rem 0.75rem;
                  cursor:pointer; transition:background 0.2s; z-index:10;
                ">&#8594;</button>

      </div><!-- /.modal-body -->
    </div>
  </div>
</div>
<?php endif; ?>
<?php include 'footer.php'; ?>
<script src="<?php echo htmlspecialchars(asset_url('just-sitting-modal.js')); ?>" defer></script>
</body>
</html>
