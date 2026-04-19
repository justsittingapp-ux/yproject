<?php
include 'head.php';
$pagina_curenta = 'invatatura.php';
// Asigură-te că fișierul de setup al limbii este inclus aici
?>
<!doctype html>
<html lang="<?php echo $current_lang; ?>">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="<?php echo $lang['inv_meta_description']; ?>">
<title><?php echo $lang['inv_meta_title']; ?></title>
<?php render_head_assets(); ?>
<style>
.wisdom-quote {
	border-left: 3px solid #ccc;
	padding-left: 20px;
	font-style: italic;
	margin: 40px 0;
	color: #555;
}
.concept-card {
	background: #fcfcfc;
	border: 1px solid #eee;
	transition: all 0.3s ease;
}
.concept-card:hover {
	border-color: #ddd;
	background: #fff;
}
</style>
</head>
<body class="wisdom-page-body">
<?php include 'menu.php'; ?>
<main id="main-content">
  <header class="js-page-hero text-center">
    <div class="container py-5">
      <h1 class="js-page-hero-title"> <?php echo $lang['inv_hero_title']; ?> </h1>
      <p class="js-page-hero-tagline mb-0"> <?php echo $lang['inv_hero_tagline']; ?> </p>
    </div>
  </header>
  <section class="section-padding">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <h2 class="just-sitting-subtitle text-center mb-4"> <?php echo $lang['inv_vision_title']; ?> </h2>
          <p class="lead text-center mb-5"> <?php echo $lang['inv_vision_lead']; ?> </p>
          <div class="text-center mb-5"> <img src="<?php echo htmlspecialchars(asset_url('imgs/green_tara.webp')); ?>" class="img-fluid rounded shadow-sm" alt="G reen Tara" style="max-height: 400px;"> </div>
          <div class="wisdom-quote"> "<?php echo $lang['inv_quote_sengcan']; ?>" <br>
            <?php /*?><small>— <?php echo $lang['inv_quote_author']; ?></small> <?php */?></div>
          <h3 class="mt-5"> <?php echo $lang['inv_2truths_title']; ?> </h3>
          <p> <?php echo $lang['inv_2truths_lead']; ?> </p>
          <div class="row g-4 mt-2">
            <div class="col-md-6">
              <div class="p-4 concept-card h-100 rounded">
                <h5><?php echo $lang['inv_truth_relative_title']; ?></h5>
                <p class="small text-muted"> <?php echo $lang['inv_truth_relative_desc']; ?> </p>
              </div>
            </div>
            <div class="col-md-6">
              <div class="p-4 concept-card h-100 rounded shadow-sm">
                <h5><?php echo $lang['inv_truth_ultimate_title']; ?></h5>
                <p class="small text-muted"> <?php echo $lang['inv_truth_ultimate_desc']; ?> </p>
              </div>
            </div>
          </div>
          <hr class="my-5">
          <h3 class="just-sitting-subtitle mt-4 text-center"> <?php echo $lang['inv_pillars_title']; ?> </h3>
          <ul class="just-sitting-list mt-4">
            <li><strong><?php echo $lang['inv_pillar_1_title']; ?></strong> <?php echo $lang['inv_pillar_1_desc']; ?></li>
            <li><strong><?php echo $lang['inv_pillar_2_title']; ?></strong> <?php echo $lang['inv_pillar_2_desc']; ?></li>
            <li><strong><?php echo $lang['inv_pillar_3_title']; ?></strong> <?php echo $lang['inv_pillar_3_desc']; ?></li>
          </ul>
          <div class="mt-5 pt-4">
            <h3 class="just-sitting-subtitle mb-4 text-center"><?php echo $lang['inv_nature_title']; ?></h3>
            <p class="text-center italic mb-5"><?php echo $lang['inv_nature_lead']; ?></p>
            <div class="row g-4">
              <div class="col-md-4">
                <div class="p-3 border-top border-2 border-secondary h-100">
                  <h6 class="fw-bold"><?php echo $lang['inv_nature_1_title']; ?></h6>
                  <p class="small"><?php echo $lang['inv_nature_1_desc']; ?></p>
                </div>
              </div>
              <div class="col-md-4">
                <div class="p-3 border-top border-2 border-secondary h-100">
                  <h6 class="fw-bold"><?php echo $lang['inv_nature_2_title']; ?></h6>
                  <p class="small"><?php echo $lang['inv_nature_2_desc']; ?></p>
                </div>
              </div>
              <div class="col-md-4">
                <div class="p-3 border-top border-2 border-secondary h-100">
                  <h6 class="fw-bold"><?php echo $lang['inv_nature_3_title']; ?></h6>
                  <p class="small"><?php echo $lang['inv_nature_3_desc']; ?></p>
                </div>
              </div>
            </div>
          </div>
          <div class="text-center mt-5">
            <p class="font-monospace small"> <?php echo $lang['inv_pillars_closing']; ?> </p>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>
<?php include 'footer.php'; ?>
</body>
</html>
