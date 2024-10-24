<?php 
class Custom_Walker_Nav_Menu extends Walker_Nav_Menu {
    public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
        parent::start_el($output, $item, $depth, $args, $id);
        
        if (in_array('menu-item-has-children', $item->classes)) {
            $output .= '<span class="submenu-open"></span>';
        }
    }
}

function register_custom_walker() {
    add_filter('wp_nav_menu_args', function($args) {
        $args['walker'] = new Custom_Walker_Nav_Menu();
        return $args;
    });
}

add_action('after_setup_theme', 'register_custom_walker');