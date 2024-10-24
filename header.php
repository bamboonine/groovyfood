<!DOCTYPE html>
  <head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width" />
    <title><?php wp_title('|', true, 'right'); ?></title>
    <?php wp_head(); ?>
  </head>
  <body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <header>
      <div class="large-container">
        <div class="left-header-container">
          <div class="logo-container">
            <a href="<?php echo home_url(); ?>">
              <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/burlingtons-logo.svg" alt="Burlingtons Logo" />
            </a>
        </div>
        </div>
        <div class="right-header-container">
          <div class="menu-container">
            <?php wp_nav_menu( array(
              'menu'           => 'primary-nav',
              'menu_class'     => 'primary-menu',
            ) ); ?>
          </div>
          <div class="additional-items-container">
            <div class="search-container">
              <a href="#" id="search-icon"><img src="<?php echo get_template_directory_uri(); ?>/assets/icons/search-ic.svg" alt="Search" /></a>
            </div>
            <div id="search-form-container" style="display: none;">
              <?php echo do_shortcode('[ivory-search id="439" title="AJAX Search Form"]'); ?>
            </div>
            <div class="phone-container">
              <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/phone-ic.svg" alt="Phone" />
            </div>
            <div class="email-container">
              <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/email-ic.svg" alt="Email" />
            </div>
            <div class="burger-container">
              <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/burger-ic.svg" alt="Burger" />
            </div>
          </div>
        </div>
      </div>
    </header>