<?php
/**
 * wpBootStrap Init
 * 
 * @package wpBootStrap
 * 
 * @since 0.1
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
    register_nav_menus( array( 'primary' => __( 'Primary Menu', 'wbs' ), ) );
}
/*Add support for WordPress 3.0's custom menus*/
add_action( 'init', 'wbs_register_menu' );