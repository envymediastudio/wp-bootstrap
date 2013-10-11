<?php
/**
 * wpBootStrap Init
 * 
 * @package wpBootStrap
 * 
 * @since wpBootStrap 0.1
 */

/* Register some javascript files, because we love javascript files. Enqueue a couple as well */
function wbs_load_scripts() {
    wp_register_script( 'wbs-load-bootstrap-core-js', WBS_JS_FOLDER_URL.'/bootstrap.js', array('jquery'), WBS_VERSION, true );
    wp_register_script( 'wbs-load-modern-business-js', WBS_JS_FOLDER_URL.'/modern-business.js', array('jquery'), WBS_VERSION, true );
    
    wp_register_style( 'wbs-load-bootstrap-core-style', WBS_CSS_FOLDER_URL.'/bootstrap.css', array(), WBS_VERSION );
    wp_register_style( 'wbs-load-font-awesome-core-style', WBS_CSS_FOLDER_URL.'/font-awesome/css/font-awesome.min.css', array(), WBS_VERSION );
    
    wp_enqueue_script('wbs-load-bootstrap-core-js');
    wp_enqueue_script('wbs-load-modern-business-js');
    
    wp_enqueue_style('wbs-load-bootstrap-core-style');
    wp_enqueue_style('wbs-load-font-awesome-core-style');
}

/* Hook in function with the javascript files with the wp_enqueue_scripts hook */
add_action('wp_enqueue_scripts', 'wbs_load_scripts');

/*Register area for custom menu*/
function wbs_register_menu() {
    register_nav_menu( 'primary-menu', __( 'Primary Menu' ) );
}
/*Add support for WordPress 3.0's custom menus*/
add_action( 'init', 'wbs_register_menu' );

class Wbs_Walker_Nav_Menu extends Walker_Nav_Menu {
    /**
     * @see Walker::start_el()
     * @since 3.0.0
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param object $item Menu item data object.
     * @param int $depth Depth of menu item. Used for padding.
     * @param int $current_page Menu item ID.
     * @param object $args
     */
    function start_el(&$output, $item, $depth, $args) {
            global $wp_query;           

            $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

            $class_names = $value = '';

            $classes = empty( $item->classes ) ? array() : (array) $item->classes;
            $classes[] = 'menu-item-' . $item->ID;

            $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
            $class_names = ' class="' . esc_attr( $class_names ) . '"';

            $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
            $id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

            $output .= $indent . '<li' . $id . $value . $class_names .'>';

            $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
            $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
            $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
            $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

            // new addition for active class on the a tag
            if(in_array('current-menu-item', $classes)) {
                $attributes .= ' class="active"';
            }

            $item_output = $args->before;
            $item_output .= '<a'. $attributes .'>';
            $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
            $item_output .= '</a>';
            $item_output .= $args->after;

            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}