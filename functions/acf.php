<?php
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

// Register ACF blocks for the theme using the ACF plugin.
function b9startertheme_register_acf_blocks() {
    // Check if function exists and hook into setup.
    if ( function_exists('acf_register_block_type') ) {
        acf_register_block_type(array(
            'name'              => 'logo-slider-block',
            'title'             => __('Logo Slider Block'),
            'description'       => __('A custom logo slider block.'),
            'render_template'   => get_template_directory() . '/blocks/logo-slider-block/logo-slider-block.php',
            'category'          => 'formatting',
            'icon'              => 'slides',
            'keywords'          => array( 'logo', 'slider' ),
        ));
    }
}
add_action('acf/init', 'b9startertheme_register_acf_blocks');