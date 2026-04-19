<?php
/**
 * Pagina de Contact - Calea Autentică
 * Păstrează stilurile originale și rezolvă conflictele de sesiune.
 */

// 1. REZOLVARE EROARE SESIUNE: Verificăm dacă e pornită înainte de session_start
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 2. REZOLVARE ERORI ROȘII IDE: Inițializăm variabila $lang pentru editor
$lang = array(); 

// 3. Încărcăm sistemul de limbi
$current_lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'ro';
$lang_file = 'languages/' . $current_lang . '.php';

if (file_exists($lang_file)) {
    include $lang_file;
}

$contact_recipient = 'lawrence.greco@gmail.com';

// 4. Subiectele traduse (Păstrăm opțiunile tale originale cu fallback)
$allowed_subjects = array(
    'hatha'     => isset($lang['cont_subj_hatha']) ? $lang['cont_subj_hatha'] : 'Întrebări Hatha Yoga',
    'vajrayana' => isset($lang['cont_subj_vajrayana']) ? $lang['cont_subj_vajrayana'] : 'Interes pentru Calea Vajrayana',
    'app'       => isset($lang['cont_subj_app']) ? $lang['cont_subj_app'] : 'Probleme Tehnice Aplicație',
    'altele'    => isset($lang['cont_subj_other']) ? $lang['cont_subj_other'] : 'Alt subiect'
);

$formData = array('name' => '', 'email' => '', 'subject' => 'hatha', 'message' => '');
$errors = array();

$statusParam = isset($_GET['status']) ? $_GET['status'] : '';
$showForm = ($statusParam !== 'success');

// 5. Procesare Formular (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['website_url'])) {
        header('Location: contact.php?status=success');
        exit;
    }

    $formData['name'] = isset($_POST['name']) ? trim((string)$_POST['name']) : '';
    $formData['email'] = isset($_POST['email']) ? trim((string)$_POST['email']) : '';
    $formData['subject'] = isset($_POST['subject']) ? trim((string)$_POST['subject']) : '';
    $formData['message'] = isset($_POST['message']) ? trim((string)$_POST['message']) : '';

    $captcha_expected = isset($_SESSION['contact_captcha_sum']) ? $_SESSION['contact_captcha_sum'] : null;
    unset($_SESSION['contact_captcha_sum']);
    $captcha_answer = isset($_POST['human_check']) ? (int)$_POST['human_check'] : null;

    if ($formData['name'] === '') $errors[] = isset($lang['cont_err_name']) ? $lang['cont_err_name'] : 'Te rugăm să îți introduci numele.';
    if ($formData['email'] === '' || !filter_var($formData['email'], FILTER_VALIDATE_EMAIL)) $errors[] = isset($lang['cont_err_email']) ? $lang['cont_err_email'] : 'Adresa de e-mail nu este validă.';
    if ($formData['message'] === '' || mb_strlen($formData['message']) < 15) $errors[] = isset($lang['cont_err_message']) ? $lang['cont_err_message'] : 'Mesajul este prea scurt (minimum 15 caractere).';
    if ($captcha_expected === null || $captcha_answer !== $captcha_expected) $errors[] = isset($lang['cont_err_captcha']) ? $lang['cont_err_captcha'] : 'Verificarea simplă nu s-a potrivit.';

    if (empty($errors)) {
        $subject_line = '[Calea Autentică] ' . $allowed_subjects[$formData['subject']];
        $fromHost = isset($_SERVER['HTTP_HOST']) ? preg_replace('/[^a-zA-Z0-9.-]/', '', $_SERVER['HTTP_HOST']) : 'localhost';
        $headers = "MIME-Version: 1.0\r\nContent-Type: text/plain; charset=UTF-8\r\nContent-Transfer-Encoding: 8bit\r\nFrom: Formular site <noreply@$fromHost>\r\nReply-To: {$formData['email']}\r\n";
        
        $encoded_subject = '=?UTF-8?B?'.base64_encode($subject_line).'?=';
        if (@mail($contact_recipient, $encoded_subject, $formData['message'], $headers)) {
            header('Location: contact.php?status=success');
            exit;
        }
    }
}

// 6. Generare Captcha
$captcha_n1 = random_int(1, 9); $captcha_n2 = random_int(1, 9);
if ($showForm) { $_SESSION['contact_captcha_sum'] = $captcha_n1 + $captcha_n2; }

$subject_selected = isset($allowed_subjects[$formData['subject']]) ? $formData['subject'] : 'hatha';
?>
<!doctype html>
<html lang="<?php echo $current_lang; ?>">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="<?php echo isset($lang['cont_meta_desc']) ? $lang['cont_meta_desc'] : 'Contact — deschiderea dialogului.'; ?>">
<title><?php echo isset($lang['cont_meta_title']) ? $lang['cont_meta_title'] : 'Contact | Calea Autentică'; ?></title>
<?php include 'head.php'; ?>
</head>
<body class="contact-page-body">
<?php include 'menu.php'; ?>

<main id="main-content" class="contact-page-main section-padding">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-lg-8 col-xl-7 contact-narrow">

        <header class="text-center mb-5 contact-intro">
          <h1 class="contact-page-title"><?php echo isset($lang['cont_title']) ? $lang['cont_title'] : 'Deschiderea Dialogului'; ?></h1>
          <p class="contact-lead text-muted"><?php echo isset($lang['cont_lead']) ? $lang['cont_lead'] : 'Dacă simți că mesajul tău merită ascultare, îl voi primi cu recunoștință.'; ?></p>
        </header>

        <?php if ($statusParam === 'success') : ?>
        <div class="alert alert-success border-0 rounded-0 contact-alert" role="status">
          <?php echo isset($lang['cont_success_msg']) ? $lang['cont_success_msg'] : '<strong>Mulțumim.</strong> Mesajul tău a fost trimis.'; ?>
        </div>
        <p class="text-center small text-muted mb-4"><a href="contact.php" class="contact-mailto-link"><?php echo isset($lang['cont_send_another']) ? $lang['cont_send_another'] : 'Trimite un alt mesaj'; ?></a></p>
        <?php endif; ?>

        <?php if (!empty($errors)) : ?>
        <div class="alert alert-danger border-0 rounded-0 contact-alert" role="alert">
          <ul class="mb-0 ps-3">
            <?php foreach ($errors as $err) : ?>
            <li><?php echo htmlspecialchars($err, ENT_QUOTES, 'UTF-8'); ?></li>
            <?php endforeach; ?>
          </ul>
        </div>
        <?php endif; ?>

        <?php if ($showForm) : ?>
        <div class="card border-0 shadow-sm contact-card mb-5">
          <div class="card-body p-4 p-md-5">
            <form class="contact-form" method="post" action="contact.php" autocomplete="on">
              <div class="contact-hp" aria-hidden="true">
                <label for="website_url">Website</label>
                <input type="text" name="website_url" id="website_url" value="" tabindex="-1" autocomplete="off">
              </div>

              <div class="mb-4">
                <label for="name" class="form-label"><?php echo isset($lang['cont_name_label']) ? $lang['cont_name_label'] : 'Nume'; ?> <span class="text-danger">*</span></label>
                <input type="text" name="name" id="name" class="form-control form-control-lg contact-input" required maxlength="120" value="<?php echo htmlspecialchars($formData['name'], ENT_QUOTES, 'UTF-8'); ?>" placeholder="<?php echo isset($lang['cont_name_ph']) ? $lang['cont_name_ph'] : 'Numele tău'; ?>">
              </div>

              <div class="mb-4">
                <label for="email" class="form-label"><?php echo isset($lang['cont_email_label']) ? $lang['cont_email_label'] : 'E-mail'; ?> <span class="text-danger">*</span></label>
                <input type="email" name="email" id="email" class="form-control form-control-lg contact-input" required value="<?php echo htmlspecialchars($formData['email'], ENT_QUOTES, 'UTF-8'); ?>" placeholder="adresa@exemplu.com">
              </div>

              <div class="mb-4">
                <label for="subject" class="form-label"><?php echo isset($lang['cont_subject_label']) ? $lang['cont_subject_label'] : 'Subiect'; ?></label>
                <select name="subject" id="subject" class="form-select form-select-lg contact-input">
                  <?php foreach ($allowed_subjects as $val => $label) : ?>
                  <option value="<?php echo htmlspecialchars($val, ENT_QUOTES, 'UTF-8'); ?>"<?php echo $subject_selected === $val ? ' selected' : ''; ?>><?php echo htmlspecialchars($label, ENT_QUOTES, 'UTF-8'); ?></option>
                  <?php endforeach; ?>
                </select>
              </div>

              <div class="mb-4">
                <label for="message" class="form-label"><?php echo isset($lang['cont_message_label']) ? $lang['cont_message_label'] : 'Mesaj'; ?> <span class="text-danger">*</span></label>
                <textarea name="message" id="message" class="form-control contact-input" rows="8" required placeholder="<?php echo isset($lang['cont_msg_ph']) ? $lang['cont_msg_ph'] : 'Mesajul tău...'; ?>"><?php echo htmlspecialchars($formData['message'], ENT_QUOTES, 'UTF-8'); ?></textarea>
              </div>

              <div class="mb-4">
                <label for="human_check" class="form-label"><?php echo isset($lang['cont_captcha_label']) ? $lang['cont_captcha_label'] : 'Verificare discretă'; ?> <span class="text-danger">*</span></label>
                <div class="input-group input-group-lg">
                  <span class="input-group-text contact-captcha-label">Cât fac <?php echo (int) $captcha_n1; ?> + <?php echo (int) $captcha_n2; ?>?</span>
                  <input type="text" name="human_check" id="human_check" class="form-control contact-input" required autocomplete="off">
                </div>
              </div>

              <div class="d-grid gap-2">
                <button type="submit" class="btn btn-custom btn-lg contact-submit-btn" id="contactSubmitBtn">
                  <span class="contact-submit-label"><?php echo isset($lang['cont_submit_btn']) ? $lang['cont_submit_btn'] : 'Transmite Mesajul'; ?></span>
                  <span class="contact-submit-loading d-none spinner-border spinner-border-sm ms-2" role="status" aria-hidden="true"></span>
                </button>
              </div>
            </form>
          </div>
        </div>
        <?php endif; ?>

        <section class="contact-alt text-center mb-4">
          <h2 class="h5 contact-alt-title mb-3"><?php echo isset($lang['cont_alt_title']) ? $lang['cont_alt_title'] : 'Alte căi'; ?></h2>
          <p class="contact-email-reveal mb-4" id="contactEmailMount"></p>
          <div class="contact-social d-flex justify-content-center gap-4 align-items-center">
            <a href="https://x.com/Just4Sitting" class="contact-social-link" target="_blank" rel="noopener noreferrer">
              <svg class="contact-social-icon" xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" viewBox="0 0 16 16"><path d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633L12.601.75Zm-.86 13.028h1.36L4.323 2.145H2.865z"/></svg>
            </a>
            <a href="https://www.instagram.com/just_sitting_09/" class="contact-social-link" target="_blank" rel="noopener noreferrer">
              <svg class="contact-social-icon" xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" viewBox="0 0 16 16"><path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.509-.198-1.09-.333-1.942-.372C10.443.01 10.172 0 7.998 0zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.109.282.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.109.705-.24 1.485-.276.738-.034 1.02-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92M8 3.863c-2.302 0-4.165 1.863-4.165 4.165 0 2.302 1.863 4.165 4.165 4.165s4.165-1.863 4.165-4.165c0-2.302-1.863-4.165-4.165-4.165m0 1.442a2.723 2.723 0 1 1 0 5.446 2.723 2.723 0 0 1 0-5.446"/></svg>
            </a>
          </div>
        </section>

      </div>
    </div>
  </div>
</main>

<?php include 'footer.php'; ?>
<script>
(function () {
  var form = document.querySelector('.contact-form');
  var btn = document.getElementById('contactSubmitBtn');
  if (form && btn) {
    form.addEventListener('submit', function () {
      if (!form.checkValidity()) return;
      btn.disabled = true;
      btn.classList.add('disabled');
      var lab = btn.querySelector('.contact-submit-label');
      var sp = btn.querySelector('.contact-submit-loading');
      if (lab) lab.textContent = '<?php echo isset($lang['cont_sending_status']) ? $lang['cont_sending_status'] : "Se trimite..."; ?>';
      if (sp) sp.classList.remove('d-none');
    });
  }
  var parts = ['lawrence', '.greco', '@', 'gmail', '.com'];
  var el = document.getElementById('contactEmailMount');
  if (el) {
    var addr = parts.join('');
    el.innerHTML = '<a class="contact-mailto-link" href="mailto:' + addr + '">' + addr + '</a>';
  }
})();
</script>
</body>
</html>