<?php
/**
 * WP Bootstrap functions and definitions
 * 
 * @package wpBootStrap
 * 
 * @since wpBootStrap 0.1
 */

define( 'WBS_VERSION', '0.1' );

/* Define Directory Constants */
define( 'WBS_SYSTEM', get_template_directory() . '/system' );
define( 'WBS_CSS', get_template_directory() . '/css' );
define( 'WBS_JS', get_template_directory() . '/js' );
define( 'WBS_IMG', get_template_directory() . '/img' );

/* Define Directory URL Constants */
define( 'WBS_TEMPLATE_URL', get_template_directory_uri() );
define( 'WBS_CSS_FOLDER_URL', get_template_directory_uri() . '/css' );
define( 'WBS_JS_FOLDER_URL', get_template_directory_uri() . '/js' );
define( 'WBS_IMG_FOLDER_URL', get_template_directory_uri() . '/img' );

/* Includes PHP files located in 'lib' folder */
foreach( glob ( get_template_directory() . "/system/*.php" ) as $lib_filename ) {
    require_once( $lib_filename );
}