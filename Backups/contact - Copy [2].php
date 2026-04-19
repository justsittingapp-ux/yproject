<?php
/**
 * Pagina de Contact - Proiect Calea AutenticÄƒ
 * Versiune bilingvÄƒ completÄƒ (RO/EN)
 */

include 'head.php';

$contact_recipient = 'lawrence.greco@gmail.com';

$allowed_subjects = array(
    'hatha'     => isset($lang['cont_subj_hatha']) ? $lang['cont_subj_hatha'] : 'ÃŽntrebÄƒri Hatha Yoga',
    'vajrayana' => isset($lang['cont_subj_vajrayana']) ? $lang['cont_subj_vajrayana'] : 'Interes pentru Calea Vajrayana',
    'app'       => isset($lang['cont_subj_app']) ? $lang['cont_subj_app'] : 'Probleme Tehnice AplicaÈ›ie',
    'altele'    => isset($lang['cont_subj_other']) ? $lang['cont_subj_other'] : 'Alt subiect'
);

$formData = array('name' => '', 'email' => '', 'subject' => 'hatha', 'message' => '');
$errors = array();

$statusParam = isset($_GET['status']) ? $_GET['status'] : '';
$showForm = ($statusParam !== 'success');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['website_url'])) {
        header('Location: ' . route_url('contact.php', $current_lang, array('status' => 'success')));
        exit;
    }

    $formData['name'] = isset($_POST['name']) ? trim((string) $_POST['name']) : '';
    $formData['email'] = isset($_POST['email']) ? trim((string) $_POST['email']) : '';
    $formData['subject'] = isset($_POST['subject']) ? trim((string) $_POST['subject']) : '';
    $formData['message'] = isset($_POST['message']) ? trim((string) $_POST['message']) : '';

    $captcha_expected = isset($_SESSION['contact_captcha_sum']) ? $_SESSION['contact_captcha_sum'] : null;
    unset($_SESSION['contact_captcha_sum']);
    $captcha_answer = isset($_POST['human_check']) ? (int) $_POST['human_check'] : null;

    if ($formData['name'] === '') {
        $errors[] = isset($lang['cont_err_name']) ? $lang['cont_err_name'] : 'Te rugÄƒm sÄƒ Ã®È›i introduci numele.';
    }
    if ($formData['email'] === '' || !filter_var($formData['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = isset($lang['cont_err_email']) ? $lang['cont_err_email'] : 'Adresa de e-mail nu este validÄƒ.';
    }
    if (!isset($allowed_subjects[$formData['subject']])) {
        $errors[] = isset($lang['cont_err_subject']) ? $lang['cont_err_subject'] : 'Subiectul selectat nu este valid.';
    }
    if ($formData['message'] === '' || mb_strlen($formData['message']) < 15) {
        $errors[] = isset($lang['cont_err_message']) ? $lang['cont_err_message'] : 'Mesajul este prea scurt.';
    }
    if ($captcha_expected === null || $captcha_answer !== $captcha_expected) {
        $errors[] = isset($lang['cont_err_captcha']) ? $lang['cont_err_captcha'] : 'Verificarea a eÈ™uat.';
    }

    if (empty($errors)) {
        $site_name = isset($lang['cont_mail_prefix']) ? $lang['cont_mail_prefix'] : '[Calea AutenticÄƒ]';
        $selected_subject_text = isset($allowed_subjects[$formData['subject']]) ? $allowed_subjects[$formData['subject']] : $formData['subject'];
        $subject_line = $site_name . ' ' . $selected_subject_text;

        $fromHost = isset($_SERVER['HTTP_HOST']) ? preg_replace('/[^a-zA-Z0-9.-]/', '', $_SERVER['HTTP_HOST']) : 'localhost';
        $headers = "MIME-Version: 1.0\r\nContent-Type: text/plain; charset=UTF-8\r\nFrom: Formular site <noreply@$fromHost>\r\nReply-To: {$formData['email']}";

        $mail_body = (isset($lang['cont_mail_intro']) ? $lang['cont_mail_intro'] : 'Mesaj de la: ') . $formData['name'] . "\n";
        $mail_body .= $formData['message'];

        if (@mail($contact_recipient, '=?UTF-8?B?' . base64_encode($subject_line) . '?=', $mail_body, $headers)) {
            header('Location: ' . route_url('contact.php', $current_lang, array('status' => 'success')));
            exit;
        }
    }
}

$captcha_n1 = random_int(1, 9);
$captcha_n2 = random_int(1, 9);
if ($showForm) {
    $_SESSION['contact_captcha_sum'] = $captcha_n1 + $captcha_n2;
}
?>
<!doctype html>
<html lang="<?php echo $current_lang; ?>">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="<?php echo isset($lang['cont_meta_desc']) ? $lang['cont_meta_desc'] : 'Contact'; ?>">
<title><?php echo isset($lang['cont_meta_title']) ? $lang['cont_meta_title'] : 'Contact'; ?></title>
<?php render_head_assets(); ?>
</head>
<body class="contact-page-body">
<?php include 'menu.php'; ?>
<main id="main-content" class="contact-page-main section-padding">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-lg-8 col-xl-7 contact-narrow">
        <header class="text-center mb-5 contact-intro">
          <h1 class="contact-page-title"><?php echo isset($lang['cont_title']) ? $lang['cont_title'] : 'Contact'; ?></h1>
          <p class="contact-lead text-muted"><?php echo isset($lang['cont_lead']) ? $lang['cont_lead'] : '...'; ?></p>
        </header>
        <?php if ($statusParam === 'success') : ?>
        <div class="alert alert-success border-0 rounded-0 contact-alert"> <?php echo isset($lang['cont_success_msg']) ? $lang['cont_success_msg'] : 'Trimis!'; ?> </div>
        <p class="text-center small"><a href="<?php echo htmlspecialchars(route_url('contact.php')); ?>"><?php echo isset($lang['cont_send_another']) ? $lang['cont_send_another'] : 'Trimite alt mesaj'; ?></a></p>
        <?php endif; ?>
        <?php if (!empty($errors)) : ?>
        <div class="alert alert-danger border-0 rounded-0 contact-alert">
          <ul class="mb-0 ps-3">
            <?php foreach ($errors as $err) : ?>
            <li><?php echo htmlspecialchars($err); ?></li>
            <?php endforeach; ?>
          </ul>
        </div>
        <?php endif; ?>
        <?php if ($showForm) : ?>
        <div class="card border-0 shadow-sm contact-card mb-5">
          <div class="card-body p-4 p-md-5">
            <form class="contact-form" method="post" action="<?php echo htmlspecialchars(route_url('contact.php')); ?>">
              <div style="display:none;">
                <input type="text" name="website_url" tabindex="-1">
              </div>
              <div class="mb-4">
                <label class="form-label"><?php echo isset($lang['cont_name_label']) ? $lang['cont_name_label'] : 'Nume'; ?> *</label>
                <input type="text" name="name" class="form-control contact-input" required value="<?php echo htmlspecialchars($formData['name']); ?>" placeholder="<?php echo htmlspecialchars(isset($lang['cont_name_ph']) ? $lang['cont_name_ph'] : ''); ?>">
              </div>
              <div class="mb-4">
                <label class="form-label"><?php echo isset($lang['cont_email_label']) ? $lang['cont_email_label'] : 'Email'; ?> *</label>
                <input type="email" name="email" class="form-control contact-input" required value="<?php echo htmlspecialchars($formData['email']); ?>" placeholder="<?php echo htmlspecialchars(isset($lang['cont_email_ph']) ? $lang['cont_email_ph'] : ''); ?>">
              </div>
              <div class="mb-4">
                <label class="form-label"><?php echo isset($lang['cont_subject_label']) ? $lang['cont_subject_label'] : 'Subiect'; ?></label>
                <select name="subject" class="form-select contact-input">
                  <?php foreach ($allowed_subjects as $val => $label) : ?>
                  <option value="<?php echo $val; ?>"<?php echo $formData['subject'] === $val ? ' selected' : ''; ?>><?php echo $label; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="mb-4">
                <label class="form-label"><?php echo isset($lang['cont_message_label']) ? $lang['cont_message_label'] : 'Mesaj'; ?> *</label>
                <textarea name="message" class="form-control contact-input" rows="8" required placeholder="<?php echo htmlspecialchars(isset($lang['cont_message_ph']) ? $lang['cont_message_ph'] : ''); ?>"><?php echo htmlspecialchars($formData['message']); ?></textarea>
              </div>
              <div class="mb-4">
                <label class="form-label"><?php echo isset($lang['cont_captcha_label']) ? $lang['cont_captcha_label'] : 'Verificare'; ?> *</label>
                <div class="input-group"> <span class="input-group-text"><?php echo isset($lang['cont_captcha_q']) ? $lang['cont_captcha_q'] : 'CÃ¢t fac'; ?> <?php echo $captcha_n1; ?> + <?php echo $captcha_n2; ?>?</span>
                  <input type="text" name="human_check" class="form-control contact-input" required placeholder="<?php echo htmlspecialchars(isset($lang['cont_captcha_ph']) ? $lang['cont_captcha_ph'] : ''); ?>">
                </div>
                <?php if (isset($lang['cont_captcha_help']) && $lang['cont_captcha_help'] !== '') : ?>
                <div class="form-text"><?php echo $lang['cont_captcha_help']; ?></div>
                <?php endif; ?>
              </div>
              <div class="d-grid">
                <button type="submit" class="btn btn-custom btn-lg" id="contactSubmitBtn"> <span class="contact-submit-label"><?php echo isset($lang['cont_submit_btn']) ? $lang['cont_submit_btn'] : 'Trimite'; ?></span> <span class="contact-submit-loading d-none spinner-border spinner-border-sm ms-2"></span> </button>
              </div>
            </form>
          </div>
        </div>
        <?php endif; ?>
        <section class="contact-alt text-center mb-4">
          <h2 class="h5"><?php echo isset($lang['cont_alt_title']) ? $lang['cont_alt_title'] : 'Alte cÄƒi'; ?></h2>
          <p><?php echo isset($lang['cont_alt_direct']) ? $lang['cont_alt_direct'] : ''; ?></p>
          <p id="contactEmailMount"></p>
        </section>
      </div>
    </div>
  </div>
</main>
<?php include 'footer.php'; ?>
<script>
(function () {
  var addr = 'lawrence' + '.greco' + '@' + 'gmail' + '.com';
  var el = document.getElementById('contactEmailMount');
  if (el) el.innerHTML = '<a class="contact-mailto-link" href="mailto:' + addr + '">' + addr + '</a>';

  var form = document.querySelector('.contact-form');
  var btn = document.getElementById('contactSubmitBtn');
  if (form && btn) {
    form.addEventListener('submit', function () {
      if (!form.checkValidity()) return;
      btn.disabled = true;
      var lab = btn.querySelector('.contact-submit-label');
      var sp = btn.querySelector('.contact-submit-loading');
      if (lab) lab.textContent = "<?php echo isset($lang['cont_sending_status']) ? $lang['cont_sending_status'] : 'Se trimite...'; ?>";
      if (sp) sp.classList.remove('d-none');
    });
  }
})();
</script>
</body>
</html>
