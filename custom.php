<?php
/* Add Your Custom PHP Below This Line
---------------------------------------------------------------- */

// Enqueue Fonts
//add_action( 'wp_enqueue_scripts', 'opensky_enqueue_scripts_fonts' );
function opensky_enqueue_scripts_fonts() {
	wp_enqueue_style( 'opensky-fonts', '//fonts.googleapis.com/css?family=Montserrat:400,400i,700,700i', array(), CHILD_THEME_VERSION );
}
// Add a new GOOGLE font to GeneratePress 
// https://docs.generatepress.com/article/customizing-the-google-font-list/
//add_filter( 'generate_typography_customize_list', 'opensky_add_google_fonts_gp' );
function opensky_add_google_fonts_gp( $fonts ) {
	$fonts[ 'marydale' ] = array( 
		'name' => '',
		'variants' => array( '400', '700' ),
		'category' => 'serif'
	);
	return $fonts;
}
// Add a new LOCAL font to the GeneratePress
// https://docs.generatepress.com/article/adding-local-fonts/
//add_filter( 'generate_typography_default_fonts', 'opensky_add_local_fonts_gp');
function opensky_add_local_fonts_gp( $fonts ) {
	$fonts[] = 'Marydale';
	return $fonts;
}
// Add a new LOCAL font to Beaver Builder Page Builder modules
//add_filter( 'fl_builder_font_families_system', 'opensky_add_local_fonts_bb' );
function opensky_add_local_fonts_bb ( $system_fonts ) {
	$system_fonts[ 'Marydale' ] = array(
		'fallback' => 'Times, serif',
		'weights' => array(	'400' ),
	);
	return $system_fonts;
}

// Add class to all pages for full width
add_filter( 'body_class','opensky_body_classes' );
function opensky_body_classes( $classes ) { 
	$classes[] = 'full-width-content';     
	return $classes;
}

// HEADER Hook
add_action('wp_head', 'opensky_head_code');
function opensky_head_code() {
	?>
	<!-- INSERT HTML HEADER CODE HERE -->


	<!-- END CUSTOM HTML HEADER CODE -->
	<?php
}

// BODY Hook
add_action('generate_before_header', 'opensky_body_code');
function opensky_body_code() {
	?>
	<!-- INSERT HTML BODY CODE HERE -->


	<!-- END CUSTOM HTML BODY CODE -->
	<?php
}

// FOOTER Hook
add_action('wp_footer', 'opensky_footer_code');
function opensky_footer_code() {
	?>
	<!-- INSERT HTML FOOTER CODE HERE -->


	<!-- END CUSTOM HTML FOOTER CODE -->
	<?php
}
