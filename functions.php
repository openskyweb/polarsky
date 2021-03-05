<?php
/**
 * GeneratePress child theme functions and definitions.
 *
 * Add your custom PHP in this file. 
 * Only edit this file if you have direct access to it on your server (to fix errors if they happen).
 */

function generatepress_child_enqueue_scripts() {
	if ( is_rtl() ) {
		wp_enqueue_style( 'generatepress-rtl', trailingslashit( get_template_directory_uri() ) . 'rtl.css' );
	}
}
add_action( 'wp_enqueue_scripts', 'generatepress_child_enqueue_scripts', 100 );

/*** DO NOT EDIT CORE CHILD THEME SETTINGS ABOVE ***/

// Execute Shortcodes in Widgets, Excerpts and Titles
add_filter( 'widget_text', 'shortcode_unautop' );
add_filter( 'widget_text', 'do_shortcode' );	
add_filter( 'the_excerpt', 'shortcode_unautop' );
add_filter( 'the_excerpt', 'do_shortcode' );
add_filter( 'the_title', 'do_shortcode' );

// Set JPG Compression Level
add_filter('jpeg_quality', function($arg){return 90;});

// Gravity Forms Feature: Field Label Visibility
add_filter( 'gform_enable_field_label_visibility_settings', '__return_true' );

// Copyright Credit Shortcode
// Remove the default GeneratePress Copyright
//add_action('after_setup_theme','opensky_copyright_remove_default_message');
function opensky_copyright_remove_default_message() {
	remove_action( 'generate_credits', 'generate_add_footer_info' );
	remove_action( 'generate_copyright_line','generate_add_login_attribution' );
}

// Usage: [credits oscredit="false" title="" link="" link_title="" linebreak="true"]
//add_action( 'generate_credits','opensky_credits_function' );
add_shortcode('credits', 'opensky_credits_function');
function opensky_credits_function( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'oscredit' => 'true', //set true|false for link to Open Sky
		'title' => 'Open Sky Web Studio',
		'link' => 'https://www.openskywebstudio.com',
		'link_title' => 'Open Sky Web Studio | Clean, Effective Websites',
		'linebreak' => 'true',
	), $atts ) );
	$creds = "<span id='credits'>Copyright &copy; " . date('Y') . " <a href='".get_option('home')."' title='".get_bloginfo('name')." | ".get_bloginfo('description')."'>".get_bloginfo('name')."</a>. All Rights Reserved. ";
	if (strtolower($oscredit) == "false")
		$creds .= "<!--";
	if (strtolower($linebreak) == "true")
		$creds .= "<br/>";
	$creds .= "Site Design &bull; <a href='".$link."' title='".$link_title."' target='_blank'>".$title."</a> &bull; ";
	if (strtolower($oscredit) == "false")
		$creds .= "-->";
	$creds .= wp_loginout('', false) . wp_register(' &bull; ', '', false) . '</span>';
	return $creds;
}

// Add a Container Wrap for the whole site for styling
// Custom selector: site-container
// https://docs.generatepress.com/article/adding-a-container-wrapper/
add_action( 'generate_before_header', 'opensky_open_container_wrap', 0 );
function opensky_open_container_wrap() {
	//echo '<div class="full-container grid-container grid-parent site-container">';
	echo '<div class="site-container">';
}
add_action( 'wp_footer ', 'opensky_close_container_wrap', 0 );
function opensky_close_container_wrap() {
	echo '</div><!-- .site-container -->';
}

//* Enqueue Scripts and Styles
add_action( 'wp_enqueue_scripts', 'opensky_enqueue_scripts_styles' );
function opensky_enqueue_scripts_styles() {
	wp_enqueue_style( 'custom', get_stylesheet_directory_uri() . '/custom.css', array( 'generate-child' ), '1.0.0' );
}

// Image size for full width backgrounds
// https://wordpress.stackexchange.com/questions/103995/add-image-size-and-add-filterimage-size-names-choose-my-custom-image-sizes
add_action( 'after_setup_theme', 'opensky_add_image_sizes' );
function opensky_add_image_sizes() {
	add_image_size( 'container-width', 1400, 1400, false ); // width, height, crop
}
add_filter('image_size_names_choose', 'opensky_add_sizes_to_chooser');
function opensky_add_sizes_to_chooser($default_sizes) {
	$new_sizes = array (
		'container-width' => 'Container Width'
	);
	return array_merge($default_sizes, $new_sizes);
}

// Disable Full Screen as default editing in Block Editor
// https://xomisse.com/blog/disable-fullscreen-gutenberg/#:~:text=How%20to%20easily%20disable%20fullscreen,will%20now%20return%20to%20normal.
if (is_admin()) { 
	function opensky_disable_editor_fullscreen_by_default() {
		$script = "jQuery( window ).load(function() { const isFullscreenMode = wp.data.select( 'core/edit-post' ).isFeatureActive( 'fullscreenMode' ); if ( isFullscreenMode ) { wp.data.dispatch( 'core/edit-post' ).toggleFeature( 'fullscreenMode' ); } });";
		wp_add_inline_script( 'wp-blocks', $script );
	}
	add_action( 'enqueue_block_editor_assets', 'opensky_disable_editor_fullscreen_by_default' );
}

//* Include More PHP Customizations
file_exists(get_stylesheet_directory() . '/custom.php') AND include_once get_stylesheet_directory() . '/custom.php';
