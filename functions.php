<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

// Enqueues styles, scripts and slick
// Enqueues backend styling
// Enables SVG uploads
// Removes inline SVG in frontend
// Disables Gutenberg elements that arent required
// Disables Gutenber default styling
require_once('functions/setup.php');

// All the ACF fields
require_once('functions/acf.php');

// Registers custom post types that are needed by default
// Testimonials
// Meet the team
// FAQs
require_once('functions/cpt.php');

// Creates custom categories for block patterns
// Removes default wordpress patterns
require_once('functions/patterns.php');

// Registers custom React blocks
require_once('functions/gutenberg.php');

// Custom walker function for the header menu
require_once('functions/walker.php');