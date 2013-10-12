<?php
/**
 * wpBootStrap Theme Options
 * 
 * @package wpBootStrap
 * 
 * @since 0.1
 */

/*
 * Specify Hooks/Filters
 */
add_action( 'admin_menu', 'wbs_add_menu' );

/*
 * The Admin menu page
 */
function wbs_add_menu(){
    $wbs_settings_page = add_theme_page(__('wpBootStrap Options'), __('wpBootStrap Options','wbs'), 'manage_options', 'wps-settings', 'wbs_settings_page_fn');
}

 /**
 * Helper function for defining variables for the current page
 *
 * @return array
 */
function wbs_get_settings() {
    $output = array();

    // put together the output array 
    $output['wbs_option_name'] 		= ''; // the option name as used in the get_option() call.
    $output['wbs_page_title'] 		= __( 'wpBootStrap Settings Page','wbs'); // the settings page title
    $output['wbs_page_sections'] 	= ''; // the setting section
    $output['wbs_page_fields'] 		= ''; // the setting fields
    $output['wbs_contextual_help'] 	= ''; // the contextual help
	
return $output;
}

/*
 * Admin Settings Page HTML
 * 
 * @return echoes output
 */
function wbs_settings_page_fn() {
    $settings_output = wbs_get_settings();
?>
<div class="wrap">
    <div class="icon32" id="icon-options-general"></div>
    <h2><?php echo $settings_output['wbs_page_title']; ?></h2>
    
    <form action="options.php" method="post">
        <p class="submit">
            <input name="Submit" type="submit" class="button-primary" value="<?php esc_attr_e('Save Changes','wbs'); ?>" />
        </p>
    </form>
</div><!-- wrap -->
<?php }

/*
 * Register our setting
 */
function wbs_register_settings(){
    // get the settings sections array
    $settings_output 	= wbs_get_settings();
    $wbs_option_name = $settings_output['wbs_option_name'];

    //setting
    //register_setting( $option_group, $option_name, $sanitize_callback );
    register_setting($wbs_option_name, $wbs_option_name, 'wbs_validate_options' );
}