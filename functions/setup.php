<?php
if (!defined('ABSPATH')) {
  exit; // Exit if accessed directly.
}

// Enqueue CSS and JS files into theme
function add_theme_scripts()
{
  // Get latest update of Stylesheet
  $style_ver = filemtime(get_parent_theme_file_path() . '/style.css');
  // Get latest update of Scripts
  $script_ver = filemtime(get_parent_theme_file_path() . '/js/scripts.js');
  // Enqueue style.css with version updating
  wp_enqueue_style('main_style', get_stylesheet_directory_uri() . '/style.css', '', $style_ver);
  // Enqueue latest version of jQuery
  wp_enqueue_script('jquery', 'https://code.jquery.com/jquery-latest.min.js', array(), null, true);
  // Enqueue script.js with version updating and dependency on jQuery
  wp_enqueue_script('main-script', get_stylesheet_directory_uri() . '/js/scripts.js', array('jquery'), $script_ver, true);
  // Enqueue slick slider
  wp_enqueue_style('slick-css', 'https://cdn.jsdelivr.net/npm/@accessible360/accessible-slick@1.0.1/slick/slick.min.css');
  // Enqueue slick slider theme
  wp_enqueue_style('slick-theme-css', 'https://cdn.jsdelivr.net/npm/@accessible360/accessible-slick@1.0.1/slick/slick-theme.min.css');
  // Enqueue slick slider JS
  wp_enqueue_script('slick-js', 'https://cdn.jsdelivr.net/npm/@accessible360/accessible-slick@1.0.1/slick/slick.min.js', array('jquery'), null, true);
  // Enqueue Typekit font Joly Display and Sofia Pro
  wp_enqueue_style('typekit-fonts', 'https://use.typekit.net/hpm3lpp.css');
  // Enqueue Google font Homemade Apple
  wp_enqueue_style('google fonts', 'https://fonts.googleapis.com/css2?family=Homemade+Apple&display=swap');
}
add_action('wp_enqueue_scripts', 'add_theme_scripts');

// Enqueue content assets but only in the Editor.
function enqueue_editor_content_assets()
{
  if (is_admin()) {
    wp_enqueue_style('typekit-fonts', 'https://use.typekit.net/hpm3lpp.css');
    wp_enqueue_style('google fonts', 'https://fonts.googleapis.com/css2?family=Homemade+Apple&display=swap');
    wp_enqueue_style('editor styles', get_stylesheet_directory_uri() . '/style.css');
    wp_enqueue_script('jquery', 'https://code.jquery.com/jquery-latest.min.js', array(), null, true);
    wp_enqueue_script('main-script', get_stylesheet_directory_uri() . '/js/scripts.js', array('jquery'), null, true);
    wp_enqueue_style('slick-css', 'https://cdn.jsdelivr.net/npm/@accessible360/accessible-slick@1.0.1/slick/slick.min.css');
    wp_enqueue_style('slick-theme-css', 'https://cdn.jsdelivr.net/npm/@accessible360/accessible-slick@1.0.1/slick/slick-theme.min.css');
    wp_enqueue_script('slick-js', 'https://cdn.jsdelivr.net/npm/@accessible360/accessible-slick@1.0.1/slick/slick.min.js', array('jquery'), null, true);
  }
}
add_action('enqueue_block_assets', 'enqueue_editor_content_assets');

// Enable SVG uploading support in the media library
function add_file_types_to_uploads($file_types)
{
  $new_filetypes = array();
  $new_filetypes['svg'] = 'image/svg+xml';
  $file_types = array_merge($file_types, $new_filetypes);
  return $file_types;
}
add_filter('upload_mimes', 'add_file_types_to_uploads');

// Remove WordPress's inline SVG's from the frontend
remove_action('wp_body_open', 'wp_global_styles_render_svg_filters');

// Enable gutenberg elements, if not selected here then they wont show up in the editor
function my_theme_allowed_block_types($allowed_blocks, $editor_context)
{
  // List of allowed blocks
  $allowed_blocks = array(
      'core/paragraph',
      'core/heading',
      'core/shortcode',
      'core/list',
      'core/list-item',
      'core/quote',
      'core/code',
      'core/details',
      'core/pullquote',
      'core/table',
      'create-block/category-card-slider',
      'create-block/card-carousel',
      'core/image',
      'core/gallery',
      'core/audio',
      'core/cover',
      'core/file',
      'core/media-text',
      'core/video',
      'core/buttons',
      'core/button',
      'core/columns',
      'core/column',
      'core/group',
      'core/row',
      'core/stack',
      'contact-form-7/contact-form-selector',
  );

  // Check if we are in the post editor
  if (isset($editor_context->post)) {
    return $allowed_blocks;
  }

  return $allowed_blocks;
}
add_filter('allowed_block_types_all', 'my_theme_allowed_block_types', 10, 2);

// Remove the <p> Tags around contact form 7 outputs
add_filter('wpcf7_autop_or_not', '__return_false');

function enqueue_slick_slider_assets()
{
  // Enqueue Slick Slider CSS for Frontend and Admin
  wp_enqueue_style('slick-css', 'https://cdn.jsdelivr.net/npm/@accessible360/accessible-slick@1.0.1/slick/slick.min.css');
  wp_enqueue_style('slick-theme-css', 'https://cdn.jsdelivr.net/npm/@accessible360/accessible-slick@1.0.1/slick/slick-theme.min.css');

  // Enqueue Slick Slider JS for Frontend and Admin
  wp_enqueue_script('slick-js', 'https://cdn.jsdelivr.net/npm/@accessible360/accessible-slick@1.0.1/slick/slick.min.js', array('jquery'), null, true);
}

// Enqueue scripts and styles for the front end
add_action('wp_enqueue_scripts', 'enqueue_slick_slider_assets');

// Enqueue scripts and styles for the admin area
add_action('admin_enqueue_scripts', 'enqueue_slick_slider_assets');


