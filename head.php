<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-FN1B9NPT8X"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-FN1B9NPT8X');
</script>

<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$supported_langs = array('ro', 'en');
$page_slug_map = array(
    'index' => 'index.php',
    'calea' => 'calea.php',
    'just-sitting' => 'just-sitting.php',
    'invatatura' => 'invatatura.php',
    'contact' => 'contact.php',
    'privacy-policy' => 'privacy-policy.php',
    'cookies-policy' => 'cookies-policy.php',
    'terms' => 'terms.php',
);
$page_route_map = array(
    'index' => array('ro' => '', 'en' => ''),
    'calea' => array('ro' => 'calea', 'en' => 'path'),
    'just-sitting' => array('ro' => 'just-sitting', 'en' => 'just-sitting'),
    'invatatura' => array('ro' => 'invatatura', 'en' => 'wisdom'),
    'contact' => array('ro' => 'contact', 'en' => 'contact'),
    'privacy-policy' => array('ro' => 'politica-confidentialitate', 'en' => 'privacy-policy'),
    'cookies-policy' => array('ro' => 'politica-cookies', 'en' => 'cookies-policy'),
    'terms' => array('ro' => 'termeni-conditii', 'en' => 'terms-conditions'),
);
$script_slug_map = array_flip($page_slug_map);
$site_brand = 'Phagchen Ling';

function base_path()
{
    static $base_path = null;

    if ($base_path !== null) {
        return $base_path;
    }

    $script_name = isset($_SERVER['SCRIPT_NAME']) ? str_replace('\\', '/', $_SERVER['SCRIPT_NAME']) : '';
    $dir = rtrim(str_replace('\\', '/', dirname($script_name)), '/');
    $base_path = ($dir === '.' || $dir === '/') ? '' : $dir;

    return $base_path;
}

function asset_url($path)
{
    return base_path() . '/' . ltrim($path, '/');
}

function page_slug_from_script($script_name)
{
    global $script_slug_map;

    $script_name = basename((string) $script_name);
    return isset($script_slug_map[$script_name]) ? $script_slug_map[$script_name] : 'index';
}

function localized_slug($page_slug, $lang)
{
    global $page_route_map;

    if (!isset($page_route_map[$page_slug])) {
        return $page_slug;
    }

    return isset($page_route_map[$page_slug][$lang]) ? $page_route_map[$page_slug][$lang] : $page_slug;
}

function route_url($script_name, $lang = null, $params = array())
{
    global $current_lang;

    $lang = ($lang === 'ro' || $lang === 'en') ? $lang : $current_lang;
    $page_slug = page_slug_from_script($script_name);
    $localized = localized_slug($page_slug, $lang);
    $path = ($page_slug === 'index') ? '/' . $lang : '/' . $lang . '/' . $localized;
    $url = base_path() . $path;

    if (!empty($params)) {
        $query = http_build_query($params);
        if ($query !== '') {
            $url .= '?' . $query;
        }
    }

    return $url;
}

$request_path = isset($_SERVER['REQUEST_URI']) ? (string) parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) : '';
$base_path = base_path();
if ($base_path !== '' && strpos($request_path, $base_path) === 0) {
    $request_path = substr($request_path, strlen($base_path));
}
$request_path = trim($request_path, '/');
$path_segments = ($request_path === '') ? array() : explode('/', $request_path);

$route_lang = null;
if (!empty($path_segments) && in_array($path_segments[0], $supported_langs, true)) {
    $route_lang = $path_segments[0];
}

if ($route_lang !== null) {
    $_SESSION['lang'] = $route_lang;
} elseif (isset($_GET['l']) && in_array($_GET['l'], $supported_langs, true)) {
    $_SESSION['lang'] = $_GET['l'];
}

$current_lang = isset($_SESSION['lang']) && in_array($_SESSION['lang'], $supported_langs, true)
    ? $_SESSION['lang']
    : 'en';

$lang_file = 'languages/' . $current_lang . '.php';
if (file_exists($lang_file)) {
    include $lang_file;
} else {
    include 'languages/en.php';
}

$current_script = basename(isset($_SERVER['PHP_SELF']) ? $_SERVER['PHP_SELF'] : 'index.php');
// Don't override $current_page_slug if it was already set (e.g., in policy pages)
if (!isset($current_page_slug)) {
    $current_page_slug = page_slug_from_script($current_script);
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $query_params = $_GET;
    $should_redirect = false;

    if ($route_lang !== null) {
        $should_redirect = true;
    }

    if (isset($query_params['l'])) {
        unset($query_params['l']);
        $should_redirect = true;
    }

    if ($request_path === '' || preg_match('/\.php$/i', $request_path)) {
        $should_redirect = true;
    }

    if ($should_redirect) {
        $canonical_url = route_url($current_script, $current_lang, $query_params);
        $current_uri = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';

        if ($canonical_url !== $current_uri) {
            header('Location: ' . $canonical_url, true, 301);
            exit;
        }
    }
}

function render_seo_tags()
{
    global $current_lang, $current_page_slug;

    $base_url = 'https://just-sitting.com';

    // Construim URL-ul canonical pentru limba curentă
    $canonical_path = route_url($current_page_slug . '.php', $current_lang);
    // route_url returnează cale relativă; adăugăm domeniul
    $canonical_url = $base_url . $canonical_path;

    // Construim URL-urile alternate pentru ambele limbi
    $url_en_path = route_url($current_page_slug . '.php', 'en');
    $url_ro_path = route_url($current_page_slug . '.php', 'ro');
    $url_en = $base_url . $url_en_path;
    $url_ro = $base_url . $url_ro_path;

    echo '<link rel="canonical" href="' . htmlspecialchars($canonical_url) . '">' . "\n";
    echo '<link rel="alternate" hreflang="en" href="' . htmlspecialchars($url_en) . '">' . "\n";
    echo '<link rel="alternate" hreflang="ro" href="' . htmlspecialchars($url_ro) . '">' . "\n";
    // x-default pointează spre varianta EN ca limbă implicită
    echo '<link rel="alternate" hreflang="x-default" href="' . htmlspecialchars($url_en) . '">' . "\n";
}

function render_head_assets()
{
    ?>
<?php render_seo_tags(); ?>
<!-- Bootstrap 5.3 CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

<!-- Google Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;700&display=swap" rel="stylesheet">

<!-- Custom CSS -->
<link rel="stylesheet" href="<?php echo htmlspecialchars(asset_url('style.css')); ?>?v=<?php echo filemtime(__DIR__ . '/style.css'); ?>">
<link rel="icon" href="<?php echo htmlspecialchars(asset_url('imgs/favicon.ico')); ?>" type="image/x-icon">
<link rel="shortcut icon" href="<?php echo htmlspecialchars(asset_url('imgs/favicon.ico')); ?>" type="image/x-icon">
<?php
}
