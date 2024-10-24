<?php get_header(); ?>
<main id="site-content" role="main">
  <!-- A gutenberg group wraps all content to allow for full controls inside the editor -->
  <div class="wp-block-group main-content-container alignfull has-global-padding is-layout-constrained wp-block-group-is-layout-constrained">
    <?php the_content(); // the gutenberg content ?>
  </div>
</main>
<?php get_footer(); ?>