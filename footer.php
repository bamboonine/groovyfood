        <?php wp_footer(); ?>
        <footer>
            <div class="large-container">
                <div class="footer-logo-container">
                    <a href="<?php echo home_url(); ?>">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/burlingtons-footer-logo.svg" alt="Burlingtons Mark Logo" />
                    </a>
                </div>
                <div class="footer-address-container">
                    <p>2 Eaton Gate, London,</p>
                    <p>SW1W 9BJ,</p>
                    <p>United Kingdom.</p>
                </div>
                <div class="footer-contact-container">
                    <p id="by-appointment">By Appointment Only</p>
                    <div class="contact-container">
                        <p><a href="tel:02077887715">020 7788 7715</a></p>
                        <p><a href="mailto:info@burlingtons.ltd">info@burlingtons.ltd</a></p>
                    </div>
                </div>
                <div class="footer-social-container">
                    <a href="https://www.instagram.com/burlingtonsltd/" target="_blank">Instagram</a>
                    <a href="https://www.facebook.com/burlingtonsltd/" target="_blank">Facebook</a>
                </div>
                <div class="footer-menu-container">
                    <?php wp_nav_menu( array(
                        'menu'           => 'footer-nav',
                        'menu_class'     => 'footer-menu',
                    ) ); ?>
                </div>
                <div class="copy-container">
                    <p>&copy; <?php echo date('Y'); ?> Burlingtons | Site by: <a href="https://bamboonine.co.uk/" target="_blank">Bamboo Nine</a></p>
                </div>
            </div>
        </footer>
    </body>
</html>