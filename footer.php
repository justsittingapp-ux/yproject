<footer>
    <div class="container text-center">
    <div class="footer-app-badge mt-3 mb-4">
            <p class="small text-muted mb-2"><span style="color:#D4AF37;">Just Sitting App</span></p>
            <a href="https://play.google.com/store/apps/details?id=com.lawrence.justsitting&hl=en" target="_blank" rel="noopener noreferrer" class="d-inline-block">
                <img src="<?php echo $lang['js_play_store_badge']; ?>" 
                     alt="<?php echo $lang['js_play_store_alt']; ?>" 
                     class="img-fluid" 
                     style="max-width: 140px; transition: transform 0.2s;">
            </a>
        </div>
		<p>
            &copy; <?php echo date('Y'); ?>
            <span style="color:#D4AF37; font-weight:800;">Chagchen Ling</span>.
            <?php echo $lang['footer_rights']; ?>
        </p>
        
        <p class="small mb-3">
            <?php echo $lang['footer_motto']; ?>
        </p>

        <nav class="footer-legal-nav mb-4">
            <ul class="list-unstyled small">
                <li class="d-inline-block mx-2">
                    <a href="<?php echo htmlspecialchars(route_url('privacy-policy.php', $current_lang)); ?>" class="footer-legal-link">
                        <?php echo $lang['footer_privacy']; ?>
                    </a>
                </li>
                <li class="d-inline-block mx-2">
                    <a href="<?php echo htmlspecialchars(route_url('cookies-policy.php', $current_lang)); ?>" class="footer-legal-link">
                        <?php echo $lang['footer_cookies']; ?>
                    </a>
                </li>
                <li class="d-inline-block mx-2">
                    <a href="<?php echo htmlspecialchars(route_url('terms.php', $current_lang)); ?>" class="footer-legal-link">
                        <?php echo $lang['footer_terms']; ?>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="<?php echo asset_url('cookies-consent.js'); ?>"></script>

<style>
    /* Efect vizual la trecerea cu mouse-ul peste badge */
    .footer-app-badge a:hover img {
        transform: scale(1.05);
    }

    /* Stiluri pentru linkurile legale din footer */
    .footer-legal-link {
        color: #D4AF37;
        text-decoration: none;
        transition: all 0.3s ease;
        font-weight: 500;
        border-bottom: 1px solid transparent;
    }

    .footer-legal-link:hover {
        color: #e6c547;
        border-bottom-color: #e6c547;
        text-decoration: underline;
    }

    .footer-legal-link:active {
        color: #c9a62e;
    }
</style>