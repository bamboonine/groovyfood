<?php
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

// Register a custom post type called "testimonial".
function create_testimonial_cpt()
{
  $labels = array(
    'name'                  => _x('Testimonials', 'Post type general name', 'textdomain'),
    'singular_name'         => _x('Testimonial', 'Post type singular name', 'textdomain'),
    'menu_name'             => _x('Testimonials', 'Admin Menu text', 'textdomain'),
    'name_admin_bar'        => _x('Testimonial', 'Add New on Toolbar', 'textdomain'),
    'add_new'               => __('Add New', 'textdomain'),
    'add_new_item'          => __('Add New Testimonial', 'textdomain'),
    'new_item'              => __('New Testimonial', 'textdomain'),
    'edit_item'             => __('Edit Testimonial', 'textdomain'),
    'view_item'             => __('View Testimonial', 'textdomain'),
    'all_items'             => __('All Testimonials', 'textdomain'),
    'search_items'          => __('Search Testimonials', 'textdomain'),
    'parent_item_colon'     => __('Parent Testimonials:', 'textdomain'),
    'not_found'             => __('No testimonials found.', 'textdomain'),
    'not_found_in_trash'    => __('No testimonials found in Trash.', 'textdomain'),
    'featured_image'        => _x('Testimonial Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'textdomain'),
    'set_featured_image'    => _x('Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'textdomain'),
    'remove_featured_image' => _x('Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'textdomain'),
    'use_featured_image'    => _x('Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'textdomain'),
    'archives'              => _x('Testimonial archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'textdomain'),
    'insert_into_item'      => _x('Insert into testimonial', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'textdomain'),
    'uploaded_to_this_item' => _x('Uploaded to this testimonial', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'textdomain'),
    'filter_items_list'     => _x('Filter testimonials list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'textdomain'),
    'items_list_navigation' => _x('Testimonials list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'textdomain'),
    'items_list'            => _x('Testimonials list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'textdomain'),
  );

  $args = array(
    'labels'             => $labels,
    'public'             => true,
    'publicly_queryable' => true,
    'show_ui'            => true,
    'show_in_menu'       => true,
    'query_var'          => true,
    'rewrite'            => array('slug' => 'testimonial'),
    'capability_type'    => 'post',
    'has_archive'        => true,
    'hierarchical'       => false,
    'menu_position'      => null,
    'supports'           => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments'),
    'show_in_rest'       => true,
  );

  register_post_type('testimonial', $args);
}

add_action('init', 'create_testimonial_cpt');