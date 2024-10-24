<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

// Register custom React blocks
function create_react_gutenberg_block_init()
{
    register_block_type(get_template_directory() . '/blocks/category-card-slider/build/');
    register_block_type(get_template_directory() . '/blocks/card-carousel/build/');
}
add_action('init', 'create_react_gutenberg_block_init');

// Register a custom category for Bamboo Nine blocks
function bamboo_nine_block_category($categories, $post)
{
    return array_merge(
        $categories,
        array(
            array(
                'slug'  => 'bamboo-nine',
                'title' => __('Bamboo Nine Blocks', 'burlingtons'),
            ),
        )
    );
}
add_filter('block_categories', 'bamboo_nine_block_category', 10, 2);
