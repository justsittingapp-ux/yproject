<?php
$current_page_slug = 'privacy-policy';
include 'head.php';
?>
<!doctype html>
<html lang="<?php echo $current_lang; ?>">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo $lang['meta_title_privacy']; ?></title>
<meta name="description" content="<?php echo $lang['meta_desc_privacy']; ?>">
<?php render_head_assets(); ?>
</head>
<body>
<?php include 'menu.php'; ?>
<main id="main-content">
  <header class="js-page-hero text-center">
    <div class="container py-5">
      <div class="hero-content-wrapper">
        <h1 class="js-page-hero-title"><?php echo $lang['privacy_hero_title']; ?></h1>
        <p class="js-page-hero-tagline"><?php echo $lang['privacy_hero_subtitle']; ?></p>
      </div>
    </div>
  </header>

  <section class="section-padding bg-white">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <div class="legal-content">
            <h2><?php echo $lang['privacy_title']; ?></h2>
            <p class="text-muted"><strong><?php echo $lang['privacy_last_updated']; ?>:</strong> <?php echo date('d.m.Y'); ?></p>

            <h3><?php echo $lang['privacy_sec_1_title']; ?></h3>
            <p><?php echo $lang['privacy_sec_1']; ?></p>

            <h3><?php echo $lang['privacy_sec_2_title']; ?></h3>
            <p><?php echo $lang['privacy_sec_2']; ?></p>

            <h3><?php echo $lang['privacy_sec_3_title']; ?></h3>
            <p><?php echo $lang['privacy_sec_3']; ?></p>

            <h3><?php echo $lang['privacy_sec_4_title']; ?></h3>
            <p><?php echo $lang['privacy_sec_4']; ?></p>

            <h3><?php echo $lang['privacy_sec_5_title']; ?></h3>
            <p><?php echo $lang['privacy_sec_5']; ?></p>

            <h3><?php echo $lang['privacy_sec_6_title']; ?></h3>
            <p><?php echo $lang['privacy_sec_6']; ?></p>

            <h3><?php echo $lang['privacy_contact_title']; ?></h3>
            <p><?php echo $lang['privacy_contact']; ?></p>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>
<?php include 'footer.php'; ?>
</body>
</html>
