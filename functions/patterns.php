<?php
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

/**
 * ADD CUSTOM CATEGORIES
 * This function registers the Block Pattern Category
 * The category is where the Block Pattern will be added to under the Patterns tab in the editor.
 * Since v6.0, WordPress will look in the theme/patterns folder and see if there are any Block Patterns.
 * See: https://developer.wordpress.org/reference/functions/_register_theme_block_patterns/
 */
function register_bn_pattern_categories() {
	register_block_pattern_category(
		'Callouts',
		array('label' => __('Callouts', 'bambooninestarter'))
	);
}
add_action('init', 'register_bn_pattern_categories');

/**
 * Unregister all default patterns
 * This removes all of the Core Patterns, but will leave in any Patterns set by the theme (including the Parent)
 */
add_action('init', function () {
	remove_theme_support('core-block-patterns');
});

/**
 * REMOVE THE DEFAULT DEFAULTS.
 * Note: if you remove the core block patterns, WordPress still has 7 patterns that will display.
 * The following function will remove those 7 Default Block Patterns.
 * Use this with the function above.
 * Fires 'after_setup_theme'.
 */
function remove_core_block_patterns() {
	remove_action('init', '_register_core_block_patterns_and_categories');
}
add_action('after_setup_theme', 'remove_core_block_patterns');

/**
 * REMOVE PARENT THEME REGISTERED BLOCK PATTERNS
 * For example, if you have a child theme based on Twenty-Twenty-Three, then you should find that there are 3 Block Patterns that appear as "Uncategorized".
 * These are the "Call To Action", "Default Footer", and the "Post Meta" Pattern blocks.
 */
add_action('init', function () {
	if (!function_exists('unregister_block_pattern')) {
		return;
	}
	unregister_block_pattern('post-meta');
	unregister_block_pattern('footer-default');
	unregister_block_pattern('cta');
});